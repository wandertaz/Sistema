<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Area_restrita_autodiagnosticos extends MY_Controller {

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
                
                // este helper controla quem esta logado para exibir o menu da area restrita
                seleciona_menu_area_restrita($TipoAcesso);

                //T�tulo
		$data['title'] = 'Autodiagnósticos';

		//Id do usu�rio logado
		//$usuario_id = $this->session->userdata('SessionIdAluno') ? $this->session->userdata('SessionIdAluno') : $this->session->userdata('SessionIdEmpresa');

		//Lista de autodiagn�sticos do usu�rio
		$join = array('autodiagnosticos' => array('where' => 'autodiagnosticos.id_autodiagnostico = autodiagnosticos_id_autodiagnostico', 'type' => 'inner'));
		$join += array('tipos_autodiagnosticos' => array('where' => 'tipos_autodiagnosticos.id_tipo_autodiagnostico = autodiagnosticos.tipos_autodiagnosticos_id_tipo_autodiagnostico', 'type' => 'inner'));
		$join += array('compras' => array('where' => 'compras.id = autodiagnostico_inscricoes.compras_id', 'type' => 'inner'));
		$data['inscricoes'] = $this->default_model->get_all('autodiagnostico_inscricoes', array('autodiagnostico_inscricoes.*, autodiagnosticos.*, nome_tipo as nome_tipo'), 0, NULL, array('inscritos_id ' => $usuario_id, 'compras.status' => 'AP'), $join, 'id_inscricao', 'DESC', 'id_inscricao');

		foreach($data['inscricoes'] as $key => $inscricao){

			//N�mero de perguntas respondidas
			$respostas = $this->default_model->get_all('autodiagnostico_respostas', array('COUNT(*) as total_respondidas'), 0, NULL, array('autodiagnostico_inscricoes_id_inscricao ' => $inscricao->id_inscricao));
			$total_respondidas = $respostas[0]->total_respondidas;

			//N�mero total de perguntas
			$join = array('autodiagnosticos_grupos_perguntas' => array('where' => 'autodiagnosticos_grupos_perguntas.id_grupo_pergunta = autodiagnosticos_grupos_perguntas_id_grupo_pergunta', 'type' => 'inner'));
			$perguntas = $this->default_model->get_all('autodiagnostico_perguntas', array('COUNT(*) as total_perguntas'), 0, NULL, array('autodiagnosticos_grupos_perguntas.autodiagnosticos_id_autodiagnostico ' => $inscricao->autodiagnosticos_id_autodiagnostico), $join);
			$total_perguntas = $perguntas[0]->total_perguntas;

			//Calcula porcentagem de perguntas respondidas
			$data['inscricoes'][$key]->porcentagem = $total_perguntas > 0 ? round(($total_respondidas*100)/$total_perguntas) : 0;
		}

		//Carrega view
		$this->loadView('auto_diagnostico/area-restrita-dashboard', $data);
	}

	public function ver_autodiagnostico($id,$x,$TipoAcesso){

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
		$data['title'] = 'Autodiagnósticos';

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

		//Valida se autodiagn�stico j� foi finalizado
		if($inscricao->status == 'F')
			return $this->ver_resultado($id,$TipoAcesso);

		//Busca perguntas j� respondidas
		$respostas = $this->default_model->get_all('autodiagnostico_respostas', array('*'), 0, NULL, array('autodiagnostico_inscricoes_id_inscricao' => $inscricao_id));
		foreach($respostas as $resposta){
			$data['respostas'][$resposta->autodiagnostico_perguntas_id_pergunta] = $resposta->valor;
		}

		//Autodiagn�stico
		$data['autodiagnostico'] = $this->default_model->get_by_id('autodiagnosticos', $autodiagnostico_id, array('*'), NULL, NULL, 'id_autodiagnostico');

		//Grupos
		$data['grupos'] = $this->default_model->get_all('autodiagnosticos_grupos_perguntas', array('*'), 0, NULL, array('autodiagnosticos_id_autodiagnostico' => $autodiagnostico_id), NULL, 'id_grupo_pergunta', 'ASC');

		//Perguntas
		$join  = array('autodiagnosticos_grupos_perguntas' => array('where' => 'autodiagnosticos_grupos_perguntas.id_grupo_pergunta = autodiagnosticos_grupos_perguntas_id_grupo_pergunta', 'type' => 'inner'));
		$join += array('autodiagnosticos' => array('where' => 'autodiagnosticos.id_autodiagnostico = autodiagnosticos_grupos_perguntas.autodiagnosticos_id_autodiagnostico', 'type' => 'inner'));
		foreach($data['grupos'] as $key => $grupo){
			$data['grupos'][$key]->perguntas = $this->default_model->get_all('autodiagnostico_perguntas', array('autodiagnostico_perguntas.*'), 0, NULL, array('autodiagnosticos_grupos_perguntas_id_grupo_pergunta' => $grupo->id_grupo_pergunta), $join, 'autodiagnosticos_grupos_perguntas_id_grupo_pergunta', 'ASC', null);
		}

		//Carrega view
		$this->loadView('auto_diagnostico/autodiagnostico-execucao', $data);
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
                $this->session->set_flashdata('msg', 'E-mail enviado com sucesso!');
               //echo("<script> alert('OK');</script>");
		//return $this->ver_resultado($id, $TipoAcesso);
                redirect(site_url('area_restrita_autodiagnosticos/ver_resultado/'.$id.'/'.$TipoAcesso));
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
