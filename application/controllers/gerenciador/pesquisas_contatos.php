<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pesquisas_contatos extends CI_Controller {

	var $titulo 		= 'Contatos de Pesquisas';
	var $dir 			= 'multitools/pesquisas_contatos/';
	var $controller 	= 'multitools/pesquisas_contatos';
	var $title_sing 	= 'Contato';
	var $per_page 		= 20;
	var $table 			= 'pesquisas_contatos';
	var $join			= array('pesquisas' => array('where' => 'pesquisas.id_pesquisas = pesquisas_id_pesquisas', 'type' => 'inner'));
    var $listId = "93a652e0b2"; 

	public function __construct(){
		parent::__construct();
		check_login();
	}

	public function index($pesquisa_id, $offset = 0){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//pequisa
		$data['pesquisas_id_pesquisas'] = $pesquisa_id;
		$where = $data['pesquisas_id_pesquisas'] ? array('pesquisas_contatos.pesquisas_id_pesquisas' => $data['pesquisas_id_pesquisas']) : NULL;

		//Registros
		$data['registros'] = $this->default_model->get_all($this->table, array($this->table.'.*, titulo'), $offset, $this->per_page, $where, $this->join, $this->table.'.nome', 'ASC');

		
		//Registros Pesquisas
		$data['pesquisa'] = $this->default_model->get_by_id('pesquisas', $pesquisa_id, array('*'), NULL, NULL, 'id_pesquisas');            
			
		//Parâmetros
		$data['paginacao']   = $this->_pagination($this->table, false, $data['pesquisas_id_pesquisas']);
		$data['controller']  = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	public function adicionar($pesquisa_id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Adicionar '.$this->title_sing;

		//Menu
		get_menu();

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Busca lista de Pesquisas
		$data['pesquisas_id_pesquisas'] = $pesquisa_id;
		$data['pesquisas'] = $this->default_model->listaAssociativa('pesquisas', 'titulo', NULL, array('id_pesquisas' => $data['pesquisas_id_pesquisas']), NULL, NULL, false, 'id_pesquisas');
		unset($data['pesquisas']['']);

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function editar($id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Editar '.$this->title_sing;;

		//Menu
		get_menu();

		//Busca registro
		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_pesquisas_contatos');

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Busca lista de pesquisas
		$data['pesquisas'] = $this->default_model->listaAssociativa('pesquisas', 'titulo', NULL, array('id_pesquisas' => $data['registro']->pesquisas_id_pesquisas), NULL, NULL, false, 'id_pesquisas');
		unset($data['pesquisas']['']);

		//Carrega view
		$this->load->view($this->dir.'form', $data);
		get_footer(TRUE);
	}

	public function salvar()
	{

		//Recebe Post
		$data = $_POST;
	
		$registro = $this->default_model->get_by_id("pesquisas", $data['pesquisas_id_pesquisas'], array('*'), NULL, NULL, 'id_pesquisas');

        $config = array(
            'apikey' => '5d3555ad583a3b8581f88121700266c9-us7',      // Insert your api key
            'secure' => FALSE   // Optional (defaults to FALSE)
        );
                        
            $this->load->library('MCAPI', $config, 'mail_chimp'); 
                
                
		//Salva so dados (Verificando se é edição ou inserção)
		if(isset($data["id_pesquisas_contatos"]) && $data["id_pesquisas_contatos"]) {
			$rows_affected = $this->default_model->update($this->table, $_POST['id_pesquisas_contatos'], $data, 'id_pesquisas_contatos');

			$this->mail_chimp->listUpdateMember($this->listId, trim($data['email']),$Merge,'html',false);

			if ( $data['ativo'] == 'N' )
				$result = $this->mail_chimp->listStaticSegmentMembersDel($this->listId, $registro->mailchimp_list_id, array($data['email']) );
				
		}
		else{                        
            //insere um contato na lista
 
            $MERGE1=$data['nome'];
            $MERGE2="";                            
            $Merge= array('Email'=>trim($data['email']),'Name'=>$MERGE1,'Chave'=>$MERGE2);                           
                           
			$verify_user = $this->mail_chimp->listMemberInfo($this->listId, array(trim($data['email'])) );
			if ($verify_user['success']):
				$this->mail_chimp->listUpdateMember($this->listId, trim($data['email']),$Merge,'html',false);
			else:
				$this->mail_chimp->listSubscribe($this->listId, trim($data['email']),$Merge,'html',false);
			endif;

			if ( $data['ativo'] == 'S' )
				$result = $this->mail_chimp->listStaticSegmentMembersAdd($this->listId, $registro->mailchimp_list_id, array($data['email']) );

			$data['created'] = date('Y-m-d H:i:s');
			$rows_affected = $this->default_model->insert($this->table, $data);
                       
            // salva a chave de acordo com o id criado
            $id_contato=$this->db->insert_id();
            $rows_affected = $this->default_model->update($this->table,$id_contato, array('chave_contato'=>md5($id_contato)), 'id_pesquisas_contatos');

			$MERGE1=$data['nome'];
            $MERGE2=md5($id_contato);                            
            $Merge= array('Email'=>trim($data['email']),'Name'=>$MERGE1,'Chave'=>$MERGE2);                           
                           
			$this->mail_chimp->listUpdateMember($this->listId, trim($data['email']),$Merge,'html',false);
                        
		}

		//Mensagem de retorno
		if($rows_affected == 1)
                        
			$msg = 'Dados salvos com sucesso.';
		else
			$msg = 'Não foi possível salvar os dados.';

		//Retorno
		$this->session->set_flashdata('msg', $msg);
		redirect($this->controller.'/index/'.$data['pesquisas_id_pesquisas']);
	}

	public function excluir($id){

		$data['registro'] = $this->default_model->get_by_id($this->table, $id, array('*'), NULL, NULL, 'id_pesquisas_contatos');
       if($this->default_model->update_where($this->table,array('ativo'=>'N'),array('id_pesquisas_contatos'=>$id)))
           $this->session->set_flashdata('msg', 'Registro excluído com sucesso!');
       else
           $this->session->set_flashdata('msg', 'Registro não foi excluído!');


		redirect($this->controller.'/index/'.$data['registro']->pesquisas_id_pesquisas);
	}

	private function _pagination($table, $search = FALSE, $pesquisa_id){

		//Carrega library de paginação
		$this->load->library('pagination');
		$config['per_page']   = $this->per_page;
		$config['last_link']  = 'Última';
		$config['first_link'] = 'Primeira';

		//where
		$where = array('pesquisas_contatos.pesquisas_id_pesquisas' => $pesquisa_id);

		//Parâmetro
		if($search){
			$config['page_query_string'] = TRUE;
			$config['total_rows']        = $this->default_model->count_by_search($this->table, $search, array(), $this->join);
			$config['base_url']          = base_url().$this->controller.'/buscar?s='.$this->input->get('s').'&pesquisa_id='.$pesquisa_id;
		}
		else{
			$config['uri_segment'] = 5;
			$config['total_rows']  = $this->default_model->count($this->table, array(), $this->join);
			$config['base_url']    = base_url().$this->controller.'/index/'.$pesquisa_id;
		}

		//Inicializa e retorna paginação
		$this->pagination->initialize($config);
		return $this->pagination->create_links();

	}

	public function buscar(){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = $this->titulo;

		//Menu
		get_menu();

		//Parâmetros de busca
		$data_busca[$this->table.'.nome']  = $this->input->get('s');
		$data_busca[$this->table.'.email'] = $this->input->get('s');
		$data_busca[$this->table.'.created'] = $this->input->get('s');
		$data_busca['pesquisas.titulo'] = $this->input->get('s');
		$data['pesquisas_id_pesquisas'] = $this->input->get('pesquisa_id');

		//Registros
		$offset = $this->input->get('per_page');
		$data['registros'] = $this->default_model->get_by_search($this->table, array($this->table.'.*, titulo'),  array('pesquisas_contatos.pesquisas_id_pesquisas' => $data['pesquisas_id_pesquisas']), $offset, $this->per_page, $data_busca, $this->join, $this->table.'.nome', 'ASC');
		$data['paginacao'] = $this->_pagination($this->table, $data_busca, $this->input->get('pesquisa_id'));

		//Registros Pesquisas
		$data['pesquisa'] = $this->default_model->get_by_id('pesquisas', $this->input->get('pesquisa_id'), array('*'), NULL, NULL, 'id_pesquisas');   
                
		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Carrega view
		$this->load->view($this->dir.'index', $data);
		get_footer(TRUE);
	}

	public function importacao($pesquisa_id){

		//Cabeçalho
		$titulo = $this->titulo;
		get_header($titulo, TRUE);
		$data['h1'] = 'Adicionar '.$this->title_sing;

		//Menu
		get_menu();

		//Parâmetros
		$data['controller'] = $this->controller;
		$data['title_sing'] = $this->title_sing;

		//Busca lista de Pesquisas
		$data['pesquisas_id_pesquisas'] = $pesquisa_id;

		//Carrega view
		$this->load->view($this->dir.'form_importacao', $data);
		get_footer(TRUE);
	}

	public function salvar_importacao()
	{
		//Recebe Post
		$data = $_POST;
	
		$registro = $this->default_model->get_by_id("pesquisas", $data['pesquisas_id_pesquisas'], array('*'), NULL, NULL, 'id_pesquisas');


		//Library de Upload
		$config['upload_path']   = './assets/uploads/';
		$config['allowed_types'] = '*';
		$this->load->library('upload', $config);

		//Upload da imagem
		if(!empty($_FILES['arquivo']['name'])){
			if($this->upload->do_upload('arquivo')){
				$data_file      = $this->upload->data();
				$data['arquivo'] = $data_file['file_name'];
			}
			else{
				$this->session->set_flashdata('msg', $this->upload->display_errors());
				redirect($this->controller.'/importacao/'.$data['pesquisas_id_pesquisas']);
			}
		}
                
                ini_set('auto_detect_line_endings',TRUE);

		// abre o arquivo colocando o ponteiro de escrita no final
		$arquivo = fopen($config['upload_path'].$data['arquivo'],'r+');
                
                
		if ($arquivo) {
			$indice = 1;
			$erro = "";
			
			
			$config = array(
				'apikey' => '5d3555ad583a3b8581f88121700266c9-us7',      // Insert your api key
				'secure' => FALSE   // Optional (defaults to FALSE)
			);
			
			$this->load->library('MCAPI', $config, 'mail_chimp'); 
                               
                        while(!feof ($arquivo)) {
				$linha = fgets($arquivo);
		
				if($indice > 1 ){
                                    
                                        $conteudo = explode(',', str_replace('"', "", utf8_encode($linha)));
                                        
                                        if (count($conteudo) == 1) $conteudo = explode(';', str_replace('"', "", utf8_encode($linha)));
                                        
					$nome 		= isset($conteudo[0]) && $conteudo[0] ? $conteudo[0] : NULL;
					$empresa 	= isset($conteudo[1]) && $conteudo[1] ? $conteudo[1] : NULL;
					$email 		= isset($conteudo[2]) && $conteudo[2] ? $conteudo[2] : NULL;
					$telefone 	= isset($conteudo[3]) && $conteudo[3] ? $conteudo[3] : NULL;
					$cargo 		= isset($conteudo[4]) && $conteudo[4] ? $conteudo[4] : NULL;
					
					if($nome != NULL ){						
						//insere um contato na lista
 
						$MERGE1=$nome;
						$MERGE2="";                            
						$Merge= array('Email'=>trim($email),'Name'=>$MERGE1,'Chave'=>$MERGE2);                           
                           
						
						$verify_user = $this->mail_chimp->listMemberInfo($this->listId, array(trim($email)) );
						if ($verify_user['success']):
							$this->mail_chimp->listUpdateMember($this->listId, trim($email),$Merge,'html',false);
						else:
							$this->mail_chimp->listSubscribe($this->listId, trim($email),$Merge,'html',false);
						endif;
						
						$result = $this->mail_chimp->listStaticSegmentMembersAdd($this->listId, $registro->mailchimp_list_id, array($email) );

						if ( $result ) {			
							$this->default_model->insert($this->table, array('pesquisas_id_pesquisas' => $data['pesquisas_id_pesquisas'], 'nome' => $nome, 'empresa' => $empresa, 'telefone' => $telefone, 'email' => $email, 'cargo' => $cargo, 'created' =>date('Y-m-d H:i:s')));						                       
							
							$id_contato=$this->db->insert_id();
						
							$MERGE1=$nome;
							$MERGE2=md5($id_contato);                            
							$Merge= array('Email'=>trim($email),'Name'=>$MERGE1,'Chave'=>$MERGE2);  

							// salva a chave de acordo com o id criado
							$id_contato=$this->db->insert_id();
							$rows_affected = $this->default_model->update($this->table,$id_contato, array('chave_contato'=>md5($id_contato)), 'id_pesquisas_contatos');
 
							$this->mail_chimp->listUpdateMember($this->listId, trim($email),$Merge,'html',false);
						}						
					} 
				}
				$indice++;
                             
                         }
                         
			 fclose($arquivo);
                        
                        ini_set('auto_detect_line_endings',FALSE);
		}

		//Retorno
		$this->session->set_flashdata('msg', 'Importação de dados concluída.');
		redirect($this->controller.'/index/'.$data['pesquisas_id_pesquisas']);
	}
        
        public function atualizar_mail_chimp($pesquisa_id=false){
            
       $config = array(
	    'apikey' => '5d3555ad583a3b8581f88121700266c9-us7',      // Insert your api key
            'secure' => FALSE   // Optional (defaults to FALSE)
		);
		$this->load->library('MCAPI', $config, 'mail_chimp');    
            
            
            
            if($pesquisa_id){
                
                //Busca registro
				$data['pesquisa'] = $this->default_model->get_by_id('pesquisas', $pesquisa_id, array('*'), NULL, NULL, 'id_pesquisas');
                $segmento=trim($data['pesquisa']->mailchimp_list_id);
                $chave=$data['pesquisa']->chave;	
				$titulo =$data['pesquisa']->titulo;			
           
				$html = $this->load->view($this->dir.'pesquisa_online_email',$data,true);
                
	
                $data['registro_retirar'] = $this->default_model->get_all($this->table, array('email'), 0, NULL, array('pesquisas_id_pesquisas' => $pesquisa_id, 'respondido' => 'S'), NULL, Null, Null);

               if ($data['registro']) {
				  $result = $this->mail_chimp->listStaticSegmentMembersDel($this->listId, $segmento, $data['registro_retirar'] );
                                      
                    
                }

				$type = 'regular';

				$segs = array();

				$segs[] = array('field'=>'static_segment', 'op'=>'eq', 'value'=>$segmento);


				$opts_seg['match'] = 'any';
				$opts_seg['conditions'] = $segs;

				$retval = $this->mail_chimp->campaignSegmentTest($listId, $opts_seg );

				$opts['list_id'] =  $this->listId;
				$opts['subject'] = $titulo;
				$opts['from_email'] = 'vinicius@multiwebdigital.com.br'; 
				$opts['from_name'] = 'MB Consultoria';

				$opts['tracking']=array('opens' => true, 'html_clicks' => true, 'text_clicks' => false);

				$opts['authenticate'] = true;
				$opts['analytics'] = array('google'=>'my_google_analytics_key');
				$opts['title'] = $titulo;

				$content = array('html' => $html );

				$CID = $this->mail_chimp->campaignCreate($type, $opts, $content, $opts_seg);

				$retval = $this->mail_chimp->campaignSendNow($CID);

			
			$rows_affected = $this->default_model->update_where($this->table, array('enviado' => 'S' , 'data_envio' => date('Y-m-d H:i:s')), array('pesquisas_id_pesquisas' => $pesquisa_id, 'respondido' => 'N', 'ativo' => 'S'));



            $this->session->set_flashdata('msg', 'Pesquisa agendada com sucesso para ser enviada');
            redirect(site_url('multitools/pesquisas_contatos/index/'.$pesquisa_id));

			
            }else{              
                
		redirect(site_url());
            }
            
        }
        
        
        
}

/* End of file usuarios.php */
/* Location: ./application/controllers/multitools/usuarios.php */