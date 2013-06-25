<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('AppGetQuestions')){
    function AppGetQuestions(){
        $CI =& get_instance();
        $Idcurrent_user =$CI->session->userdata('SessionIdAluno');
        $IdChat =1; //$_SESSION['current_chat'];
        
        $CI->db->select('IdMensagem,Mensagem');
        $CI->db->from('Chat');
        $CI->db->where(array('Status'=>'pergunta-aberta','IdChat'=>$IdChat));
        $CI->db->order_by('IdMensagem DESC');       
        $query = $CI->db->get();                
        $data['array']= $query->result();

        //faz um looping e cria um array com os campos da consulta
          foreach ($data['array'] as $array) {          
          //mostra na tela o nome e a data de nascimento
          echo '<li id="'.$array->IdMensagem.'" class="checkBox"><input type="checkbox" class="check-for-question" value="'.$array->IdMensagem.'" name="checked-for-question[]" id="">'.$array->Mensagem.'</li>';
          }
        
    }
}
  if (! function_exists('AppGetMsg')){
    function AppGetMsg(){
        $CI =& get_instance();
        $Idcurrent_user =$CI->session->userdata('SessionIdAluno');
        $IdChat =1; //$_SESSION['current_chat'];
        
        $CI->db->select('IdMensagem,Mensagem,DataHoraMensagem,Status,MensagemRespostaDe,IdAutor');
        $CI->db->from('Chat');
        $CI->db->where(array('IdChat'=>$IdChat));
        $CI->db->order_by('DataHoraMensagem DESC');       
        $query = $CI->db->get();                
        $data['registro']= $query->result();
        
        //faz um looping e cria um array com os campos da consulta
        foreach ($data['registro'] as $itens) {
        //mostra na tela o nome e a data de nascimento
            if($itens->Status=='resposta'){
                if ($Idcurrent_user==$itens->IdAutor) {
                    echo '<li class="li-no-question current_author_on" id="'.$itens->IdMensagem.'">'.$itens->Mensagem;
                }else{
                    echo '<li class="li-no-question" id="'.$itens->IdMensagem.'">'.$itens->Mensagem;
                }
                echo '<ul class="resposta">';
      
                $arr=explode(",",$itens->MensagemRespostaDe);
                
                foreach ($arr as $perguntaRespondida) {
            
                    $CI->db->select('IdMensagem,Mensagem,IdAutor');
                    $CI->db->from('Chat');
                    $CI->db->where(array('IdChat'=>$IdChat,'IdMensagem'=>$perguntaRespondida));
                    $CI->db->order_by('DataHoraMensagem DESC');       
                    $query = $CI->db->get();                
                    $data['array']= $query->result();

                    foreach ($data['array'] as $array2) {

                        if ($Idcurrent_user==$array2->IdAutor) {
                            echo '<li class="current_author_on" id="'.$array2->IdMensagem.'">'.$array2->Mensagem.'</li>';
                        }else{
                            echo '<li id="'.$array2->IdMensagem.'">'.$array2->Mensagem.'</li>';
                        }
                    }
                }
                echo '</ul></li>';
            }else{
                if ($Idcurrent_user==$itens->IdAutor) {
                    echo '<li class="li-no-question current_author_on" id="'.$itens->IdMensagem.'">'.$itens->Mensagem;
                }else{
                    echo '<li class="li-no-question" id="'.$itens->IdMensagem.'">'.$itens->Mensagem;
                } 	
            }

       }
    }
}
if (! function_exists('AppCountMsg')){
    
    function AppCountMsg(){
        $CI =& get_instance();
        $CI->db->select('IdMensagem');
        $CI->db->from('Chat');
        //$CI->db->where(array('IdMensagem'=>$Pergunta));
        $CI->db->order_by('IdMensagem DESC');       
        $query = $CI->db->get();                
        $data['registro']= $query->result();
        echo $data['registro'][0]->IdMensagem;
    }
}
if (! function_exists('AppSetMsg')){
    function AppSetMsg(){ 
            
            $CI =& get_instance(); 
            if ($_POST){
                $IdAutor = $CI->session->userdata('SessionIdAluno');
                $IdChat = $_POST['id-chat'];
                $Mensagem = $_POST['mensagem'];
                $DataHoraMensagem = date("Y-m-d H:i:s");
                $Status = $_POST['status'];

                if ($Mensagem != ''){
                        $data = array(
                            'IdAutor' => $IdAutor,
                            'IdChat' => $IdChat ,
                            'Mensagem' => $Mensagem,
                            'DataHoraMensagem' => $DataHoraMensagem,                   
                            'Status' => $Status

                         );
                        $CI->db->insert('Chat', $data); 
                       //$CI->loadView('area-restrita-chat',$data);
                }
        }
    }
}

if (! function_exists('AppSetQuestions')){
    function AppSetQuestions(){
        $CI =& get_instance();  
       if ($_POST){
            $IdAutor = $_POST['current-user'];
            $IdChat = $_POST['id-chat'];
            $Mensagem = $_POST['mensagem'];
            $DataHoraMensagem = date("Y-m-d H:i:s");
            $Status = 'resposta';

            $MensagemRespostaDe = implode(',',$_POST['checked-for-question']);
            if ($Mensagem != ''&& $MensagemRespostaDe){
                $data = array(
                    'IdAutor' => $IdAutor,
                    'IdChat' => $IdChat ,
                    'Mensagem' => $Mensagem,
                    'DataHoraMensagem' => $DataHoraMensagem,                   
                    'Status' => $Status,
                    'MensagemRespostaDe'=>$MensagemRespostaDe

                 );

                $CI->db->insert('Chat', $data); 

                if ($_POST['checked-for-question']) {
                        foreach ($_POST['checked-for-question'] as $Pergunta) {
                                $data = array(                                           
                                'Status' => 'pergunta-respondida'                       

                             );
                             $CI->db->where(array('IdMensagem'=>$Pergunta));
                             $CI->db->update('Chat',$data);
                         }
                }
            }
        }
    }
}