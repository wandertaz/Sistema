<?php
class Usuarios_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function login(array $data){

    	$this->db->where('usuario.login', $data['login']);
		$this->db->where('usuario.senha', md5($data['senha']));
    	$query = $this->db->get('usuario');
        return $query->row();
    }

}

/* End of file usuarios_model.php */
/* Location: ./application/models/multitools/usuarios_model.php */