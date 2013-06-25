<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class orcamento_online extends MY_Controller {

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


	}
        
        public function index($tipo_orcamento=false,$msg=false) {           
           
            		//Título
		$data['title'] = 'Orçamento On line';
		$data['url_pagina'] = 'orcamento-on-line';
            
            
            
            if ($this->session->userdata('SessionIdEmpresa')>0){                    
               
                    $id= $this->session->userdata('SessionIdEmpresa');              
                    $this->db->select('nome,cpf_cnpj,email,telefone,celular');
                    $this->db->from('inscritos');
                    $this->db->where(array('id'=>$id,'ativo'=>'S'));
                    $query=$this->db->get();
                    foreach ($query->result() as $item) {               
                        $data['empresa']=array('nome'=>$item->nome,'cnpj'=>$item->cpf_cnpj,'email'=>$item->email,'telefone'=>$item->telefone,'celular'=>$item->celular);
                    }
            }
            
            $data['tipo_orcamento']= $tipo_orcamento;
            $data['msg']= $msg;
            $this->loadView('orcamento_online/tela_inicial',$data);
             
             
        }
        
        public function salva_dados($tipo_orcamento=false) {
                    //Título
                    $data['title'] = 'Orçamento On line';
                    $data['url_pagina'] = 'orcamento-on-line';
                        
                    if(!$_POST){
                      //  return $this->index($tipo_orcamento,'Favor preencher o formulário do orçamento!'); 
                    }
                    if($_POST['form_tela_inicial_empresa']=='' || $_POST['form_tela_inicial_cnpj']=='' || $_POST['form_tela_inicial_email']=='' || $_POST['form_tela_inicial_responsavel_orcamento']=='' || $_POST['form_tela_inicial_cargo_responsavel']=='' || $_POST['form_tela_inicial_responsavel_tel_direto']=='' || $_POST['form_tela_inicial_responsavel_celular']==''){
                        return $this->index($tipo_orcamento,'Favor preencher todos os campos Obrigatórios');                         
                    }
                    $dados=array(                  
                        'nome_empresa'=>$_POST['form_tela_inicial_empresa'],
                        'cnpj'=>$_POST['form_tela_inicial_cnpj'],
                        'email_resposta'=>$_POST['form_tela_inicial_email'],
                        'nome_responsavel'=>$_POST['form_tela_inicial_responsavel_orcamento'],
                        'cargo_responsavel'=>$_POST['form_tela_inicial_cargo_responsavel'],
                        'telefone'=>$_POST['form_tela_inicial_responsavel_tel_direto'],
                        'celular'=>$_POST['form_tela_inicial_responsavel_celular'],
                        'tipo_orcamento'=>$tipo_orcamento,
                        'created'=>date('Y-m-d H:i:u'),
                    );
                   
                   $this->db->insert('orcamento_online',$dados);
                   $id_orcamento_online = $this->db->insert_id();                   
                   //redirect($this->orcamento($tipo_orcamento,$id_orcamento_online));
                    $data['tipo_orcamento']= $tipo_orcamento;
                    $data['id_orcamento_online']=$id_orcamento_online;
                    
                   $this->loadView('orcamento_online/orcamento_formulario',$data);
             
        }
        
        
        
        public function salvar_orcamento($tipo_orcamento=false,$id_orcamento_online=false) {
            
                
            $data=$_POST;
                
            switch($tipo_orcamento):
                    case 'TR': //(TR) Treinamento 
                            $valores = array(
                                    array(1750,2200,3300,4950,5940,7120),
                                    array(2020,2640,4100,5940,7120,8200),
                                    array(3500,5000,6000,7200,8500,9000),
                                    array(3800,5500,6500,7600,8800,9500),
                                    array(4500,5500,6500,7600,8800,9500),
                                    array(5000,5500,6500,7600,8800,9500),
                                    array(5500,5500,6500,7600,8800,9500),
                            );
                        
                            $linha =  array('Até 10 pessoas','11 a 20 pessoas','21 a 40 pessoas','41 a 60 pessoas','61 a 150 pessoas','151 a 300 pessoas','Acima de 300 pessoas');
                            $coluna = array('2 Horas','4 Horas','8 a 10 Horas','12 a 16 Horas','16 a 20 Horas','Acima de 20 Horas');
                            break;

                    case 'AI': //(AI) Auditoria Interna
                            $valores = array(
                                    array(4800,4200,3600),
                                    array(5200,4800,4500),
                                    array(6000,5600,5200),
                                    array(6600,6350,6000),
                            );
                          $linha =  array('1 a 49','55 a 99','100 a 200','Acima de 200');
                          $coluna = array('Menos de 1 Ano','1 a 3 Anos','Acima de 3 Anos');
                        
                            break;

                    case 'PB': //(PB) Orcamento On Line_PBQP-h 
                            $valores = array(
                                    array(28200,28900,30850,33450,38250),
                                    array(29840,30720,31880,34320,39720),
                                    array(30480,31650,32480,35480,41500),
                                    array(31720,32780,33360,37600,43200),
                                    array(33560,34320,36720,39720,45460),
                            );
                          $linha =  array('Até 15','16 a 50','51 a 150','151 a 500','Acima de 500');
                          $coluna = array('6 a 8 meses','8 a 10 meses','10 a 12 meses','12 a 14 meses','Acima de 14 meses');
                            break;

                    case 'GS': //(GS) Sistema Gestão Responsabilidade Social 
                            $valores = array(
                                    array(28910,30620,33520,38750,41220),
                                    array(29920,31780,34380,39620,42240),
                                    array(30600,32430,35720,40580,43720),
                                    array(31280,33180,36880,41420,46480),
                                    array(34190,36820,39860,45780,49190),
                            );
                          $linha =  array('Até 15','16 a 50','51 a 150','151 a 500','Acima de 500');
                          $coluna = array('6 a 8 meses','8 a 10 meses','10 a 12 meses','12 a 14 meses','Acima de 14 meses');
                            break;

                    case 'SS': //(SS) Sistema Saúde e Segurança                
                            $valores = array(
                                    array(28900,30620,33450,38450,40820),
                                    array(29920,31780,34380,39620,42240),
                                    array(30600,32430,35720,40580,42720),
                                    array(31280,33180,36880,41420,44180),
                                    array(34120,36820,39720,45280,49000),
                                    //array(5000,5500,6500,7600,8800,9500),
                                   // array(5500,5500,6500,7600,8800,9500),
                            );
                          $linha =  array('Até 15','16 a 50','51 a 150','151 a 500','Acima de 500');
                          $coluna = array('6 a 8 meses','8 a 10 meses','10 a 12 meses','12 a 14 meses','Acima de 14 meses');
                            break;

                    case 'GA': //(GA) Sistema Gestão Ambiental_ISO14001
                            $valores = array(
                                    array(28900,30600,33150,38250,40800),
                                    array(29920,31680,34320,39600,42247),
                                    array(30600,32400,35100,40500,43200),
                                    array(31280,33120,35880,41400,44160),
                                    array(34120,36680,39720,45380,48320),
                            );
                            $linha =  array('Até 15','16 a 50','51 a 150','151 a 500','Acima de 500');
                            $coluna = array('6 a 8 meses','8 a 10 meses','10 a 12 meses','12 a 14 meses','Acima de 14 meses');
                            break;

                    case 'SQ'://(SQ) Sistema Gestão da Qualidade_ISO9001    
                            $valores = array(
                                    array(27200,28900,30600,33150,38250),
                                    array(27840,29920,31680,34320,39600),
                                    array(28480,30600,32400,35100,40500),
                                    array(29440,31280,33120,35880,41400),
                                    array(32720,34000,36000,39720,45380),
                            );
                            $linha =  array('Até 15','16 a 50','51 a 150','151 a 500','Acima de 500');
                            $coluna = array('6 a 8 meses','8 a 10 meses','10 a 12 meses','12 a 14 meses','Acima de 14 meses');
                        
                            break;

                    break;
                    default: break;
            endswitch;

 
                  $acrescimo=0;
                  $valor=0;
                    if($tipo_orcamento=='AI'){    
                         $valor = $valores[$data['qt_colaboradores_envolvidos']][$data['qtd_tempo_certificada']];
                         
                          if($data['qtd_unidades_certificadas']>1){
                             $acrescimo=($valor/100)*10;
                             $valor+=$acrescimo;
                          }
                          
                          if($data['localizacao_unidade']!='Manaus'){
                             $acrescimo=($valor/100)*10;
                             $valor+=$acrescimo;
                             
                          }
                          
                          $data['qt_colaboradores_envolvidos']= $linha[$data['qt_colaboradores_envolvidos']];
                          $data['qtd_tempo_certificada']=$coluna[$data['qtd_tempo_certificada']];
                           
                          
                    }elseif($tipo_orcamento=='PB'){                        
                         $valor = $valores[$data['qt_participantes']][$data['expectativa_certificacao']];  
                         if($data['form_orcamento_iso9001']=='Sim'){
                             $acrescimo=($valor/100)*10;
                             $valor-=$acrescimo;
                          }  
                          
                          $data['qt_participantes']= $linha[$data['qt_participantes']];
                          $data['expectativa_certificacao']=$coluna[$data['expectativa_certificacao']];
                          
                    }elseif($tipo_orcamento=='GA'){                        
                         $valor = $valores[$data['qt_participantes']][$data['expectativa_certificacao']];    
                         
                          if($data['form_orcamento_iso9001']=='Sim'){
                             $acrescimo=($valor/100)*10;
                             $valor-=$acrescimo;
                          }                          
                          if($data['qtd_unidades_certificadas']>1){
                             $acrescimo=($valor/100)*10;
                             $valor+=$acrescimo;
                          }
                          if($data['localizacao_unidade']!='Manaus'){
                             $acrescimo=($valor/100)*10;
                             $valor+=$acrescimo;
                             
                          }
                          
                          $data['qt_participantes']= $linha[$data['qt_participantes']];
                          $data['expectativa_certificacao']=$coluna[$data['expectativa_certificacao']];
                        
                    }elseif($tipo_orcamento=='SQ'){
                         $valor = $valores[$data['qt_participantes']][$data['expectativa_certificacao']];
                         
                          if($data['possui_alguma_certificacao']!='Nao'){
                             $acrescimo=($valor/100)*10;
                             $valor-=$acrescimo;
                          }
                          
                          if($data['qtd_unidades_certificadas']>1){
                             $acrescimo=($valor/100)*10;
                             $valor+=$acrescimo;
                          }
                          if($data['localizacao_unidade']!='Manaus'){
                             $acrescimo=($valor/100)*10;
                             $valor+=$acrescimo;
                             
                          }  
                           $data['qt_participantes']= $linha[$data['qt_participantes']];
                          $data['expectativa_certificacao']=$coluna[$data['expectativa_certificacao']];
                    }elseif($tipo_orcamento=='GS'){                      
                        
                        $valor = $valores[$data['qt_participantes']][$data['expectativa_certificacao']];    
                         
                          if($data['form_orcamento_iso9001']=='Sim'){
                             $acrescimo=($valor/100)*10;
                             $valor-=$acrescimo;
                          }     
                           if($data['form_orcamento_iso14001']=='Sim'){
                             $acrescimo=($valor/100)*10;
                             $valor-=$acrescimo;
                          }   
                          
                          if($data['form_orcamento_ohsas18001']=='Sim'){
                             $acrescimo=($valor/100)*15;
                             $valor-=$acrescimo;
                          }   
                          
                          if($data['qtd_unidades_certificadas']>1){
                             $acrescimo=($valor/100)*10;
                             $valor+=$acrescimo;
                          }                      
                          
                          if($data['localizacao_unidade']!='Manaus'){
                             $acrescimo=($valor/100)*10;
                             $valor+=$acrescimo;
                             
                          }
                          $data['qt_participantes']= $linha[$data['qt_participantes']];
                          $data['expectativa_certificacao']=$coluna[$data['expectativa_certificacao']];
                        
                    }elseif($tipo_orcamento=='SS'){
                          $valor = $valores[$data['qt_participantes']][$data['expectativa_certificacao']];    
                         
                          if($data['form_orcamento_iso9001']=='Sim'){
                             $acrescimo=($valor/100)*10;
                             $valor-=$acrescimo;
                          }     
                           if($data['form_orcamento_iso14001']=='Sim'){
                             $acrescimo=($valor/100)*10;
                             $valor-=$acrescimo;
                          }   
                          
                          if($data['qtd_unidades_certificadas']>1){
                             $acrescimo=($valor/100)*10;
                             $valor+=$acrescimo;
                          }                      
                          
                          if($data['localizacao_unidade']!='Manaus'){
                             $acrescimo=($valor/100)*10;
                             $valor+=$acrescimo;
                             
                          }
                         $data['qt_participantes']= $linha[$data['qt_participantes']];
                         $data['expectativa_certificacao']=$coluna[$data['expectativa_certificacao']];
                          
                    }elseif($tipo_orcamento=='TR'){
                         $valor = $valores[$data['qt_participantes']][$data['carga_horaria']];
                         if($data['horario_previsto']=='Manha'||$data['horario_previsto']=='Tarde'){
                             $acrescimo=($valor/100)*15;
                             $valor+=$acrescimo;
                         }                         
                         if($data['area_curso']=='Gestao'){
                             $acrescimo=($valor/100)*10;
                             $valor+=$acrescimo;
                         }
                         if($data['local_realizacao']=='In Company'||$data['local_realizacao']=='Sala ou Espaco'){
                             $acrescimo=($valor/100)*5;
                             $valor+=$acrescimo;
                         } 
                          $data['qt_participantes']= $linha[$data['qt_participantes']];
                          $data['carga_horaria']=$coluna[$data['carga_horaria']];
                    }else{
                    }               
                   
                    $serial_post=serialize($data);
                    $valor=str_replace(',', '.',$valor);
                    
                    $dados=array(                  
                       'array_post'=> $serial_post,
                        'tipo_orcamento'=>$tipo_orcamento,                    
                        'valor_orcamento'=> $valor ,                        
                        'lido'=>'N',
                    );
                    $this->db->where(array('id_orcamento_online'=>$id_orcamento_online));
                    $this->db->update('orcamento_online',$dados);
                    redirect(site_url('orcamento_online/orcamento_sucesso/'.$tipo_orcamento.'/'.$id_orcamento_online));
                    //return $this->orcamento_sucesso($tipo_orcamento,$id_orcamento_online);                    
                 
            //}
            
        }
        
        public function orcamento_sucesso($tipo_orcamento=false,$id_orcamento_online=false){
            //Título
                    $data['title'] = 'Orçamento On line';
                    $data['url_pagina'] = 'orcamento-on-line';
               
         
    
                    
                    
            
                    
                    
              if($id_orcamento_online){
                           $this->db->select('*'); 
                           $this->db->from('orcamento_online');
                           $this->db->where('id_orcamento_online',$id_orcamento_online);
                           $query = $this->db->get(); 
                           
                                $result = $query->result();                           
                                $data['orcamento']=$result;
                            
                      
                           $this->db->select('nome,email'); 
                           $this->db->from('usuario');
                           $this->db->where(array('tipo'=>'A','Ativo'=>'S'));
                           $query1 = $this->db->get(); 
                           
                            //Conteúdo do e-mail
                           $conteudo = $this->load->view('orcamento_online/email_orcamento', $data, true);
                       //print_r($conteudo);
                      // exit();
                            //carrega library de email
                             $this->load->library('email');
    
                             if($query1->num_rows>0){
                              $email_mb = $query1->result(); 
                               $x=0;
                               $email='';
                              foreach ($email_mb as $item) {                     
                                 if($x>0){
                                     $email.=",";
                                 }
                                 $email.=$item->email;
                                 $x+=1;
                              }                             
                              
                              $config['protocol'] = 'mail';
                                    $config['mailtype'] = 'html';

                                    //Parâmetros
                                    $this->email->initialize($config);
                                    //$this->email->clear();
                                    $this->email->from('luana@multiwebdigital.com.br', 'MB CONSULTORIA');
                                    //$this->email->to($item->email,$item->nome);                                    
                                    $this->email->to($email);
                                    $this->email->subject($email);
                                    $this->email->message($conteudo);
                                    $this->email->send(); 
                              

                            
                           } 
                            
                            
                            
                            
                            
                            
         }
         
         
         $this->loadView('orcamento_online/tela_sucesso',$data);
        }

        public function gerarpdf($id_orcamento_online=false){
            
                        if($id_orcamento_online){
                           $this->db->select('*'); 
                           $this->db->from('orcamento_online');
                           $this->db->where('id_orcamento_online',$id_orcamento_online);
                           $query = $this->db->get(); 
                           $result = $query->result();
                           
                           if($query->num_rows>0){

                               $data['dados_orcamento'] = unserialize($result[0]->array_post);
                               $data['dados_empresa']=$result[0];
                              
                                 //helpers
                                 $this->load->helper(array('dompdf', 'file'));

                                 //recebe html da view
                                $html= utf8_decode($this->load->view('orcamento_online/resultado_pdf', $data,true));
                              // print_r($html);
                              // exit();
                                 //Cria pdf
                                 pdf_create($html, 'MB CONSULTORIA - Orcamento - '.$data['dados_empresa']->tipo_orcamento.' - '.$data['dados_empresa']->nome_empresa);
                         }
                        
                        }
            
            
            
            
        }
        
        
        
        public function novo_orcamento(){

            $titulo='Solicitar Orçamento personalizado';

            $msg='Desde de já agradecemos seu contato. Por favor preencha os campos abaixo, responderemos assim que possível. Campos com * são de preenchimento obrigatório.';

            $action= 'orcamento_online/salva_novo_orcamento';

            $nomebotao='Enviar';

            $data= array('action'=>$action,'titulo'=>$titulo,'msg'=>$msg,'nomebotao'=>$nomebotao);



            //Carrega view

            $this->loadView('contato', $data);



        }
        
        public function salva_novo_orcamento(){
            
                       
             $dados=array(                  
                        'nome_empresa'=>$_POST['empresa']!=''?$_POST['empresa']:'Não cadastrada',
                        'cnpj'=>$_POST['cnpj']!=''?$_POST['cnpj']:'11.111.111/1111-11',
                        'email_resposta'=>$_POST['email'],
                        'nome_responsavel'=>$_POST['nome'].' '.$_POST['sobrenome'],
                        'cargo_responsavel'=>$_POST['cargo']?$_POST['cargo']:'Não cadastrada',
                        'telefone'=>$_POST['tel']!=''?$_POST['tel']:'-',
                        'celular'=>$_POST['cel']!=''?$_POST['cel']:'-',
                        'tipo_orcamento'=>'OP',
                        'mensagem'=>$_POST['mensagem'],
                        'created'=>date('Y-m-d H:i:u'),
                    );
                   
                   $this->db->insert('orcamento_online',$dados);
                   $id_orcamento_online = $this->db->insert_id(); 
            
            if($id_orcamento_online>0){       
                $data=array('msg'=>'A solicitação  de orçamento foi enviada com  sucesso.','titulo'=>'Solicitar Orçamento personalizado','sucesso'=>'1');
            }else{
                $data=array('msg'=>'Erro o orçamento não foi enviado','titulo'=>'Solicitar Orçamento personalizado','sucesso'=>'0');
            }



            //echo 'O comentário foi enviado com sucesso';

            $this->loadView('mensagem-retorno', $data);
            
            
            
        }
        
        
        
        
        
        
        
        
        
}