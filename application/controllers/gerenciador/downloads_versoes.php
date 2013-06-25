<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Downloads_versoes extends CI_Controller {

	var $titulo 		= 'Versões de Downloads';
	var $dir 			= 'multitools/downloads_versoes/';
	var $controller 	= 'multitools/downloads_versoes';
	var $title_sing 	= 'Versão';
	var $per_page 		= 20;
	var $table 			= 'downloads_versoes';
	var $join			= array('downloads' => array('where' => 'downloads.id_downloads = downloads_id_downloads', 'type' => 'inner'));

	public function __construct(){
		parent::__construct();
		check_login();
	}

	public function index($download_id = false, $offset = 0){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//autodiagnóstico
		$data['downloads_id_downloads'] = $download_id;
		$where = array('downloads_id_downloads' => $data['downloads_id_downloads']);

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, downloads.titulo'), $offset, $this->per_page, $where, $this->join, $this->table.'.id_download_versoes', 'DESC');

		//Parâmetros
		$data['paginacao']   = $this->_pagination($this->table, false, $download_id);
		$data['controller']  = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	public function adicionar($download_id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Adicionar '.$this->title_sing;

		//Menu
		get_menu();

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Busca lista de autodiagnósticos
		$data['downloads_id_downloads'] = $download_id;
		$data['downloads'] = $this->default_model->listaAssociativa('downloads', 'titulo', NULL, array('id_downloads' => $data['downloads_id_downloads']), NULL, NULL, false, 'id_downloads');
		unset($data['downloads']['']);

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function editar($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar '.$this->title_sing;

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_download_versoes');

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Busca lista de autodiagnósticos
		$data['downloads'] = $this->default_model->listaAssociativa('downloads', 'titulo', NULL, array('id_downloads' => $data['registro']->downloads_id_downloads), NULL, NULL, false, 'id_downloads');
		unset($data['downloads']['']);

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function salvar()
	{
		//Recebe Post
		$data = $_POST;

		//Library de Upload
		$config['upload_path']   = './assets/uploads/downloads/';
		$config['file_name']     = date('YmdHis');
    
                   $config['allowed_types']="*";   
		$this->load->library('upload', $config);

		//Upload da imagem
		if(!empty($_FILES['nome_arquivo_original']['name'])){
			if($this->upload->do_upload('nome_arquivo_original')){

				if(isset($data["id_download_versoes"]) && $data["id_download_versoes"]){
					$registro = $this->default_model->get_by_id($this->table, $data["id_download_versoes"], array('*'), NULL, NULL, 'id_download_versoes');
					@unlink('./assets/uploads/'.$registro->nome_arquivo_original);
				}
				$data_file      = $this->upload->data();
				$data['nome_arquivo_original'] = $data_file['client_name'];
				$data['nome_arquivo_servidor'] = $data_file['file_name'];
				$data['tamanhoMB'] = $data_file['file_size']/1024;
				$data['formato_arquivo'] = str_replace('.', '', $data_file['file_ext']);
			}
			else{
				$this->session->set_flashdata('msg', $this->upload->display_errors());
				redirect($this->controller);
			}
		}

		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["id_download_versoes"]) && $data["id_download_versoes"]){
			//Update
			$rows_affected = $this->default_model->update($this->table, $_POST['id_download_versoes'], $data, 'id_download_versoes');
		}
		else{
			$data['created'] = date('Y-m-d H:i:s');
			$data['chave']   = md5(date('Y-m-d H:i:s'));
			$rows_affected = $this->default_model->insert($this->table, $data);
			$id_versao = $this->db->insert_id();

			if($id_versao){

				$data['registro'] = $this->default_model->get_by_id($this->table, $id_versao, array($this->table.'.*, downloads.titulo'), NULL, $this->join, 'id_download_versoes');

				$join = array('downloads_versoes' => array('where' => 'downloads_versoes.id_download_versoes = downloads_compras.downloads_versoes_id_download_versoes', 'type' => 'inner'),
							  'downloads' => array('where' => 'downloads.id_downloads = downloads_versoes.downloads_id_downloads', 'type' => 'inner'),
							  'inscritos' => array('where' => 'inscritos.id = downloads_compras.inscritos_id', 'type' => 'inner')
							);
				$usuarios_download = $this->default_model->get_all('downloads_compras', array('downloads_compras.*, downloads.titulo, inscritos.nome, inscritos.email'), 0, NULL, array('downloads.id_downloads' => $data['downloads_id_downloads']), $join);

				foreach($usuarios_download as $usuario){

					//carrega library de email
					$this->load->library('email');
					$config['protocol'] = 'mail';
					$config['mailtype'] = 'html';

					//Conteúdo do e-mail
					$conteudo = $this->load->view($this->dir.'email_nova_versao', array('dados' => $data, 'usuario' => $usuario->nome), true);

					//Parâmetros
					$this->email->initialize($config);
					$this->email->from('luana@multiwebdigital.com.br', 'MB CONSULTORIA');
					$this->email->to($usuario->email, $usuario->nome);
					$this->email->subject('MB CONSULTORIA - NOVA VERSÃO DE DOWNLOAD');
					$this->email->message($conteudo);
					$this->email->send();
				}
			}
		}

		//Mensagem de retorno
		if($rows_affected == 1)
			$msg = 'Dados salvos com sucesso.';
		else
			$msg = 'Não foi possível salvar os dados.';

		//Retorno
		$this->session->set_flashdata('msg', $msg);
		redirect($this->controller.'/index/'.$data['downloads_id_downloads']);
	}

	public function excluir($id){

		//Exclui registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_download_versoes');

		//Exclui registro
		if($this->default_model->update($this->table, $id, array('ativo' => 'N'), 'id_download_versoes'))
			$this->session->set_flashdata('msg', 'Registro desativado com sucesso!');
		else
			$this->session->set_flashdata('msg', 'Registro não foi desativado!');

		//Retorno
		redirect($this->controller.'/index/'.$data['registro']->downloads_id_downloads);
	}

	private function _pagination($table, $search = FALSE, $download_id){

		//Carrega library de paginação
		$this->load->library('pagination');
		$config['per_page']   = $this->per_page;
		$config['last_link']  = 'Última';
		$config['first_link'] = 'Primeira';

		//where
		$where = array('downloads_id_downloads' => $download_id);

		//Parâmetro
		if($search){
			$config['page_query_string'] = TRUE;
			$config['total_rows']        = $this->default_model->count_by_search($this->table, $search, $where, $this->join);
			$config['base_url']          = base_url().$this->controller.'/buscar?s='.$this->input->get('s').'&download_id='.$download_id;
		}
		else{
			$config['uri_segment'] = 5;
			$config['total_rows']  = $this->default_model->count($this->table, $where, $this->join);
			$config['base_url']    = base_url().$this->controller.'/index/'.$download_id;
		}

		//Inicializa e retorna paginação
		$this->pagination->initialize($config);
		return $this->pagination->create_links();

	}

	public function buscar(){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//Parâmetros de busca
		$data_busca['downloads.titulo']  = $this->input->get('s');
		$data_busca['downloads.descricao']  = $this->input->get('s');
		$data_busca[$this->table.'.descricao_versao']  = $this->input->get('s');
		$data['downloads_id_downloads'] = $this->input->get('download_id');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, downloads.titulo'), array('downloads_id_downloads' => $data['downloads_id_downloads']), $offset, $this->per_page, $data_busca, $this->join, $this->table.'.id_download_versoes', 'DESC');
		$data['paginacao'] = $this->_pagination($this->table, $data_busca, $data['downloads_id_downloads']);

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