
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mysql extends MY_Controller {

	//Retira a proteção deste controller
	protected $_dontProtectMe = true;
        var $per_page =10;
	public function __construct(){
		parent::__construct();
                $data['title'] = 'MB Consultoria - notícias';
		//Carrega model e helpers
		$this->load->model("default_model");
		$this->load->helper('url');
		$this->load->helper('html');
                $this->load->helper('text_helper');
        
	}

	public function index(){
            $this->load->dbutil();
            
            
        $query = $this->db->query('show tables');
        $registros=$query->num_rows;
        $query =$query->result();
       
        
        for($x=0;$x<$registros;$x++){
            echo $query[$x]->Tables_in_mbconsultoria;
                if($this->dbutil->optimize_table($query[$x]->Tables_in_mbconsultoria)){
                    
                    echo '- sucesso';
                }
                else{
                   echo '--------------------------Erro------------------'; 
                }
            echo '<br>';
            
        }
        
                
        
        }
}