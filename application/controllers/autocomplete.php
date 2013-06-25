
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class autocomplete extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
	}

	public function index($nome=false){
            if($nome){
                //Nome|Código
                $this->db->select('id,nome');
                $this->db->from('usuario');
                $this->db->like(array('nome'=>$nome));
                $query= $this->db->get();
                $result=$query->result();
                foreach ($result as $item) {                    
                    echo($item->nome.'|'.$item->id);                    
                    
                }
                
            }            
            
        }
}