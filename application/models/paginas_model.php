<?php
class Paginas_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	/**
	 * buscaPaginaPorUrl
	 *
	 * Busca os dados da página, de acordo com a url passada
	 *
	 * @access public
	 * @author Luana Castilho
	 * @param  string
	 * @return integer
	 */
    function buscaPaginaPorUrl($url){

    	//Executa busca
    	$this->db->where('url', $url);
    	$query = $this->db->get('paginas');

    	//Retorno
    	return $query->row();
    }

}

/* End of file usuarios_model.php */
/* Location: ./application/models/multitools/usuarios_model.php */