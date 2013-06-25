<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pesquisa_online extends MY_Controller {

	//Retira a proteção deste controller
	protected $_dontProtectMe = true;

	public function __construct(){
		parent::__construct();
        $data['title'] = 'MB Consultoria - Serviços';
		//Carrega model e helpers
		$this->load->model("certificados_model");
		$this->load->helper('url');
		$this->load->helper('html');
                $this->load->helper('text_helper');
                $this->load->helper('auxiliar_helper');
	}

	public function index(){
                
                //Título
		$data['title'] = 'Módulo de Pesquisa';
		$data['url_pagina'] = 'modulo-de-pesquisa';
                
                
                
               //Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));
		//Box blog e multimidia
		$data['box_blog'] = $this->default_model->get_all('posts', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');
		$data['box_multimidia'] = $this->default_model->get_all('podcasts', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');

		//Veja também- páginas de cursos
		$where_cursos = "url = 'banco-de-talentos' or url = 'autodiagnosticos' or url = 'central-de-downloads'";   
		$data['paginas_cursos'] = $this->default_model->get_all('paginas', array('*'),  NULL, 3, $where_cursos, NULL, 'RAND()', '');

                
                


                //Carrega view
		$this->loadView('pesquisa_online/pesquisa_online',$data);
        }
        
        public function dados_pessoais(){
                
                //Título
		$data['title'] = 'Módulo de Pesquisa';
		$data['url_pagina'] = 'modulo-de-pesquisa';
                
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
                
                
                                
               //Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));
		//Box blog e multimidia
		$data['box_blog'] = $this->default_model->get_all('posts', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');
		$data['box_multimidia'] = $this->default_model->get_all('podcasts', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');

		//Veja também- páginas de cursos
		$where_cursos = "url = 'banco-de-talentos' or url = 'autodiagnosticos' or url = 'central-de-downloads'";   
		$data['paginas_cursos'] = $this->default_model->get_all('paginas', array('*'),  NULL, 3, $where_cursos, NULL, 'RAND()', '');

                
                
                
                
                
                
                
                //Carrega view
		$this->loadView('pesquisa_online/pesquisa_online_dados_pessoais',$data);
        }
        
        
        public function salva_dados($tipo_orcamento=false) {
                    //Título
                    $data['title'] = 'Orçamento On line';
                    $data['url_pagina'] = 'orcamento-on-line';
                        
                    if(!$_POST){
                      return $this->dados_pessoais('Favor preencher o formulário do orçamento!'); 
                    }
                    if($_POST['form_tela_inicial_empresa']=='' || $_POST['form_tela_inicial_cnpj']=='' || $_POST['form_tela_inicial_email']=='' || $_POST['form_tela_inicial_responsavel_orcamento']=='' || $_POST['form_tela_inicial_cargo_responsavel']=='' || $_POST['form_tela_inicial_responsavel_tel_direto']=='' || $_POST['form_tela_inicial_responsavel_celular']==''){
                        return $this->dados_pessoais('Favor preencher todos os campos Obrigatórios');                         
                    }
                    $dados=array(                  
                        'nome_empresa'=>$_POST['form_tela_inicial_empresa'],
                        'cnpj'=>$_POST['form_tela_inicial_cnpj'],
                        'email_resposta'=>$_POST['form_tela_inicial_email'],
                        'nome_responsavel'=>$_POST['form_tela_inicial_responsavel_orcamento'],
                        'cargo_responsavel'=>$_POST['form_tela_inicial_cargo_responsavel'],
                        'telefone'=>$_POST['form_tela_inicial_responsavel_tel_direto'],
                        'celular'=>$_POST['form_tela_inicial_responsavel_celular'],                        
                        'created'=>date('Y-m-d H:i:u'),
                    );
                   
                   $this->db->insert('pesquisas_orcamentos',$dados);
                   $id_orcamento_online = $this->db->insert_id();                   
                   
                    $data['id_orcamento_online']=$id_orcamento_online;
                    
                    redirect(site_url('pesquisa_online/fazendo_orcamento/'.$id_orcamento_online));
             
        }
        
        
       public function fazendo_orcamento($id_orcamento){
                
                //Título
		$data['title'] = 'Módulo de Pesquisa';
		$data['url_pagina'] = 'modulo-de-pesquisa';
                $data['id_orcamento']=$id_orcamento;
                
                
                
                                                
               //Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));
		//Box blog e multimidia
		$data['box_blog'] = $this->default_model->get_all('posts', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');
		$data['box_multimidia'] = $this->default_model->get_all('podcasts', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');

		//Veja também- páginas de cursos
		$where_cursos = "url = 'banco-de-talentos' or url = 'autodiagnosticos' or url = 'central-de-downloads'";   
		$data['paginas_cursos'] = $this->default_model->get_all('paginas', array('*'),  NULL, 3, $where_cursos, NULL, 'RAND()', '');

                

                //Carrega view
		$this->loadView('pesquisa_online/pesquisa_online_formulario',$data);
        }
        
        
      public function salvar_orcamento($id_orcamento) {            
                
                        $data=$_POST;                
           
                            $valores = array(
                                    array(4500,6000,8000,10200,13500),                                   
                                    array(5500,7500,9500,12300,16000),
                                    array(7000,9000,11200,14100,18400),
                                    array(7500,9800,12000,15200,19300),
                            );
                        
                            $linha =  array('Manaus/AM e Região Metropolitana','Capitais de todas as Regiões do Brasil','Cidades do interior em todas as Regiões do Brasil','Distribuídas em várias cidades (interior e capitais) em todo o Brasil');
                            $coluna = array('Até 50 pessoas','51 a 200 pessoas','201 a 400 pessoas','401 a 800 pessoas','Acima de 801 pessoas');
                            $base_dados=array('Sim. Totalmente atualizada e checada.','Sim. Entretanto, pode precisar de alguma atualização.','Não. Temos a base, mas os dados podem estar bastante desatualizados.','Não. Precisamos que a MB defina totalmente a base de dados e seus contatos.'); 
                            $tamanho_questionario=array('10'=>'Até 10 questões','20'=>'11 a 20 questões','41'=>'21 a 40 questões','Acima de 40 questões (em geral, não recomendamos, a não ser em exceções)','0'=>'Não sei');
                         
                        $acrescimo=0;
                        $valor=0;                    
                     
                         $valor = $valores[$data['local_pesquisa']][$data['qtd_pessoas_pesquisadas']];
                         
                         
                          if($data['base_dados']==1){
                             $acrescimo=($valor/100)*5;
                             $valor+=$acrescimo;
                          }elseif($data['base_dados']==2){
                             $acrescimo=($valor/100)*8;
                             $valor+=$acrescimo;
                          }elseif($data['base_dados']==3){
                             $acrescimo=($valor/100)*10;
                             $valor+=$acrescimo;
                          }
                          
                          if($data['tamanho_questionario']>20){
                             $acrescimo=($valor/100)*5;
                             $valor+=$acrescimo;
                             
                          }
                         
                          $data['local_pesquisa']= $linha[$data['local_pesquisa']];
                          $data['qtd_pessoas_pesquisadas']=$coluna[$data['qtd_pessoas_pesquisadas']];
                          $data['base_dados']= $base_dados[$data['base_dados']];                          
                          $data['tamanho_questionario']= $tamanho_questionario[$data['tamanho_questionario']];
                           /*print_r($data);
                          exit();*/
                           $serial_post=serialize($data);
                           $valor=str_replace(',', '.',$valor);
                    
                            $dados=array(                  
                               'array_post'=> $serial_post,                                         
                                'valor_orcamento'=> $valor,                       

                            );
                            $this->db->where(array('id_pesquisas_orcamentos'=>$id_orcamento));
                            $this->db->update('pesquisas_orcamentos',$dados);
                            redirect(site_url('pesquisa_online/orcamento_sucesso/'.$id_orcamento));

            
        }
        
         public function orcamento_sucesso($id_orcamento) {
                
                //Título
		$data['title'] = 'Módulo de Pesquisa';
		$data['url_pagina'] = 'modulo-de-pesquisa';
                //$data['id_orcamento']=$id_orcamento;

                 $this->db->select('id_pesquisas_orcamentos,nome_responsavel,nome_responsavel,valor_orcamento');
                    $this->db->from('pesquisas_orcamentos');
                    $this->db->where(array('id_pesquisas_orcamentos'=>$id_orcamento));
                    $query=$this->db->get();
                    foreach ($query->result() as $item) {               
                        $data['pesquisa']=array('id_orcamento'=> $item->id_pesquisas_orcamentos,'nome_responsavel'=>$item->nome_responsavel,'nome_responsavel'=>$item->nome_responsavel,'valor_orcamento'=>$item->valor_orcamento);
                    }
                
                
                                                                    
               //Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));
		//Box blog e multimidia
		$data['box_blog'] = $this->default_model->get_all('posts', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');
		$data['box_multimidia'] = $this->default_model->get_all('podcasts', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');

		//Veja também- páginas de cursos
		$where_cursos = "url = 'banco-de-talentos' or url = 'autodiagnosticos' or url = 'central-de-downloads'";   
		$data['paginas_cursos'] = $this->default_model->get_all('paginas', array('*'),  NULL, 3, $where_cursos, NULL, 'RAND()', '');

		
                    
                    
              if($id_orcamento){
                           $this->db->select('*'); 
                           $this->db->from('pesquisas_orcamentos');
                           $this->db->where('id_pesquisas_orcamentos',$id_orcamento);
                           $query = $this->db->get(); 
                           
                                $result = $query->result();                           
                                $data['orcamento']=$result;
			
                           $this->db->select('nome,email'); 
                           $this->db->from('usuario');
                           $this->db->where(array('tipo'=>'A'));
                           $query1 = $this->db->get(); 
                           
                            //Conteúdo do e-mail
                           $conteudo = $this->load->view('pesquisa_online/email_pesquisa', $data, true);
                       //print_r($conteudo);
                      // exit();
                            //carrega library de email
                             $this->load->library('email');
    
                             if($query1->num_rows>0){
                              $email_mb = $query1->result(); 
                               
                              foreach ($email_mb as $item) {
                                   
                                    $config['protocol'] = 'mail';
                                    $config['mailtype'] = 'html';

                                    //Parâmetros
                                    $this->email->initialize($config);
                                    //$this->email->clear();
                                    $this->email->from('luana@multiwebdigital.com.br', 'MB CONSULTORIA');
                                    $this->email->to($item->email,$item->nome);
                                    //$this->email->to('wandertaz@yahoo.com.br','Wander');
                                    $this->email->subject('MB CONSULTORIA - Orçamento de Pesquisa');
                                    $this->email->message($conteudo);
                                    $this->email->send(); 
                            
                               
                              }

                            
                           } 
                            
                            
                            
                            
                            
                            
         }
                
                
                //Carrega view
		$this->loadView('pesquisa_online/pesquisa_online_finalizacao',$data);
             
         }   
        
        public function aceitou_termos($id_orcamento) {
                
                //Título
		$data['title'] = 'Módulo de Pesquisa';
		$data['url_pagina'] = 'modulo-de-pesquisa';
                $dados=array('aceito'=>'S');
                $this->db->where(array('id_pesquisas_orcamentos'=>$id_orcamento));
                $this->db->update('pesquisas_orcamentos',$dados);
                
                
                 //Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));
		//Box blog e multimidia
		$data['box_blog'] = $this->default_model->get_all('posts', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');
		$data['box_multimidia'] = $this->default_model->get_all('podcasts', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');

		//Veja também- páginas de cursos
		$where_cursos = "url = 'banco-de-talentos' or url = 'autodiagnosticos' or url = 'central-de-downloads'";   
		$data['paginas_cursos'] = $this->default_model->get_all('paginas', array('*'),  NULL, 3, $where_cursos, NULL, 'RAND()', '');

                
                
                
                $this->loadView('pesquisa_online/pesquisa_online_fim_solicitacao',$data);
            
            
        }
        public function pesquisa($chave_contato=false) {                
                
                
            
                if ($chave_contato==false){
                     $msg ='Erro: A campanha não existe ou já foi finalizada!'; 
                     $this->session->set_flashdata('msg', $msg);                     
                     redirect(site_url('/pesquisa_online/pesquisa_sucesso/'.$data['pesquisado']->pesquisas_id_pesquisas));
                    
                }else{
                    //Busca registro
                    $data['pesquisado'] = $this->default_model->get_by_id('pesquisas_contatos', $chave_contato, array('*'), NULL, NULL, 'chave_contato');

                    // esta se não foi respondida ou finalizada
                    if ($data['pesquisado']->respondido=='N' && $data['pesquisado']->ativo=='S'){
                            //Busca registro da pesquisa
                            $data['pesquisa'] = $this->default_model->get_by_id('pesquisas', $data['pesquisado']->pesquisas_id_pesquisas, array('*'), NULL, NULL, 'id_pesquisas');
                            
                            // id da pesquisa
                            $id=$data['pesquisado']->pesquisas_id_pesquisas;
                            $contato_id=$data['pesquisado']->id_pesquisas_contatos;
                            if($data['pesquisa']->id_pesquisas ==$id){
                                   
                                //Busca perguntas da pesquisa
                                $data['perguntas'] = $this->default_model->get_all('pesquisas_perguntas', array('*'), 0, NULL, array('pesquisas_id_pesquisas' => $data['pesquisado']->pesquisas_id_pesquisas, 'pesquisas_perguntas_id_pesquisas_perguntas' => NULL), NULL, 'numero', 'ASC');

                               
                                
//Busca opções
foreach($data['perguntas'] as $key => $pergunta){

        if($pergunta->tipo == 'P05'  || $pergunta->tipo == 'P10'  || $pergunta->tipo == 'CLA'){
                $data['perguntas'][$key]->sub_perguntas = $this->default_model->get_all('pesquisas_perguntas', array('*'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas), NULL, 'numero', 'ASC');


                        foreach($data['perguntas'][$key]->sub_perguntas as $key_sub => $subpergunta)
                                $data['perguntas'][$key]->sub_perguntas[$key_sub]->resposta = $this->default_model->get_by_id('pesquisas_respostas', $subpergunta->id_pesquisas_perguntas, array('resposta', 'pesquisas_perguntas_opcoes_id_pesquisas_perguntas_opcoes as opcao_resposta'), array('pesquisas_id_pesquisas' => $id, 'pesquisas_contatos_id_pesquisas_contatos' => $contato_id), NULL, 'pesquisas_perguntas_id_pesquisas_perguntas');


                if($pergunta->tipo == 'CLA'){
                        $count_perguntas = $this->default_model->get_all('pesquisas_perguntas', array('COUNT(*) AS total'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas), NULL, 'numero', 'ASC');
                        $data['perguntas'][$key]->total_sub_perguntas = $count_perguntas[0]->total;
                }
        }
        else if($pergunta->tipo == 'RAD'  || $pergunta->tipo == 'CHE'){
                $data['perguntas'][$key]->opcoes = $this->default_model->get_all('pesquisas_perguntas_opcoes', array('*'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas), NULL, 'ordem', 'ASC');
        }
        
        
        


}

                                
                                
                                
                                

                            }else{
                                
                               $msg='Erro: A chave é inválida ou o campanha ou já foi finalizada!'; 
                               $this->session->set_flashdata('msg', $msg);                     
                               redirect(site_url('/pesquisa_online/pesquisa_sucesso/'.$data['pesquisado']->pesquisas_id_pesquisas));
                            } 
                    }else{
                       // print_r($data['pesquisado']->pesquisas_id_pesquisas);
                      // exit();
                     $msg='Erro: A campanha foi respondida ou foi finalizada!';
                     $this->session->set_flashdata('msg', $msg);                     
                     redirect(site_url('/pesquisa_online/pesquisa_sucesso/'.$data['pesquisado']->pesquisas_id_pesquisas));
                    }
                }
               
            

            $this->loadView('pesquisa_online/pesquisa_online_pesquisa',$data);
        }
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
public function pesquisa_sugestao($id_pesquisa) {

        // check_login_empresa();
        //check_login_empresa($area_permissao);

        $data['pesquisa_sugestao'] = 1;

        
        $data['pesquisa'] = $this->default_model->get_by_id('pesquisas',$id_pesquisa, array('*'), NULL, NULL, 'id_pesquisas');
        
        //Busca perguntas da pesquisa
        $data['perguntas'] = $this->default_model->get_all('pesquisas_perguntas', array('*'), 0, NULL, array('pesquisas_id_pesquisas' => $id_pesquisa, 'pesquisas_perguntas_id_pesquisas_perguntas' => NULL), NULL, 'numero', 'ASC');
		
        if ($data['perguntas']) {
            //Busca opções
            foreach ($data['perguntas'] as $key => $pergunta) {

                if ($pergunta->tipo == 'P05' || $pergunta->tipo == 'P10' || $pergunta->tipo == 'CLA') {
                    $data['perguntas'][$key]->sub_perguntas = $this->default_model->get_all('pesquisas_perguntas', array('*'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas), NULL, 'numero', 'ASC');


                    foreach ($data['perguntas'][$key]->sub_perguntas as $key_sub => $subpergunta)
                        $data['perguntas'][$key]->sub_perguntas[$key_sub]->resposta = $this->default_model->get_by_id('pesquisas_respostas', $subpergunta->id_pesquisas_perguntas, array('resposta', 'pesquisas_perguntas_opcoes_id_pesquisas_perguntas_opcoes as opcao_resposta'), array('pesquisas_id_pesquisas' => $id_pesquisa), NULL, 'pesquisas_perguntas_id_pesquisas_perguntas');


                    if ($pergunta->tipo == 'CLA') {
                        $count_perguntas = $this->default_model->get_all('pesquisas_perguntas', array('COUNT(*) AS total'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas), NULL, 'numero', 'ASC');
                        $data['perguntas'][$key]->total_sub_perguntas = $count_perguntas[0]->total;
                    }
                } else if ($pergunta->tipo == 'RAD' || $pergunta->tipo == 'CHE') {
                    $data['perguntas'][$key]->opcoes = $this->default_model->get_all('pesquisas_perguntas_opcoes', array('*'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas), NULL, 'ordem', 'ASC');
                }
            }
            
         

            $this->loadView('pesquisa_online/pesquisa_online_pesquisa', $data);
        }
    }
    
    
    public function pesquisa_sugestao_Teste($id_pesquisa) {

        // check_login_empresa();
        //check_login_empresa($area_permissao);


        //$data['pesquisa_sugestao'] = 1;

        
        $data['pesquisa'] = $this->default_model->get_by_id('pesquisas',$id_pesquisa, array('*'), NULL, NULL, 'id_pesquisas');
        
        //Busca perguntas da pesquisa
        $data['perguntas'] = $this->default_model->get_all('pesquisas_perguntas', array('*'), 0, NULL, array('pesquisas_id_pesquisas' => $id_pesquisa, 'pesquisas_perguntas_id_pesquisas_perguntas' => NULL), NULL, 'numero', 'ASC');


        if ($data['perguntas']) {
            //Busca opções
            foreach ($data['perguntas'] as $key => $pergunta) {

                if ($pergunta->tipo == 'P05' || $pergunta->tipo == 'P10' || $pergunta->tipo == 'CLA') {
                    $data['perguntas'][$key]->sub_perguntas = $this->default_model->get_all('pesquisas_perguntas', array('*'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas), NULL, 'numero', 'ASC');


                    foreach ($data['perguntas'][$key]->sub_perguntas as $key_sub => $subpergunta)
                        $data['perguntas'][$key]->sub_perguntas[$key_sub]->resposta = $this->default_model->get_by_id('pesquisas_respostas', $subpergunta->id_pesquisas_perguntas, array('resposta', 'pesquisas_perguntas_opcoes_id_pesquisas_perguntas_opcoes as opcao_resposta'), array('pesquisas_id_pesquisas' => $id_pesquisa), NULL, 'pesquisas_perguntas_id_pesquisas_perguntas');


                    if ($pergunta->tipo == 'CLA') {
                        $count_perguntas = $this->default_model->get_all('pesquisas_perguntas', array('COUNT(*) AS total'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas), NULL, 'numero', 'ASC');
                        $data['perguntas'][$key]->total_sub_perguntas = $count_perguntas[0]->total;
                    }
                } else if ($pergunta->tipo == 'RAD' || $pergunta->tipo == 'CHE') {
                    $data['perguntas'][$key]->opcoes = $this->default_model->get_all('pesquisas_perguntas_opcoes', array('*'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $pergunta->id_pesquisas_perguntas), NULL, 'ordem', 'ASC');
                }
            }
            
         
            $this->loadView('pesquisa_online/pesquisa_online_pesquisa_teste', $data);
        }
    }
    
    
    
    
    
    
    
        
        
      public function aprovar($id_pesquisas){
          
                // aqui verifica aonde fica o gerenciamento de permissoes da area ele pe
                if ($this->session->userdata('SessionIdEmpresa')){                  
                   $usuario_id= $this->session->userdata('SessionIdEmpresa'); //Id do usu�rio logado e selecionado 
                   $TipoAcesso ='J';
                }elseif ($this->session->userdata('SessionEmpresaPermissoes')){
                    check_login_empresa(2);
                   $usuario_id= $this->session->userdata('SessionEmpresaPermissoes'); //Id do usu�rio logado e selecionado
                   $TipoAcesso ='FJ';
                }
                else{

                    redirect(site_url());// redireciona para a home caso nenhuma opção seja selecionada
                }
          
          if($id_pesquisas){  
            $msg='A Pesquisa foi aprovada com sucesso, envie a sua base de dados!';
            $this->session->set_flashdata('msg', $msg);  
            
            $dados=array('status'=>'AP');
            $this->db->where(array('id_pesquisas'=>$id_pesquisas));
            $this->db->update('pesquisas',$dados);            

            redirect(site_url('area_restrita_modulo_de_pesquisa/index/'.$TipoAcesso));
          }
          
      }    
      
      public function naoaprovar($id_pesquisas=false){
          
               // aqui verifica aonde fica o gerenciamento de permissoes da area ele pe
                if ($this->session->userdata('SessionIdEmpresa')){                  
                   $usuario_id= $this->session->userdata('SessionIdEmpresa'); //Id do usu�rio logado e selecionado 
                   $TipoAcesso ='J';
                }elseif ($this->session->userdata('SessionEmpresaPermissoes')){
                    check_login_empresa(2);
                   $usuario_id= $this->session->userdata('SessionEmpresaPermissoes'); //Id do usu�rio logado e selecionado
                   $TipoAcesso ='FJ';
                }
                else{

                    redirect(site_url());// redireciona para a home caso nenhuma opção seja selecionada
                }
          
          
          if($id_pesquisas){
            $msg='A Pesquisa não foi aprovada, aguarde Contato da MB Consultoria!';
            $this->session->set_flashdata('msg', $msg);  

            $dados=array('status'=>'NA', 'ativo'=>'N');
            $this->db->where(array('id_pesquisas'=>$id_pesquisas));
            $this->db->update('pesquisas',$dados);
			
			
            //Recebe Post
			$data = $_POST;
			
			var_dump($data);
			          
			foreach($data as $id_pergunta => $resposta){

				
				$dados['pesquisas_id_pesquisas'] = $pesquisa_id;
				$dados['pesquisas_perguntas_id_pesquisas_perguntas'] = $id_pergunta;
							$dados['comentario_cliente'] = $resposta;

				$this->default_model->insert('pesquisas_alteracoes', $dados);
				unset($dados);
			}

            //redirect(site_url('area_restrita_modulo_de_pesquisa/index/'.$TipoAcesso));
          }
          
      }    
        
        
        
        
        
        
        
        
        
        
        
        
        public function salvar_questionario()
	{
		//Recebe Post
		$data = $_POST;
		$pesquisa_id = $data['pesquisa_id'];
		$contato_id = $data['contato_id'];
                
                $pesquisado= array('empresa'=>$data['empresa'],'nome'=>$data['nome'],'email'=>$data['email'],'telefone'=>$data['telefone'],'cargo'=>$data['cargo'],'enviado'=>'S','respondido'=>'S','data_resposta'=>date('Y-m-d H:i:s'));
                
                // Atualiza os dados da base de dados
                $this->db->where(array('id_pesquisas_contatos'=>$contato_id));
                $this->db->update('pesquisas_contatos', $pesquisado);
                unset($dados);
			unset($data['pesquisa_id'], $data['contato_id'],$data['empresa'],$data['nome'],$data['email'],$data['telefone'],$data['cargo']);

                
                
                
              /* print_r($data);
                exit();*/
                
		foreach($data as $id_pergunta => $resposta){

			if ( !strstr($id_pergunta, 'aberto') ) {
				$dados['pesquisas_contatos_id_pesquisas_contatos'] = $contato_id;
				$dados['pesquisas_id_pesquisas'] = $pesquisa_id;
				$dados['pesquisas_perguntas_id_pesquisas_perguntas'] = $id_pergunta;
				
				if ( is_int($id_pergunta) ) 
				{
					//Busca pergunta
					$pergunta = $this->default_model->get_by_id('pesquisas_perguntas', $id_pergunta, array('*'), NULL, NULL, 'id_pesquisas_perguntas');
					
					if ( isset($pergunta) )
					{
						if($pergunta->tipo == 'RAD')
						{
							$dados['pesquisas_perguntas_opcoes_id_pesquisas_perguntas_opcoes'] = $resposta;
							
							if ( isset($data['aberto_'.$resposta]))
								$dados['resposta'] = $data['aberto_'.$resposta];
						}
						elseif($pergunta->tipo == 'CHE')
						{
							
							foreach($resposta as $opcao){
								
								$dados2 = $dados;
								$dados2['pesquisas_perguntas_opcoes_id_pesquisas_perguntas_opcoes'] = $opcao;
								
								if ( isset($data['aberto_'.$opcao]))
									$dados2['resposta'] = $data['aberto_'.$opcao];
								
								$this->default_model->insert('pesquisas_respostas', $dados2);
								
								unset($dados2);
					
							}
						}
						elseif($pergunta->tipo == 'P05'  || $pergunta->tipo == 'P10'  || $pergunta->tipo == 'CLA')
							$dados['valor'] = $resposta;
						else
							$dados['resposta'] = $resposta;
					}
					
					if($pergunta->tipo != 'CHE')
						$this->default_model->insert('pesquisas_respostas', $dados);
					
					unset($dados);
				}
				
			}
		}

		//Retorno
		$this->session->set_flashdata('msg', 'Enviado com sucesso.');
		redirect(site_url('pesquisa_online/pesquisa_sucesso/'.$pesquisa_id));
	}
        
        public function pesquisa_sucesso($id_pesquisa=false) {
            
            
            $data['pesquisa'] = $this->default_model->get_by_id('pesquisas', $id_pesquisa, array('*'), NULL, NULL, 'id_pesquisas');
            $this->loadView('pesquisa_online/pesquisa_online_agradecimentos',$data);
            
        }
        
        
        
        public function pesquisa_email($id_pesquisa=false) {
            
            
            $data['pesquisa'] = $this->default_model->get_by_id('pesquisas', $id_pesquisa, array('*'), NULL, NULL, 'id_pesquisas');
           
            $this->loadView('pesquisa_online/pesquisa_online_email',$data);
            
        }
        
        
        
       public function salvar_questionario_sugestao()
	{
		


                 // aqui verifica aonde fica o gerenciamento de permissoes da area ele pe
                if ($this->session->userdata('SessionIdEmpresa')){                  
                   $usuario_id= $this->session->userdata('SessionIdEmpresa'); //Id do usu�rio logado e selecionado 
                   $TipoAcesso ='J';
                }elseif ($this->session->userdata('SessionEmpresaPermissoes')){
                    check_login_empresa(2);
                   $usuario_id= $this->session->userdata('SessionEmpresaPermissoes'); //Id do usu�rio logado e selecionado
                   $TipoAcesso ='FJ';
                }
                else{

                    redirect(site_url());// redireciona para a home caso nenhuma opção seja selecionada
                }
                //Recebe Post
		$data = $_POST;
                $pesquisa_id = $data['pesquisa_id'];
                unset($data['pesquisa_id'], $data['contato_id']);                                   
                   
                  $this->db->where(array('pesquisas_id_pesquisas'=>$pesquisa_id));
                  $this->db->delete('pesquisas_alteracoes');
        $acao = '';
		
		foreach($data as $id_pergunta => $resposta){

			if ( $id_pergunta != 'acao' ) {
			$dados['pesquisas_id_pesquisas'] = $pesquisa_id;
			$dados['pesquisas_perguntas_id_pesquisas_perguntas'] = $id_pergunta;
                        $dados['comentario_cliente'] = $resposta;
			
			$this->default_model->insert('pesquisas_alteracoes', $dados);
			unset($dados);
			}
			else $acao = $resposta;
		}

		//Retorno
		$this->session->set_flashdata('msg', 'Pedido de alteração enviado com sucesso.');
		 
                if($pesquisa_id){
                    
				  if ( $acao = 'nao' )
					$dados=array('status'=>'NA', 'ativo'=>'N');
				  else
					$dados=array('status'=>'AL');

                  $this->db->where(array('id_pesquisas'=>$pesquisa_id));
                  $this->db->update('pesquisas',$dados);
                  
                }
                redirect(site_url('area_restrita_modulo_de_pesquisa/index/'.$TipoAcesso));
                
	}
        
        
        
        
        
}