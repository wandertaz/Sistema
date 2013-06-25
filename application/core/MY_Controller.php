<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Extensão do controller padrão
 *
 * Seta a localidade e (se necessário) verifica a autencidade do Usuário
 *
 *
 * @author  Luana Castilho
 * @since   07/2012
 */
abstract class MY_Controller extends CI_Controller {

    //Controla se um controller filho será protegido ou não
    protected $_dontProtectMe = false;

    /**
     * Construtor
     *
     * Carrega os models e helpers, seta a localidade e autentica se necessário.
     *
     * @access public
     * @author  Luana Castilho
     * @return void
     */
    public function __construct() {
        parent::__construct();

        //Seta a localidade
        setlocale(LC_ALL, "pt_BR", "pt-br", "pt", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");

    	//Carrega model e helpers
    	$this->load->model("default_model");
    	$this->load->model("idiomas_model");
    	$this->load->model("paginas_model");
    	$this->load->helper("br_date_helper");
    	$this->load->helper('clean_str');
    	$this->load->helper('login_helper.php');

        //Verifica a necessidade de autenticar o operador
        if(!$this->_dontProtectMe) {

            //Autentica usuário
            check_login();
        }

    	//Seta o idioma padrão baseado no header passado pelo navegador
    	if(!$this->session->userdata('idioma') && !empty($_SERVER["HTTP_ACCEPT_LANGUAGE"])) {
    		//Seta o idioma
    		$this->setLanguage("portugues");
    	}
    }

	/**
	 * __loadView
	 *
	 * Executa as ações comuns para o carregamento de uma view
	 *
	 *
	 * @access public
	 * @author Luana Castilho
	 * @param  string
	 * @param  array
	 * @return void
	 */
	public function loadView($view, $data = array()) {

		//Busca o idioma
		$data["idioma"] = $this->session->userdata('idioma');

		//Busca os textos da página conforme o idioma
		$this->load->language("site", $data["idioma"]);
		$textos = $this->lang->line($view);
		$textos = ($textos ? $textos : array());
		$textos = array_merge($textos, $this->lang->line("geral"));

		//Adiciona os textos aos dados
		$data = array_merge($data, $textos);

		//Busca os dados da página
		if(isset($data['url_pagina']))
			$data['pagina'] = $this->paginas_model->buscaPaginaPorUrl($data['url_pagina']);

		//Carrega a view
		$data["view"] = $view;
		
		// Define links das redes sociais
		$data['link_facebook'] = 'http://www.facebook.com/mb_consultoria';
		$data['link_twitter'] = 'http://www.twitter.com/mb_consultoria';
		$data['link_youtube'] = 'http://www.youtube.com/mb_consultoria';
		$data['link_linkedin'] = 'http://www.linkedin.com/mb_consultoria';

		// Exibe o view
		$this->load->view($view, $data);


	}

	/**
	 * __setLanguage
	 *
	 * Troca o idioma conforme a pasta passada
	 *
	 * @access public
	 * @author Luana Castilho
	 * @param  string
	 * @return void
	 */
	public function setLanguage($pasta = "portugues") {

		//Verifica se o idioma já está setado
		if($this->session->userdata('idioma') && $this->session->userdata('idioma') == $pasta && $this->session->userdata('idioma_id'))
			return true;
		else{

			//Busca id do idioma
			$this->load->model('idiomas_model');
			$idioma_id = $this->idiomas_model->buscaIdiomaPorUrl($pasta);

			//Grava o idioma na sessão e seu id
			$this->session->set_userdata("idioma", $pasta);
			$this->session->set_userdata("idioma_id", $idioma_id);
		}
	}

}
?>
