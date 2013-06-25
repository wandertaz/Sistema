<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class area_restrita_modulo_de_pesquisa extends MY_Controller {

	//Retira a prote��o deste controller
	protected $_dontProtectMe = true;

	public function __construct(){
		parent::__construct();

		//Carrega model e helpers
		$this->load->model("default_model");
                $this->load->helper('auxiliar_helper');
                $this->load->helper('number_helper');
		//check_login_aluno_empresa();
	}

	public function index($TipoAcesso){


               // aqui verifica aonde fica o gerenciamento de permissoes da area ele pe
                if ($TipoAcesso=='J'){
                   check_login_empresa(2);
                   $usuario_id= $this->session->userdata('SessionIdEmpresa'); //Id do usu�rio logado e selecionado                
                }elseif ($TipoAcesso =='FJ'){
                    check_login_empresa(2);
                   $usuario_id= $this->session->userdata('SessionEmpresaPermissoes'); //Id do usu�rio logado e selecionado

                }
                else{

                    redirect(site_url());// redireciona para a home caso nenhuma opção seja selecionada
                }
                
                $data['acesso']=array('tipoacesso'=>$TipoAcesso);
                
                // este helper controla quem esta logado para exibir o menu da area restrita
                seleciona_menu_area_restrita($TipoAcesso);

                //T�tulo
		$data['title'] = 'Modulo de Pesquisa';

                //Lista de pesquisas do usuário
		$data['inscricoes'] = $this->default_model->get_all('pesquisas', array('pesquisas.*'), 0, NULL, array('inscritos_id ' => $usuario_id),null, 'id_pesquisas', 'DESC',null);

		
		//Carrega view
		$this->loadView('area_restrita_modulo_de_pesquisa/area-restrita-dashboard', $data);
	}

	public function banco_de_dados($id,$TipoAcesso){

                // aqui verifica aonde fica o gerenciamento de permissoes da area ele pe
                if ($TipoAcesso=='J'){
                   check_login_empresa(2);
                   $usuario_id= $this->session->userdata('SessionIdEmpresa'); //Id do usuário logado e selecionado                
                }elseif ($TipoAcesso =='FJ'){
                    check_login_empresa(2);
                   $usuario_id= $this->session->userdata('SessionEmpresaPermissoes'); //Id do usuário logado e selecionado

                }
                else{

                  redirect(site_url());// redireciona para a home caso nenhuma opção seja selecionada
                }

                $data['acesso']=array('tipoacesso'=>$TipoAcesso);





                //T�tulo
		$data['title'] = 'Modulo de Pesquisa';
                
                //Lista de pesquisas do usuário
		$data['inscricoes'] = $this->default_model->get_all('pesquisas', array('pesquisas.*'), 0, NULL, array('id_pesquisas' => $id),null, 'id_pesquisas', 'DESC',null);


		if($data['inscricoes'][0]->status == 'AP') redirect(site_url());
		
		//Carrega view
		$this->loadView('area_restrita_modulo_de_pesquisa/area-restrita-banco-dados', $data);
	}
        
        
        
        public function logomarca($id,$TipoAcesso){

                // aqui verifica aonde fica o gerenciamento de permissoes da area ele pe
                if ($TipoAcesso=='J'){
                   check_login_empresa(2);
                   $usuario_id= $this->session->userdata('SessionIdEmpresa'); //Id do usuário logado e selecionado                
                }elseif ($TipoAcesso =='FJ'){
                    check_login_empresa(2);
                   $usuario_id= $this->session->userdata('SessionEmpresaPermissoes'); //Id do usuário logado e selecionado

                }
                else{

                  redirect(site_url());// redireciona para a home caso nenhuma opção seja selecionada
                }

                $data['acesso']=array('tipoacesso'=>$TipoAcesso);





                //T�tulo
		$data['title'] = 'Modulo de Pesquisa';
                
                //Lista de pesquisas do usuário
		$data['inscricoes'] = $this->default_model->get_all('pesquisas', array('pesquisas.*'), 0, NULL, array('id_pesquisas' => $id),null, 'id_pesquisas', 'DESC',null);
		
		if($data['inscricoes'][0]->status == 'AP') redirect(site_url());

		//Carrega view
		$this->loadView('area_restrita_modulo_de_pesquisa/area-restrita-logomarca', $data);
	}
        
        
        
        
        
        
        public function relatorio($id,$TipoAcesso){

                // aqui verifica aonde fica o gerenciamento de permissoes da area ele pe
                if ($TipoAcesso=='J'){
                   check_login_empresa(2);
                   $usuario_id= $this->session->userdata('SessionIdEmpresa'); //Id do usuário logado e selecionado                
                }elseif ($TipoAcesso =='FJ'){
                    check_login_empresa(2);
                   $usuario_id= $this->session->userdata('SessionEmpresaPermissoes'); //Id do usuário logado e selecionado

                }
                else{

                  redirect(site_url());// redireciona para a home caso nenhuma opção seja selecionada
                }

                $data['acesso']=array('tipoacesso'=>$TipoAcesso);





                //T�tulo
		$data['title'] = 'Modulo de Pesquisa';
                
                //Lista de pesquisas do usuário
		$data['inscricoes'] = $this->default_model->get_all('pesquisas', array('pesquisas.*'), 0, NULL, array('id_pesquisas' => $id),null, 'id_pesquisas', 'DESC',null);


		//Carrega view
		$this->loadView('area_restrita_modulo_de_pesquisa/area-restrita-relatorio', $data);
	}
        
         public function functionSalvaDados($id_pesquisa=false,$tipoacesso=false){
             
              if($id_pesquisa==false || $tipoacesso==false) {                
                 $this->session->set_flashdata('msg', 'Erro: o arquivo não foi enviado');
                 return(site_url());
            }else{
                
                $this->db->select('*');
                $this->db->from('pesquisas');
                $this->db->where(array('id_pesquisas'=>$id_pesquisa));
                $query=  $this->db->get();
                if($query->num_rows<=0){
                    $this->session->set_flashdata('msg', 'Erro: o arquivo não foi enviado');
                    return(site_url());
                }else{                    
                    $dbdados=$query->result();
                    $pemissoes='*';
                    if($dbdados[0]->arquivo_dados){//alterar                     
                       $newname=$dbdados[0]->arquivo_dados;
                       $nome=explode( '.',$newname);
                       $newname=$nome[0];
                     }else{//inserir 1 vez
                         $newname=date('dmYHis');    
                         
                     }  
                       $caminho='./assets/uploads/ModuloPesquisa/Arquivos/';                     
                      
                       $retorno=multiple_upload('userfile',$caminho,$pemissoes,null,$newname,true,false);
                        
                        if(isset($retorno['file_name'])){  
                            // salva o nome do arquivo no bando  
                            $this->db->where(array('id_pesquisas'=>$id_pesquisa));
                            $data['update']=array('arquivo_dados'=>$retorno['file_name']);
                            $this->db->update('pesquisas',$data['update']);                       
                           
                            $this->session->set_flashdata('msg', 'O arquivo foi enviado com sucesso');
                       }else{
                           $this->session->set_flashdata('msg', $retorno['erro']);                           
                       }
                        
                   
                        redirect(site_url('area_restrita_modulo_de_pesquisa/banco_de_dados/'.$id_pesquisa.'/'.$tipoacesso)); 
                  
                  
                    
                }
                

            }
            
             
         }
       
      public function functionSalvalogo($id_pesquisa=false,$tipoacesso=false){
                  
            if($id_pesquisa==false || $tipoacesso==false) {                
                 $this->session->set_flashdata('msg', 'Erro: o arquivo não foi enviado');
                 return(site_url());
            }else{
                
                $this->db->select('*');
                $this->db->from('pesquisas');
                $this->db->where(array('id_pesquisas'=>$id_pesquisa));
                $query=  $this->db->get();
                if($query->num_rows<=0){
                    $this->session->set_flashdata('msg', 'Erro: o arquivo não foi enviado');
                    return(site_url());
                }else{                    
                    $dbdados=$query->result();
                    $pemissoes='jpg|gif|png';
                    if($dbdados[0]->logo){//alterar                     
                       $newname=$dbdados[0]->logo;
                       $nome=explode( '.',$newname);
                       $newname=$nome[0];
                     }else{//inserir 1 vez
                         $newname=date('dmYHis');    
                         
                     }  
                       $caminho='./assets/uploads/logo/';                     
                      
                       $retorno=multiple_upload('userfile',$caminho,$pemissoes,null,$newname,true,false);
                        
                        if(isset($retorno['file_name'])){  
                            // salva o nome do arquivo no bando  
                            $this->db->where(array('id_pesquisas'=>$id_pesquisa));
                            $data['update']=array('logo'=>$retorno['file_name']);
                            $this->db->update('pesquisas',$data['update']);                       
                           
                            $this->session->set_flashdata('msg', 'O arquivo foi enviado com sucesso');
                       }else{
                           $this->session->set_flashdata('msg', $retorno['erro']);                           
                       }
                        
                   
                        redirect(site_url('area_restrita_modulo_de_pesquisa/logomarca/'.$id_pesquisa.'/'.$tipoacesso)); 
                  
                  
                    
                }
                

            }
            
             
         }

         
         
         
         
         
         
         
         
         
        
       public function functionUp_($id_pesquisa=false,$tipo=false,$chave=false){

            if($id_pesquisa==false || $tipo==false || $chave==false) {
                return false;
            }
                $this->db->select('*');
                $this->db->from('pesquisas');
                $this->db->where(array('id_pesquisas'=>$id_pesquisa,'chave'=>$chave));
                $query=  $this->db->get();

                if ($query->num_rows>0) {
                     $result= $query->result();
                     
                  if($tipo=='R'){ //relatório
                       $nome_arquivo=$result[0]->arquivo_relatorio;
                       $nome=explode( '.',$nome_arquivo);
                       $extensao=$nome[1];
                       $newnome='Relatório '.$result[0]->titulo.'.'.$extensao;
                       $caminho=site_url('assets/uploads/logo/'.$nome_arquivo);
                  }elseif($tipo=='B'){ //banco de dados
                        $nome_arquivo=$result[0]->arquivo_dados;
                        $nome=explode( '.',$nome_arquivo);
                        $extensao=$nome[1];
                        $newnome='Banco de dados '.$result[0]->titulo.'.'.$extensao;
                        $caminho=site_url('assets/uploads/ModuloPesquisa/Arquivos/'.$nome_arquivo);
                      
                  }elseif($tipo=='L'){ //banco de dados
                        $nome_arquivo=$result[0]->logo;
                        $nome=explode( '.',$nome_arquivo);
                        $extensao=$nome[1];
                        $newnome='Banco de dados '.$result[0]->titulo.'.'.$extensao;
                        $caminho=site_url('assets/uploads/logo/'.$nome_arquivo);
                      
                  }
                   //Define o cabeçalho para download
                   header('Content-type: application/'.$extensao);
                   header('Content-Disposition: attachment; filename="'.$newnome.'"');
                   header("Content-Transfer-Encoding: binary");
                   header('Expires: 0');
                   header('Pragma: no-cache');
                   readfile($caminho);

                }else{
                   return false;
                }

        }
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

	public function salvar_questionario($id,$TipoAcesso){




               // aqui verifica aonde fica o gerenciamento de permissoes da area ele pe
                if ($TipoAcesso=='J'){
                   check_login_empresa(2);
                   $usuario_id= $this->session->userdata('SessionIdEmpresa'); //Id do usu�rio logado e selecionado
                }elseif ($TipoAcesso=='F'){
                    check_login_aluno();
                    $usuario_id=$this->session->userdata('SessionIdAluno'); //Id do usu�rio logado e selecionado

                }elseif ($TipoAcesso =='FJ'){
                    check_login_empresa(2);
                   $usuario_id= $this->session->userdata('SessionEmpresaPermissoes'); //Id do usu�rio logado e selecionado

                }
                else{

                    redirect(site_url());// redireciona para a home caso nenhuma opção seja selecionada
                }
                $data['acesso']=array('tipoacesso'=>$TipoAcesso);

                //T�tulo
		$data['title'] = 'Autodiagn�sticos';

		//A��o do usu�rio
		$dados = $_POST;
		$acao = $dados['acao'];
		unset($dados['acao']);

		//Id do usu�rio logado
		//$usuario_id = $this->session->userdata('SessionIdAluno') ? $this->session->userdata('SessionIdAluno') : $this->session->userdata('SessionIdEmpresa');

		//Inscri��o referente
		$join = array('compras' => array('where' => 'compras.id = autodiagnostico_inscricoes.compras_id', 'type' => 'inner'));
		$inscricao = $this->default_model->get_by_id('autodiagnostico_inscricoes', $id, array('autodiagnostico_inscricoes.*'), array('inscritos_id ' => $usuario_id,'compras.status' => 'AP'), $join, 'id_inscricao');

		//Valida inscrição
		if(!$inscricao)
			return $this->index($TipoAcesso);

		//Recebe ids
		$data['inscricao_id'] = $inscricao_id = $inscricao->id_inscricao;
		$autodiagnostico_id = $inscricao->autodiagnosticos_id_autodiagnostico;

		//Salva respostas
		foreach($dados as $pergunta_id => $resposta_valor){
			if($resposta = $this->default_model->get_all('autodiagnostico_respostas', array('*'), 0, 1, array('autodiagnostico_perguntas_id_pergunta' => $pergunta_id, 'autodiagnostico_inscricoes_id_inscricao' => $inscricao_id)))
				$this->default_model->update('autodiagnostico_respostas', $resposta[0]->id_resposta, array('autodiagnostico_perguntas_id_pergunta' => $pergunta_id, 'valor' => $resposta_valor), 'id_resposta');
			else
				$this->default_model->insert('autodiagnostico_respostas', array('autodiagnostico_perguntas_id_pergunta' => $pergunta_id, 'valor' => $resposta_valor, 'autodiagnostico_inscricoes_id_inscricao' => $inscricao_id));
		}

		//Finaliza inscri��o e envia resultado
		if($acao == 'enviar'){

			//Atualiza status da inscri��o para 'Finalizado'
			$this->default_model->update('autodiagnostico_inscricoes', $inscricao_id, array('status' => 'F'), 'id_inscricao');

			//Envia resultado por email
			$this->envio_email_resultado($id, $TipoAcesso);
		}
		else if($acao == 'salvar'){

			//Atualiza status da inscri��o para 'Em Andamento'
			$this->default_model->update('autodiagnostico_inscricoes', $inscricao_id, array('status' => 'A'), 'id_inscricao');
		}

		return $this->index($TipoAcesso);
	}

	public function envio_email_resultado($id,$TipoAcesso){

                 // aqui verifica aonde fica o gerenciamento de permissoes da area ele pe
                if ($TipoAcesso=='J'){
                   check_login_empresa(2);
                   $usuario_id= $this->session->userdata('SessionIdEmpresa'); //Id do usu�rio logado e selecionado
                }elseif ($TipoAcesso=='F'){
                    check_login_aluno();
                    $usuario_id=$this->session->userdata('SessionIdAluno'); //Id do usu�rio logado e selecionado

                }elseif ($TipoAcesso =='FJ'){
                    check_login_empresa(2);
                   $usuario_id= $this->session->userdata('SessionEmpresaPermissoes'); //Id do usu�rio logado e selecionado

                }
                else{

                    redirect(site_url());// redireciona para a home caso nenhuma opção seja selecionada
                }
                $data['acesso']=array('tipoacesso'=>$TipoAcesso);


                //Id do usu�rio logado
		//$usuario_id = $this->session->userdata('SessionIdAluno') ? $this->session->userdata('SessionIdAluno') : $this->session->userdata('SessionIdEmpresa');

		//Inscri��o referente
		$join = array('compras' => array('where' => 'compras.id = autodiagnostico_inscricoes.compras_id', 'type' => 'inner'));
		$join += array('inscritos' => array('where' => 'inscritos.id = inscritos_id', 'type' => 'inner'));
		$inscricao = $this->default_model->get_by_id('autodiagnostico_inscricoes', $id, array('autodiagnostico_inscricoes.*, inscritos.nome, inscritos.email'), array('compras.status' => 'AP', 'inscritos.id' => $usuario_id), $join, 'id_inscricao');

		//Valida inscrição
		if(!$inscricao)
			return $this->index($TipoAcesso);

		//Recebe ids
		$inscricao_id = $inscricao->id_inscricao;
		$autodiagnostico_id = $inscricao->autodiagnosticos_id_autodiagnostico;

		//Autodiagn�stico
		$dados_email['autodiagnostico'] = $this->default_model->get_by_id('autodiagnosticos', $autodiagnostico_id, array('*'), NULL, NULL, 'id_autodiagnostico');

		//Busca a pontua��o obtida
		$join = array('autodiagnostico_inscricoes' => array('where' => 'autodiagnostico_inscricoes.id_inscricao = autodiagnostico_inscricoes_id_inscricao', 'type' => 'inner'));
		$data['respostas'] = $this->default_model->get_all('autodiagnostico_respostas', array('autodiagnostico_respostas.*, SUM(valor) as valor'), 0, NULL, array('autodiagnostico_inscricoes_id_inscricao' => $inscricao_id), $join);
		$dados_email['pontuacao_obtida'] = $data['respostas'][0]->valor;

		//Busca resultado, de acordo com pontua��o obtida
		$data['resultados'] = $this->default_model->get_all('autodiagnostico_resultados', array('*'), 0, 1, array('autodiagnosticos_id_autodiagnostico' => $autodiagnostico_id, 'pontuacao_minima <= ' => $dados_email['pontuacao_obtida'], 'pontuacao_maxima >=' => $dados_email['pontuacao_obtida']), NULL, 'id_resultado', 'ASC');
		$dados_email['resultado_obtido'] = $data['resultados'][0] ? $data['resultados'][0]->texto : false;

		$conteudo = $this->load->view('auto_diagnostico/email_resultado_autodiagnostico', $dados_email, true);

		//carrega library de email
		$this->load->library('email');
		$config['protocol'] = 'mail';
		$config['mailtype'] = 'html';

		//Par�metros
		$this->email->initialize($config);
		$this->email->from('luana@multiwebdigital.com.br', 'MB CONSULTORIA');
		$this->email->to($inscricao->email, $inscricao->nome);
                //$this->email->to($inscricao->email);
		//$this->email->reply_to('mb@mb.com.br');
		//$this->email->cc(array('luana@multiwebdigital.com.br'));
		$this->email->subject('MB CONSULTORIA - RESULTADO AUTODIAGNÓSTICO');
		$this->email->message($conteudo);
		$this->email->send();
                //echo $this->email->print_debugger();
                //exit();

		return $this->ver_resultado($id, $TipoAcesso);
	}

	public function ver_resultado($id,$TipoAcesso,$gerar_pdf = false){

		//T�tulo
		$data['title'] = 'Autodiagnósticos';

                     // aqui verifica aonde fica o gerenciamento de permissoes da area ele pe
                if ($TipoAcesso=='J'){
                   check_login_empresa(2);
                   $usuario_id= $this->session->userdata('SessionIdEmpresa'); //Id do usu�rio logado e selecionado
                }elseif ($TipoAcesso=='F'){
                    check_login_aluno();
                    $usuario_id=$this->session->userdata('SessionIdAluno'); //Id do usu�rio logado e selecionado

                }elseif ($TipoAcesso =='FJ'){
                    check_login_empresa(2);
                   $usuario_id= $this->session->userdata('SessionEmpresaPermissoes'); //Id do usu�rio logado e selecionado

                }
                else{
                   redirect(site_url());// redireciona para a home caso nenhuma opção seja selecionada
                }

                $data['acesso']=array('tipoacesso'=>$TipoAcesso);

                 //Id do usu�rio logado
		//$usuario_id = $this->session->userdata('SessionIdAluno') ? $this->session->userdata('SessionIdAluno') : $this->session->userdata('SessionIdEmpresa');

		//Inscri��o referente
		$join = array('compras' => array('where' => 'compras.id = autodiagnostico_inscricoes.compras_id', 'type' => 'inner'));
		$inscricao = $this->default_model->get_by_id('autodiagnostico_inscricoes', $id, array('autodiagnostico_inscricoes.*'), array('inscritos_id ' => $usuario_id,'compras.status' => 'AP'), $join, 'id_inscricao');

		//Valida inscrição
		if(!$inscricao)
			return $this->index($TipoAcesso);

		//Recebe ids
		$data['inscricao_id'] = $inscricao_id = $inscricao->id_inscricao;
		$autodiagnostico_id = $inscricao->autodiagnosticos_id_autodiagnostico;

		//Autodiagn�stico
		$data['autodiagnostico'] = $this->default_model->get_by_id('autodiagnosticos', $autodiagnostico_id, array('*'), NULL, NULL, 'id_autodiagnostico');

		//Grupos
		$data['grupos'] = $this->default_model->get_all('autodiagnosticos_grupos_perguntas', array('*'), 0, NULL, array('autodiagnosticos_id_autodiagnostico' => $autodiagnostico_id), NULL, 'id_grupo_pergunta', 'ASC');

		$join  = array('autodiagnosticos_grupos_perguntas' => array('where' => 'autodiagnosticos_grupos_perguntas.id_grupo_pergunta = autodiagnosticos_grupos_perguntas_id_grupo_pergunta', 'type' => 'inner'));
		$join += array('autodiagnosticos' => array('where' => 'autodiagnosticos.id_autodiagnostico = autodiagnosticos_grupos_perguntas.autodiagnosticos_id_autodiagnostico', 'type' => 'inner'));
		$join_respostas = array('autodiagnostico_inscricoes' => array('where' => 'autodiagnostico_inscricoes.id_inscricao = autodiagnostico_inscricoes_id_inscricao', 'type' => 'inner'));

		foreach($data['grupos'] as $key => $grupo){
			$perguntas = $this->default_model->get_all('autodiagnostico_perguntas', array('autodiagnostico_perguntas.*, autodiagnosticos.*, autodiagnosticos_grupos_perguntas.*'), 0, NULL, array('autodiagnosticos_grupos_perguntas_id_grupo_pergunta' => $grupo->id_grupo_pergunta), $join, 'autodiagnosticos_grupos_perguntas_id_grupo_pergunta', 'ASC', null);

			$pontuacao_maxima = $pontuacao_obtida = 0;
			foreach($perguntas as $pergunta){
				$valor_maior = $this->retorna_maior_valor($pergunta);
				$pontuacao_maxima += $valor_maior;

				//Busca a pontua��o obtida
				$resposta = $this->default_model->get_all('autodiagnostico_respostas', array('autodiagnostico_respostas.*, SUM(valor) as valor'), 0, NULL, array('autodiagnostico_inscricoes_id_inscricao' => $inscricao_id, 'autodiagnostico_perguntas_id_pergunta' => $pergunta->id_pergunta), $join_respostas);
				if($resposta)
					$pontuacao_obtida += $resposta[0]->valor;
			}

			$data['grupos'][$key]->pontuacao_maxima = $pontuacao_maxima;
			$data['grupos'][$key]->pontuacao_obtida = $pontuacao_obtida;
			$data['grupos'][$key]->porcentagem = $pontuacao_maxima > 0 ? round(($pontuacao_obtida*100)/$pontuacao_maxima) : 0;
		}

		//Busca a pontua��o obtida
		$join = array('autodiagnostico_inscricoes' => array('where' => 'autodiagnostico_inscricoes.id_inscricao = autodiagnostico_inscricoes_id_inscricao', 'type' => 'inner'));
		$data['respostas'] = $this->default_model->get_all('autodiagnostico_respostas', array('autodiagnostico_respostas.*, SUM(valor) as valor'), 0, NULL, array('autodiagnostico_inscricoes_id_inscricao' => $inscricao_id), $join);
		if($data['respostas'])
			$data['pontuacao_obtida'] = $data['respostas'][0]->valor;

		//Busca resultado, de acordo com pontua��o obtida
		if($data['pontuacao_obtida']){
			$data['resultados'] = $this->default_model->get_all('autodiagnostico_resultados', array('*'), 0, 1, array('autodiagnosticos_id_autodiagnostico' => $autodiagnostico_id, 'pontuacao_minima <= ' => $data['pontuacao_obtida'], 'pontuacao_maxima >=' => $data['pontuacao_obtida']), NULL, 'id_resultado', 'ASC');
			$data['resultado_obtido'] = $data['resultados'] ? $data['resultados'][0]->texto : false;
		}

		if($gerar_pdf){

			//helpers
			$this->load->helper(array('dompdf', 'file'));

			//recebe html da view
			$html = utf8_decode($this->load->view('auto_diagnostico/resultado_pdf', $data, true));
                        //print_r($html);
                        //exit();
                    
			//Cria pdf
			pdf_create($html, 'MB CONSULTORIA - RESULTADO - '.$data['autodiagnostico']->nome);
		}
		else
			$this->loadView('auto_diagnostico/autodiagnostico-resultados', $data);
	}

	public function retorna_maior_valor($pergunta){

		$maior = 0;
		$maior = $pergunta->peso1 > $maior ? $pergunta->peso1 : $maior;
		$maior = $pergunta->peso2 > $maior ? $pergunta->peso2 : $maior;
		$maior = $pergunta->peso3 > $maior ? $pergunta->peso3 : $maior;
		$maior = $pergunta->peso4 > $maior ? $pergunta->peso4 : $maior;

		return $maior;
	}
}
