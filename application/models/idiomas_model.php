<?php
class Idiomas_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	/**
	 * buscaIdiomaPorUrl
	 *
	 * Busca o id do idioma, de acordo com a url passada
	 *
	 * @access public
	 * @author Luana Castilho
	 * @param  string
	 * @return integer
	 */
    function buscaIdiomaPorUrl($url){

    	//Executa busca
    	$this->db->where('url', $url);
    	$query = $this->db->get('idiomas');
    	$idioma = $query->row();

    	//Recebe o id
    	$idioma_id = ($query->row() ? $query->row()->id : false);

    	//Retorno
    	return $idioma_id;
    }

}

/* End of file usuarios_model.php */
/* Location: ./application/models/multitools/usuarios_model.php */