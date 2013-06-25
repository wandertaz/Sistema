<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Galerias extends CI_Controller {

	var $titulo 		= 'Galerias';
	var $dir 			= 'multitools/galerias/';
	var $controller 	= 'multitools/galerias';
	var $title_sing 	= 'Galeria';
	var $per_page 		= 20;
	var $table 			= 'galerias';
	var $join			= NULL;

	public function __construct(){
		parent::__construct();
		check_login();
		$this->load->helper("br_date_helper");
	}

	public function index($offset = 0){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*'), $offset, $this->per_page, array(), $this->join, $this->table.'.id', 'DESC');

		//Parâmetros
		$data['paginacao']   = $this->_pagination($this->table);
		$data['controller']  = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	public function adicionar(){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Adicionar '.$this->title_sing;

		//Menu
		get_menu();

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function editar($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar '.$this->title_sing;;

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id);

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function salvar()
	{
		//Recebe Post
		$data = $_POST;

		//Trata os dados
		$data['data'] = w3c_date($_POST['data']);

		//Library de Upload
		$config['upload_path']   = './assets/uploads/';
		$config['allowed_types'] = 'jpeg|jpg|gif|png';
		$this->load->library('upload', $config);

		//Upload da imagem
		if(!empty($_FILES['imagem']['name'])){
			if($this->upload->do_upload('imagem')){

				if(isset($data["id"]) && $data["id"]){
					$registro = $this->default_model->get_by_id($this->table, $data["id"]);
					@unlink('./assets/uploads/'.$registro->imagem);
				}
				$data_file      = $this->upload->data();
				$data['imagem'] = $data_file['file_name'];
			}
			else{
				$this->session->set_flashdata('msg', $this->upload->display_errors());
				redirect($this->controller);
			}
		}

		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["id"]) && $data["id"])
			$rows_affected = $this->default_model->update($this->table, $_POST['id'], $data);
		else{
			$data['url']   = sanitize_title_with_dashes($data['titulo']);
			$rows_affected = $this->default_model->insert($this->table, $data);
		}

		//Mensagem de retorno
		if($rows_affected == 1)
			$msg = 'Dados salvos com sucesso.';
		else
			$msg = 'Não foi possível salvar os dados.';

		//Retorno
		$this->session->set_flashdata('msg', $msg);
		redirect($this->controller);
	}

	public function excluir($id){

		//Exclui registro
		if($this->default_model->delete($this->table, array('id'=>$id)))
			$this->session->set_flashdata('msg', 'Registro excluído com sucesso!');
		else
			$this->session->set_flashdata('msg', 'Registro não foi excluído!');

		//Retorno
		redirect($this->controller);
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

	public function buscar(){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//Parâmetros de busca
		$data_busca[$this->table.'.titulo']  = $this->input->get('s');
		$data_busca[$this->table.'.descricao'] = $this->input->get('s');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*'), NULL, $offset, $this->per_page, $data_busca, $this->join, $this->table.'.id', 'ASC');
		$data['paginacao'] = $this->_pagination($this->table, $data_busca);

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	/**
	 * fotos
	 *
	 * Exibe a página de gerenciamento de fotos para inserção e visualização
	 *
	 */
	public function fotos($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Fotos da Galeria';
		$data['id'] = $id;

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Menu
		get_menu();

		//Fotos
		$data['registros'] = $this->default_model->get_all('galerias_fotos', array('*'), NULL, NULL, array('galeria_id' => $id), NULL, 'id', 'DESC');

		//Carrega view
		$this->load->view($this->dir.'fotos', $data);
		get_footer(TRUE);
	}

	public function salvar_fotos() {

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		if($this->input->post('id')){

			$data['controller']  = $this->controller;

			$data['upload_path']        = $upload_path          = 'assets/uploads/';
			$data['destination_thumbs'] = $destination_thumbs   = 'assets/uploads/';

			$data['large_photo_exists'] = $data['thumb_photo_exists'] = $data['error'] = NULL ;
			$data['thumb_width']        = "84";
			$data['thumb_height']       = "85";

			$this->load->library('image_moo') ;

			//Verifica se upload de imagem foi realizado
			if (!empty($_POST['upload'])) {

				if(empty($_FILES['image']['name'])){
					$this->session->set_flashdata('msg', "Selecione uma foto para continuar");
					redirect(site_url().'multitools/galerias/fotos/'.$this->input->post('id'));
				}

				//Carrega library de upload
				$config['upload_path']   = $upload_path ;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->load->library('upload', $config);

				//Executa uplaod
				if ($this->upload->do_upload("image")) {

					//Recebe os dados da imagem
					$data['img'] = $this->upload->data();

					//Faz resize de imagem temporária
					$config_t['new_image']   	= './assets/uploads/temp/'.$data['img']['file_name'];
					$config_t['image_library'] 	= 'gd2';
					$config_t['source_image'] 	= './assets/uploads/'.$data['img']['file_name'];
					$config_t['maintain_ratio'] = true;
					$config_t['width']	 		= 460;
					$config_t['height'] 		= 700;
					$this->load->library('image_lib', $config_t);
					$this->image_lib->resize();

					//Recebe imagem
					$data['large_photo_exists']  = "<img src=\"".base_url() . $upload_path.'temp/'.$data['img']['file_name']."\" />";

					//Recebe dados da imagem temporária
					$data['img_info'] = getimagesize('./assets/uploads/temp/'.$data['img']['file_name']);
					$data['id'] = $this->input->post('id');

					//Insere foto no banco
					$dados_galeria = array('galeria_id' => $this->input->post('id'), 'foto' => $data['img']['file_name']);
					$this->default_model->insert('galerias_fotos', $dados_galeria);
				}
			}
			//Verifica se upload do thumb foi realizado
			elseif (!empty($_POST['upload_thumbnail'])) {

				//Recebe os dados do crop
				$x1 = $this->input->post('x1',TRUE);
				$y1 = $this->input->post('y1',TRUE);
				$x2 = $this->input->post('x2',TRUE);
				$y2 = $this->input->post('y2',TRUE);
				$w  = $this->input->post('w',TRUE);
				$h  = $this->input->post('h',TRUE);

				//faz crop com a imagem de upload
				$file_name = $this->input->post('file_name',TRUE);
				if($file_name) {

					//Executa crop e salva o thumb da imagem
					$this->image_moo->load($upload_path .'temp/'.$file_name)->crop($x1,$y1,$x2,$y2)->save($destination_thumbs.'thumb_'.$file_name);

					//Exclui imagem temporária
					@unlink($upload_path .'temp/'.$file_name);

					//Retorno
					if ($this->image_moo->errors){
						$this->session->set_flashdata('msg', "Erro:".$this->image_moo->display_errors());
						redirect(base_url().'multitools/galerias/fotos/'.$this->input->post('id'));
					}
					else {
						$this->session->set_flashdata('msg', ' Foto cadastrada com sucesso!');
						redirect(base_url().'multitools/galerias/fotos/'.$this->input->post('id'));
					}
				}
				else{
					$this->session->set_flashdata('msg', "Erro ao cadastrar foto.");
					redirect(base_url().'multitools/galerias/fotos/'.$this->input->post('id'));
				}

			}
		}
		else
			return $this->index();

		//Carrega view
		$this->load->view($this->dir.'fotos',$data) ;
		get_footer(TRUE);
	}

	/**
	 * excluir_foto
	 *
	 * Executa a exclusão da foto, de acordo com o id passado
	 *
	 */
	public function excluir_foto($id){

		//Extrai id
		$id = explode("-", $id);

		//Executa exclusão e exibe mensagem de retorno
		if($this->default_model->delete('galerias_fotos', array('id' => $id[0]))){
			$this->session->set_flashdata('msg', "Foto Excluída com Sucesso!");
			redirect(base_url().'multitools/galerias/fotos/'.$id[1]);
		}
		else{
			$this->session->set_flashdata('msg', "Erro ao excluir a foto!");
			redirect(base_url().'multitools/galerias/fotos/'.$id[1]);
		}
	}
}

/* End of file usuarios.php */
/* Location: ./application/controllers/multitools/usuarios.php */