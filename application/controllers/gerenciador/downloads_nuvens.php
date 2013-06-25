<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Downloads_nuvens extends CI_Controller {

	var $titulo 		= 'Downloads';
	var $dir 			= 'multitools/downloads_nuvens/';
	var $controller 	= 'multitools/downloads_nuvens';
	var $title_sing 	= 'Arquivo';
	var $per_page 		= 20;
	var $table 			= 'armazenamento_na_nuvem';
	var $join			= array('armazenamento_pasta' => array('where' => 'armazenamento_pasta.id_pasta = armazenamento_na_nuvem.armazenamento_pasta_id_pasta', 'type' => 'inner'));

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
		$data['registros'] = $this->default_model->get_all($this->table, array('*'), $offset, $this->per_page, array('armazenamento_pasta_id_pasta'=>$id_pasta), $this->join, $this->table.'.id_armazenamento', 'DESC');

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
                $query = $this->default_model->get_all('armazenamento_pasta', array('*'), null, $this->per_page, array('ativo' => 'S','id_pasta'=>$id_pasta), Null, null, 'DESC');
                
                $data['categorias']=array('id_pasta'=>$query[0]->id_pasta,'nome'=>$query[0]->nome);

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

        //Library de Upload
		$config['upload_path']   = './assets/uploads/armazenamento_nuvem/';
		$config['file_name']     = date('YmdHis');
		//$config['allowed_types'] = 'doc|zip|pdf|jpeg|jpg|gif|png|docx|ppt';
                 $config['allowed_types']="*"; 
		$this->load->library('upload', $config);

		//Upload da imagem
		if(!empty($_FILES['nome_arquivo_original']['name'])){
			if($this->upload->do_upload('nome_arquivo_original')){

				if(isset($data["id_armazenamento"]) && $data["id_armazenamento"]){
					$registro = $this->default_model->get_by_id($this->table, $data["id_armazenamento"], array('*'), NULL, NULL, 'id_armazenamento');
					@unlink('./assets/uploads/armazenamento_nuvem/'.$registro->nome_arquivo_original);
				}
				$data_file      = $this->upload->data();
				$data['nome_arquivo_original'] = $data_file['client_name'];
				$data['nome_arquivo_servidor'] = $data_file['file_name'];
				$data['tamanhoMB'] = $data_file['file_size']/1024;
				$data['formato_arquivo'] = str_replace('.', '', $data_file['file_ext']);
                                $data['chave'] = md5($config['file_name']);
			}
			else{
				$this->session->set_flashdata('msg', $this->upload->display_errors());
				redirect($this->controller);
			}
		}

		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["id_armazenamento"]) && $data["id_armazenamento"]){
                    
			//$data['data_atualizacao'] = date('Y-m-d H:i:s');
                        $data['data_atualizacao'] = ing_date($data['data_atualizacao']);
                    
			$rows_affected = $this->default_model->update($this->table, $_POST['id_armazenamento'], $data, 'id_armazenamento');
			$data['tipo'] = 'edicao';
                        
		}
		else{
			$date_now=date('Y-m-d H:i:s');
                        
                        $data['created'] = $date_now;
			$data['data_atualizacao'] = $date_now;
			$rows_affected = $this->default_model->insert($this->table, $data);
			$data["id_armazenamento"] = $this->db->insert_id();
			$data['tipo'] = 'novo';
		}

		if($data["id_armazenamento"]){

			//Recebe usuário
			$data['registro'] = $this->default_model->get_by_id($this->table, $data["id_armazenamento"], array($this->table.'.*, armazenamento_pasta.inscritos_id'), NULL, $this->join, 'id_armazenamento');
			$usuario = $this->default_model->get_by_id('inscritos', $data['registro']->inscritos_id);

			//carrega library de email
			$this->load->library('email');
			$config['protocol'] = 'mail';
			$config['mailtype'] = 'html';

			//Conteúdo do e-mail
			$conteudo = $this->load->view($this->dir.'email_arquivo', array('dados' => $data, 'usuario' => $usuario->nome), true);

			//Parâmetros
			$this->email->initialize($config);
			$this->email->from('luana@multiwebdigital.com.br', 'MB CONSULTORIA');
			$this->email->to($usuario->email, $usuario->nome);
			$this->email->subject('MB CONSULTORIA - ARMAZENAMENTO EM NUVEM');
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
		redirect(site_url('multitools/downloads_nuvens/index/'.$id_pasta));
	}

	public function excluir($id,$id_pasta){

		//Exclui registro
		if($this->default_model->update($this->table, $id, array('ativo' => 'N'), 'id_armazenamento')){
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
                
		$data_busca[$this->table.'.titulo']  = $this->input->get('s');
		$data_busca[$this->table.'.descricao_armazenamento']  = $this->input->get('s');
                $data_busca['armazenamento_pasta'.'.nome']  = $this->input->get('s');

		//Registros
		$offset = $this->input->get('per_page');
               $join= array('armazenamento_pasta' => array('where' => 'armazenamento_pasta.id_pasta = armazenamento_na_nuvem.armazenamento_pasta_id_pasta and armazenamento_na_nuvem.armazenamento_pasta_id_pasta='.$this->input->get('id_pasta'), 'type' => 'inner'));

		$data['registros'] = $this->default_model->get_by_search($this->table, array('*'), NULL, $offset, $this->per_page, $data_busca, $join, $this->table.'.id_armazenamento', 'DESC');
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