<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class comentarios extends MY_Controller {

 

	//Retira a proteção deste controller

	protected $_dontProtectMe = true;

        

	public function __construct(){

		parent::__construct();

                $data['title'] = 'MB Consultoria - Serviços';

		//Carrega model e helpers

		$this->load->model("default_model");

		$this->load->helper('url');

		$this->load->helper('html');

                $this->load->helper('text_helper');

                //$this->load->helper('email');

                //$this->load->library('email');

	}



	public function index(){

            

            $titulo='Comentários';

            $msg='Envie seu comentário.';

            $action='comentarios/SalvaComentarios';

            $nomebotao='Comentar';

            $area=$_GET['area'];

            $id=$_GET['ID'];

            $tituloarea=$_GET['tituloarea'];

            $data= array('action'=>$action,'titulo'=>$titulo,'msg'=>$msg,'nomebotao'=>$nomebotao,'area'=>$area,'id'=>$id,'tituloarea'=>$tituloarea);		

           

            //Carrega view
            $this->loadView('comentarios', $data);

                

        }

        

       public function SalvaComentarios(){

           



               $datahora =date("Y-m-d H:i:s");                        

                $data =array('nome'=>$_POST['nome'].' '.$_POST['sobrenome'],'email'=>$_POST['email'], 'comentario'=>$_POST['mensagem'], 'area'=>$_POST['AreaComentada'],'registro_id'=>$_POST['id'],'titulo_registro'=>$_POST['tituloarea'],'ativo'=>'N','created'=>$datahora);

                $return=$this->default_model->insert('comentarios',$data);

                
               if ($return!=0){
                   
                 $data=array('msg'=>'Comentário foi enviado com  sucesso.','titulo'=>'Comentários','sucesso'=>'1');  
                   
               }
               else{
                   
                   $data=array('msg'=>'Erro o comentário não foi enviado','titulo'=>'Comentários','sucesso'=>'0'); 
                   
               }
               
               
                //echo 'O comentário foi enviado com sucesso';
                $this->loadView('mensagem-retorno', $data);
           

      		

        }  

        

        

        

}

