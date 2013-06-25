<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class downloads extends MY_Controller {

	//Retira a proteção deste controller
	protected $_dontProtectMe = true;

	var $graus_formacao = array('EF' => 'Ensino Fundamental', 'EM' => 'Ensino Médio', 'GR' => 'Graduação', 'PG' => 'Pós-graduação/MBA', 'ME' => 'Mestrado', 'DO' => 'Doutoria');
	var $tipos_contrato = array('CL' => 'CLT', 'PJ' => 'Prestador de Serviço (PJ)', 'TE' => 'Temporário', 'AU' => 'Autônomo', 'ES' => 'Estágio', 'TR' => 'Trainee');
	var $niveis_idiomas = array('N' => 'Nenhum', 'B' => 'Básico', 'I' => 'Intermediário', 'A' => 'Avançado', 'F' => 'Fluente');


	public function __construct(){

	parent::__construct();
                $data['title'] = 'MB Consultoria - Serviços';
		//Carrega model e helpers
		$this->load->model("default_model");
		$this->load->helper('url');
		$this->load->helper('html');
                $this->load->helper('text_helper');
                $this->load->library('pagination');
                $this->load->helper('auxiliar_helper');
                $this->load->helper(array('form', 'url'));


	}
        
        public function index1(){
            
            
            $this->loadView('teste_upload');
        }
       public function salva(){
            $filename=date('YmdHis').'.doc';
            
            $pasta='downloads';
            
            $config['upload_path'] = site_url('assets/'.$pasta);
            $config['file_name'] = $filename;
            $this->load->library('upload', $config);

            $this->downloads->salva();
            $data = array('upload_data' => $this->upload->data());   
            print_r($data);
            exit();
         
                    
        }
        
        
        
function upload_c(){
		
                $pasta='downloads';             
		$filename=date('YmdHis').'.doc';    
		
               $data= multiple_upload('userfile', './assets/uploads/'.$pasta.'/','gif|jpg|jpeg|jpe|png|doc',0,$filename);
               print_r($data);
               exit();
                
                
                /*
               //Library de Upload
		$config['upload_path']   = './assets/uploads/'.$pasta.'/';
		$config['allowed_types'] = 'pdf|doc|zip|jpeg|jpg|gif|png';
                $config['file_name'] = $filename;
                
		$this->load->library('upload', $config);
                
                //Upload da imagem
		if(!empty($_FILES['userfile']['name'])){
			if($this->upload->do_upload('userfile')){

				
				$data_file      = $this->upload->data();
				$data['imagem'] = $data_file['file_name'];
                                
                                print_r($data_file);
                                exit();
			}
			else{
				$this->session->set_flashdata('msg', $this->upload->display_errors());				
                                 print_r('não');
                                exit();
			}
                        
		}*/
	}	

        
        
        
        //esta função faz download direto sem estar logado
	public function function_($id_foto=false,$chave=false){
           
            if($id_foto==false ||$chave== false ) {
                redirect('http://www.disney.com.br/pt/');                
            }
            
            $this->db->select('*');
            $this->db->from('downloads_versoes');
            $this->db->where(array('id_download_versoes'=>$id_foto,'chave'=>$chave));
            $query=$this->db->get();
            if ($query->num_rows>0) {
                 $result= $query->result();
              
                  //Define o cabeçalho para download
                  header('Content-type: application/'.$result[0]->formato_arquivo);
                  header('Content-Disposition: attachment; filename="'.$result[0]->nome_arquivo_original.'"');
                  header("Content-Transfer-Encoding: binary");
                  header('Expires: 0');
                  header('Pragma: no-cache');
                  readfile(site_url('assets/uploads/downloads/'.$result[0]->nome_arquivo_servidor));
                
            }else{
               redirect('http://www.disney.com.br/pt/');  
            }
           
        }
        
       
	public function index(){
            $id=1;
            
            
            $this->db->select('downloads.*');
            $this->db->from('downloads_compras');
            $this->db->join('compras','downloads_compras.compras_id=compras.id');
            $this->db->join('downloads_versoes','downloads_versoes.id_download_versoes=downloads_compras.downloads_versoes_id_download_versoes');
            $this->db->join('downloads','downloads.id_downloads =downloads_versoes.downloads_id_downloads');
            $this->db->where(array('compras.status'=>'AP','downloads_compras.inscritos_id'=>$id));
            $query=$this->db->get();
            if($query->num_rows){
                foreach ($query->result() as $itens) {
                                       
                     $data['downloads'][]=array('id_downloads'=>$itens->id_downloads,'titulo'=>$itens->titulo,'descricao'=>$itens->descricao,'downloads_categorias_id_downloads_categorias'=>$itens->downloads_categorias_id_downloads_categorias);
                    
                }
                // essa parte estara direto na view              
                
                 $this->load->view('central_downloads/central_downloads',$data);
            }else{
                
                $this->load->view('central_downloads/central_downloads');
            }
          
            
 
            
            
            
            
            
            
        }
        
        
        
        
        
}