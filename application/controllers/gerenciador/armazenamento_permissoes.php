<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class armazenamento_permissoes extends CI_Controller {

	var $titulo 		= 'Permissões';
	var $dir 			= 'multitools/armazenamento_permissoes/';
	var $controller 	= 'multitools/armazenamento_permissoes';
	var $title_sing 	= 'Permissão';
	var $per_page 		= 20;
	var $table 			= 'armazenamento_permissoes';
	var $join			= array('armazenamento_pasta' => array('where' => 'armazenamento_pasta.id_pasta = armazenamento_permissoes.id_pasta', 'type' => 'inner'),'inscritos' => array('where' => 'inscritos.id = armazenamento_permissoes.id_inscritos', 'type' => 'inner'));
        var $join2 =array('armazenamento_pasta' => array('where' => 'armazenamento_pasta.id_pasta = armazenamento_permissoes.id_pasta', 'type' => 'inner'));

	public function __construct(){
		parent::__construct();
		check_login();
	}

	public function index($id_pasta,$offset = 0){//ok

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();
                
                $data['pasta']=array('id_pasta'=>$id_pasta);

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, inscritos.nome nome_inscritos,armazenamento_pasta.nome'), $offset, $this->per_page, array($this->table.'.id_pasta'=>$id_pasta), $this->join, $this->table.'.id', 'DESC');

		//Parâmetros
		$data['paginacao']   = $this->_pagination($this->table);
		$data['controller']  = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	public function adicionar($id_pasta=false){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Adicionar '.$this->title_sing;

		//Menu
		get_menu();
                $data['pasta']=array('id_pasta'=>$id_pasta);
		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

                //Categorias
		//$data['categorias'] = $this->default_model->listaAssociativa('armazenamento_pasta', 'nome', NULL, array('ativo' => 'S','id_pasta'=>$id_pasta), NULL, NULL, false, 'id_pasta');
                $query = $this->default_model->get_all('armazenamento_pasta', array('*'), null, $this->per_page, array('armazenamento_pasta'.'.id_pasta'=>$id_pasta), null, null, null);
                //print_r($query);
                //exit();
                $data['categorias']=array('id_pasta'=>$query[0]->id_pasta,'nome'=>$query[0]->nome);
                
                
                //$query = $this->default_model->get_all($this->table, array($this->table.'.*, inscritos.nome nome_inscritos,armazenamento_pasta.nome'), null, $this->per_page, array($this->table.'.id_pasta'=>$id_pasta), $this->join, $this->table.'.id', 'DESC');
                
                $data['empresa']=array('id_inscritos_empresa'=>$query[0]->inscritos_id);
                
           
		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function editar($id){//ok

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar '.$this->title_sing;;

		//Menu
		get_menu();

		//Busca registro

		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_armazenamento');

/*print_r($data['registro']);
exit();*/
                //Categorias
		//$data['categorias'] = $this->default_model->listaAssociativa('armazenamento_pasta', 'nome', NULL, array('ativo' => 'S'), NULL, NULL, false, 'id_pasta');
                $query = $this->default_model->get_all('armazenamento_pasta', array('*'), null, $this->per_page, array('ativo' => 'S','id_pasta'=>$data['registro']->armazenamento_pasta_id_pasta), Null, null, 'DESC');
                $data['categorias']=array('id_pasta'=>$query[0]->id_pasta,'nome'=>$query[0]->nome);
                
                $data['pasta']=array('id_pasta'=>$data['registro']->armazenamento_pasta_id_pasta);
                
		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function salvar($id_pasta=false)//ok
	{
		//Recebe Post
		$data = $_POST;

                
			$data['created'] = date('Y-m-d H:i:s');			
			$rows_affected = $this->default_model->insert($this->table, $data);
			$data["id_permissao"] = $this->db->insert_id();			
		
                    if($data["id_permissao"]){
                        
			//Recebe usuário
			$data['registro'] = $this->default_model->get_all($this->table, array($this->table.'.*, inscritos.email, inscritos.nome nome_inscritos,armazenamento_pasta.nome'), null, $this->per_page, array($this->table.'.id'=>$data["id_permissao"]), $this->join, $this->table.'.id', 'DESC');
			

			//carrega library de email
			$this->load->library('email');
			$config['protocol'] = 'mail';
			$config['mailtype'] = 'html';

			//Conteúdo do e-mail
			$conteudo = $this->load->view($this->dir.'email_arquivo', array('dados' => $data, 'usuario' => $data['registro'][0]->nome_inscritos), true);
                      
			//Parâmetros
			$this->email->initialize($config);
			$this->email->from('luana@multiwebdigital.com.br', 'MB CONSULTORIA');
			$this->email->to($data['registro'][0]->email,$data['registro'][0]->nome_inscritos);
			$this->email->subject('MB CONSULTORIA - ARMAZENAMENTO EM NUVEM - Pasta compartilhada');
			$this->email->message($conteudo);
			$this->email->send();
		}

		//Mensagem de retorno
		if($rows_affected == 1)
			$msg = 'Dados salvos com sucesso.';
		else
			$msg = 'Não foi possível salvar os dados.';

		//Retorno
		$this->session->set_flashdata('msg', $msg);
		redirect($this->controller.'/index/'.$id_pasta);
	}

	public function excluir($id,$id_pasta){

		//Exclui registro
		if($this->default_model->delete($this->table, array('id' =>$id))){
			$this->session->set_flashdata('msg', 'Registro desativado com sucesso!');
                        
                 }else{
			$this->session->set_flashdata('msg', 'Registro não foi desativado!');
                 }

		//Retorno
		redirect($this->controller.'/index/'.$id_pasta);
	}

	private function _pagination($table, $search = FALSE){

		//Carrega library de paginação
		$this->load->library('pagination');
		$config['per_page']   = $this->per_page;
		$config['last_link']  = 'Última';
		$config['first_link'] = 'Primeira';

		//Parâmetro
		if($search){
			$config['page_query_string'] = TRUE;
			$config['total_rows']        = $this->default_model->count_by_search($this->table, $search, array(), $this->join);
			$config['base_url']          = base_url().$this->controller.'/buscar?s='.$this->input->get('s');
		}
		else{
			$config['uri_segment'] = 4;
			$config['total_rows']  = $this->default_model->count($this->table, array(), $this->join);
			$config['base_url']    = base_url().$this->controller.'/index';
		}

		//Inicializa e retorna paginação
		$this->pagination->initialize($config);
		return $this->pagination->create_links();

	}

	public function buscar(){//ok

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//Parâmetros de busca
                //$data_busca[$this->table.'.armazenamento_pasta_id_pasta ']  = $this->input->get('id_pasta');
                
		$data_busca['inscritos.nome']  = $this->input->get('s');		
                $data_busca['armazenamento_pasta'.'.nome']  = $this->input->get('s');

		//Registros
		$offset = $this->input->get('per_page');              
                $join= array('armazenamento_pasta' => array('where' => 'armazenamento_pasta.id_pasta = armazenamento_permissoes.id_pasta and armazenamento_pasta.id_pasta='.$this->input->get('id_pasta'), 'type' => 'inner'),'inscritos' => array('where' => 'inscritos.id = armazenamento_permissoes.id_inscritos', 'type' => 'inner'));
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, inscritos.nome nome_inscritos,armazenamento_pasta.nome'), NULL, $offset, $this->per_page, $data_busca,$join, $this->table.'.id', 'DESC');
		$data['paginacao'] = $this->_pagination($this->table, $data_busca);

		 $data['pasta']=array('id_pasta'=>$this->input->get('id_pasta'));
                //Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}
}

/* End of file usuarios.php */
/* Location: ./application/controllers/multitools/usuarios.php */