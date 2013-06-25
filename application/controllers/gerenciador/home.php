<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	var $titulo = 'Página Inicial';
	var $dir = 'multitools/';

	public function __construct()
    {
		parent::__construct();

		$this->load->helper('login');
		check_login();
    }

	public function index()
	{
		$title = 'Página Inicial';
		get_header($title, TRUE);

		$data['h1'] = 'Seja bem-vindo ao Multitools!';

		get_menu();
              
    	$this->load->view($this->dir.'home', $data);

    	get_footer(TRUE);
	}


	/**
	 * retorna_cursos_por_tipo
	 *
	 * Retorna uma lista com os cursos, de acordo com o tipo de curso (Aberto, In Company, Alta Performance, Programa de Desenvolvimento)
	 *
	 */
	public function retorna_cursos_por_tipo($tipo = false){

		//Valida tipo
		if(!$tipo){
			echo json_encode(array('' => 'Selecione o Tipo de Curso'));
			exit;
		}

		//Busca cursos
		$tabela_cursos = ($tipo == 'AB' ? 'cursos_abertos' : ($tipo == 'IN' ? 'cursos_incompany' : ($tipo == 'AL' ? 'programas_alta_performance' : 'programas_desenvolvimento')));
		$data['cursos'] = $this->default_model->listaAssociativa($tabela_cursos, 'titulo', array());
		$data['cursos'][''] = 'Curso';

		//Retorna lista ao javascript
		echo json_encode($data['cursos']);
	}
}

/* End of file home.php */
/* Location: ./application/controllers/multitools/home.php */