<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carrinho extends MY_Controller {

	//Retira a proteção deste controller
	protected $_dontProtectMe = true;

	var $tipos_produtos = array('AB' => 'Curso Aberto', 'IN' => 'Curso In Company', 'AL' => 'Programa de Alta Performance', 'DE'=> 'Programa de Desenvolvimento', 'EL' => 'E-learning', 'AU' => 'Autodiagnóstico','BT'=>'Banco de Talentos','DO' => 'Downloads');

	public function __construct(){
		parent::__construct();

		//Carrega model e helpers
		$this->load->model("default_model");
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('br_date');
                $this->load->helper('auxiliar_helper');
                $this->load->helper('number_helper');

	}

	public function index(){

        //Título
		$data['title'] = 'Carrinho';

		//Array com tipos de cursos
		$data['tipos_cursos'] = $this->tipos_produtos;

		//Dados do carrinho em sessão
		$data['carrinho'] = $this->session->userdata('carrinho');

               //print_r($data['carrinho']);
		//Carrega view
		$this->loadView('area-restrita-carrinho', $data);
	}

	public function inscricao($curso_id, $tipo){

		if($tipo == 'AB' || $tipo == 'AL'){
			$url = array('AB' => 'ver_curso_aberto', 'AL' => 'ver_alta_performance');
			redirect('educacao_corporativa/'.$url[$tipo].'/'.$curso_id);
		}
		else{
			redirect('carrinho/adicionar/'.$curso_id.'/'.$tipo);
		}
	}

	public function adicionar($registro_id, $tipo, $turma_id = false,$tipo_pessoa='F'){

		$dados['carrinho'] = $this->session->userdata('carrinho');

		if($tipo == 'AL' || $tipo == 'AB'){
			if($turma_id){
				$turma = $this->default_model->get_by_id('turmas', $turma_id);
				$inscricoes_turma = $this->default_model->get_all('inscricoes', array('COUNT(*) as total'), 0, NULL, array('curso_id' => $registro_id, 'tipo_curso' => $tipo, 'turma_id' => $turma_id, 'status <> ' => 'CA'));

				$limite_vagas = $turma->numero_vagas;
				$num_inscricoes = $inscricoes_turma ? $inscricoes_turma[0]->total : 0;

				if($num_inscricoes >= $limite_vagas){
					$url = array('AB' => 'ver_curso_aberto', 'AL' => 'ver_alta_performance');
					$this->session->set_flashdata('msg', 'Esta turma já atingiu o limite de vagas!');
					redirect('educacao_corporativa/'.$url[$tipo].'/'.$registro_id);
				}
			}
		}



		if($tipo == 'AU'){
			$autodiagnostico = $this->default_model->get_by_id('autodiagnosticos', $registro_id, array('*'), NULL, NULL, 'id_autodiagnostico');
			$titulo = $autodiagnostico->nome;
			$valor = $autodiagnostico->preco;
		}elseif($tipo == 'BT'){
                    //aqui o parametro turma recebe o numero de curriculos
                    $this->db->select('*');
                    $this->db->from('curriculo_preco_unitario');
                    $this->db->where('curriculo_preco_unitario.preco_curriculo >',0);
                    $query= $this->db->get();
                    $resultado=$query->result();

                    $titulo = $registro_id.' curriculos completos';
                    $valor = number_format(($registro_id * $resultado[0]->preco_curriculo),2);

                    }elseif($tipo == 'DO'){
                    //aqui o parametro turma recebe o numero de curriculos
                    $this->db->select('*');
                    $this->db->from('downloads_versoes');
                    $this->db->join('downloads','downloads_versoes.downloads_id_downloads=downloads.id_downloads');
                    $this->db->where('downloads_versoes.id_download_versoes',$registro_id);
                    $query= $this->db->get();
                    $resultado=$query->result();

                    $ultima_versao=retorna_ultima_versao_downloads($registro_id);
                    $ultima_versao=$ultima_versao[0]['numero_versao'];// salva a versão

                    //$turma_id=;// salva a versão
                    $titulo =$resultado[0]->titulo;
                    $valor = number_format(($resultado[0]->preco),2);
                }else{
			//Busca os dados do curso
			$tabelas_cursos   = array('AB' => 'cursos_abertos', 'IN' => 'cursos_incompany', 'AL' => 'programas_alta_performance', 'DE' => 'programas_desenvolvimento', 'EL' => 'elearning');
			$curso = $this->default_model->get_by_id($tabelas_cursos[$tipo], $registro_id);
			$turma = $turma_id ? $this->default_model->get_by_id('turmas', $turma_id) : false;

			//Dados
			$titulo = $curso->titulo;
			$valor = $tipo_pessoa=='J' ? $curso->valor_juridica :$curso->valor;
		}

		//Salva os dados em sessão numero_iscricoes_juridica
		$dados['carrinho'][$registro_id.'-'.$tipo] = array('curso_id'=> $registro_id,
			'turma_id'=> $turma_id=='DO'?$turma_id ? $turma_id : false:false,
			'turma_data'	=> isset($turma) && $turma ? $turma->data_inicial : false,
			'tipo'=> $tipo,
			'titulo'=> $titulo,
			'valor'=> $valor,
			'numerovagas'=> $tipo_pessoa=='J' ? $curso->numero_inscricoes_juridica :1,
			'tipo_pessoa'=> $tipo_pessoa ? $tipo_pessoa : false,
                        'ultima_versao'=>$ultima_versao>0?$ultima_versao:'',
                    );

		$this->session->set_userdata($dados);

		//Carrega carrinho
		redirect('carrinho');
	}

	public function excluir($curso_id, $tipo){

		//Atualiza sessão retirando o item excluido
		$dados['carrinho'] = $this->session->userdata('carrinho');
		unset($dados['carrinho'][$curso_id.'-'.$tipo]);
		$this->session->set_userdata($dados);

		//Carrega view
		return $this->index();
	}

	public function identificacao($msg = false){

		//Título
		$data['title'] = 'Identificação';
		$data['mensagem'] = $msg;

		//Se já existe login, redireciona para conferência se o produto comprado for compativel com
                // tipo pessoa
		if($this->session->userdata('logged_in_Aluno') || $this->session->userdata('logged_in_Empresa')){

                    $dados['carrinho'] = $this->session->userdata('carrinho');
                    foreach($dados['carrinho'] as $itens){

                         if($this->session->userdata('logged_in_Aluno')){// se for aluno  faz isso
                             if($itens['tipo_pessoa']!='F' && $itens['tipo_pessoa']!='FJ'){
                               return $this->index();
                            }
                         }
                         elseif($this->session->userdata('logged_in_Empresa')){ // se for empresa faz isso
                            if($itens['tipo_pessoa']!='J'  && $itens['tipo'] != 'AU' && $itens['tipo'] != 'BT' && $itens['tipo'] != 'DO'){
                               return $this->index();
                            }
                         }
                    }

                   return $this->conferencia();
                }


		//Carrega view
		$this->loadView('area-restrita-carrinho-identificacao', $data);
	}

	public function verifica_identificacao(){

		//Título
		$data['title'] = 'Identificação';

		//Dados do post
		$data['tipo']  = $this->input->post('tipo');
		$data['email'] = $this->input->post('email');
		$data['senha'] = $this->input->post('senha');

		//Retorno de validação
		if(!$data['email'])
			return $this->identificacao('É necessário digitar um e-mail.');
		if(!$data['tipo'])
			return $this->identificacao('É necessário selecionar uma opção.');

		//Verifica se é login ou cadastro
		if($data['tipo'] == 'login')
			return (!$data['senha'] ? $this->identificacao('Digite sua senha.') : $this->login($data['email'], $data['senha']));
		else{

			//Verifica se e-mail existe
			$inscrito = $this->default_model->get_all('inscritos', array('id'), 0, NULL, array('email' => $data['email'], 'ativo' => 'S'));

			//Retorno
			if(isset($inscrito[0]->id))
				return $this->identificacao('Este e-mail já está cadastrado.');
			else
				$this->loadView('area-restrita-carrinho-cadastro', $data);
		}
	}

	public function login($email, $senha){

		$this->db->select('id,nome,email,data_nascimento,tipo_pessoa');
		$this->db->from('inscritos');
		$this->db->where(array('email' => $email, 'senha' => $senha, 'ativo' => 'S'));
		$query = $this->db->get();
		$data= $query->result();

		if(isset($data[0]->id)){
                    if ($data[0]->tipo_pessoa =='F'){
                        $dados = array('logged_in_Aluno' => TRUE,
                         'SessionIdAluno' 	  => $data[0]->id,
                         'SessionTipoPessoa' 	  => $data[0]->tipo_pessoa,
                         'SessionNomeAluno' 	  => $data[0]->nome,
                         'SessionEmailAluno' 	  => $data[0]->email,
                         'SessionDtNascimento' 	  => br_date($data[0]->data_nascimento)

                         );
                        $this->session->set_userdata($dados);


                     } elseif ($data[0]->tipo_pessoa =='J'){
                          $dados = array(
                          'logged_in_Empresa' => TRUE,
                          'SessionIdEmpresa' 	  => $data[0]->id,
                          'SessionTipoPessoa' 	  => $data[0]->tipo_pessoa,
                          'SessionNomeEmpresa' 	  => $data[0]->nome,
                          'SessionEmailEmpresa' 	  => $data[0]->email,
                          'SessionDtCriacao' 	  => br_date($data[0]->data_nascimento)

                          );
                         $this->session->set_userdata($dados);
                     }


                    $dados['carrinho'] = $this->session->userdata('carrinho');
                    foreach($dados['carrinho'] as $itens){

                         if($this->session->userdata('logged_in_Aluno')){// se for aluno  faz isso
                             if($itens['tipo_pessoa']!='F'){
                               return $this->index();
                            }
                         }
                         elseif($this->session->userdata('logged_in_Empresa')){ // se for empresa faz isso
                            if($itens['tipo_pessoa']!='J'){
                               return $this->index();
                            }
                         }

                    }


			return $this->conferencia();
		}
		else{
			return $this->identificacao('Login ou senha inválidos');
		}
	}

	public function cadastro(){

		//Recebe Post
		$data = $_POST;

		if(isset($data['nome']) && isset($data['email']) && isset($data['senha'])){

			//Salva registro para receber news
			if(isset($data['receberNews']) && $data['receberNews'] == 'S')
				$this->default_model->insert('emails_news', array('nome' => $data['nome'], 'email' => $data['email']));

			//Trata os dados
			$data['data_nascimento'] = w3c_date($data['data_nascimento']);
			$data['senha'] = trim($data['senha']);
			unset($data['confirmar-senha'], $data['enviar'], $data['receberNews']);

			//Salva so dados
			$rows_affected = $this->default_model->insert('inscritos', $data);

			//Retorno
			if($rows_affected == 1){
				$dados = array('logged_in_Aluno' => TRUE,
					 'SessionIdAluno' 	  	  => $this->db->insert_id(),
					 'SessionNomeAluno' 	  => $data['nome'],
					 'SessionEmailAluno' 	  => $data['email'],
					 'SessionDtNascimento' 	  => br_date($data['data_nascimento'])
				 );
				$this->session->set_userdata($dados);
				return $this->conferencia();
			}
			else
				$msg = 'Não foi possível salvar os dados.';

			$this->session->set_flashdata('msg', $msg);
		}

		//Retorno
		$this->loadView('area-restrita-carrinho-cadastro', $data);

	}

	public function conferencia(){

		//Título
		$data['title'] = 'Identificação';

		//Array com tipos de cursos
		$data['tipos_cursos'] = $this->tipos_produtos;

		//Dados do carrinho em sessão
		$data['carrinho'] = $this->session->userdata('carrinho');
                //print_r($data['carrinho']);
		//Carrega view
		$this->loadView('area-restrita-carrinho-conferencia', $data);
	}

	public function salva_inscricao(){

		//Título
		$data['title'] = 'Inscrição';

		if (!$this->session->userdata('SessionTipoPessoa')){
			echo 'erro';
			exit();
		}

		//Total
		$total=$_POST['total'];

		if(isset($total)){

			$tipo_pessoa= $this->session->userdata('SessionTipoPessoa');

			//Insere Compra
			if($total > 0){
				$rows_affected = $this->default_model->insert('compras', array('total' => $total, 'status' => 'AG', 'created' => date('Y-m-d H:i:s')));
				$compra_id = $this->db->insert_id();
			}

			//Salva inscrições
			$carrinho = $this->session->userdata('carrinho');
			if($carrinho){
				foreach($carrinho as $item){
					if($item['tipo'] == 'AU'){
						//Monta os dados
						$dados['inscritos_id'] = $this->session->userdata('SessionIdAluno') ? $this->session->userdata('SessionIdAluno') : $this->session->userdata('SessionIdEmpresa');
						$dados['autodiagnosticos_id_autodiagnostico'] = $item['curso_id'];
						$dados['data_inscricao'] = date('Y-m-d H:i:s');
						$dados['compras_id'] = $item['valor'] > 0 ? $compra_id : NULL;
						$dados['status'] = 'P';

						//Insere inscrição
						$rows_affected = $this->default_model->insert('autodiagnostico_inscricoes', $dados);
						unset($dados);
					}
					if($item['tipo'] == 'DO'){
						//Monta os dados

						// esta variavel apenas armazena este dado para este tipo de compra
						if($tipo_pessoa=='F'){
							if($item['tipo_pessoa']=='F'){
								$dados['inscritos_id']=$this->session->userdata('SessionIdAluno');
							}
							else{
								$dados['inscritos_id']=$this->session->userdata('SessionEmpresaPermissoes');
							}
						}elseif($tipo_pessoa=='J'){
							$dados['inscritos_id']=$this->session->userdata('SessionIdEmpresa');
						}

						//$dados['inscritos_id'] = $this->session->userdata('SessionIdAluno') ? $this->session->userdata('SessionIdAluno') : $this->session->userdata('SessionIdEmpresa');
						$dados['downloads_versoes_id_download_versoes'] = $item['curso_id'];
						$dados['data_inscricao'] = date('Y-m-d H:i:s');
						$dados['compras_id'] = $item['valor'] > 0 ? $compra_id : NULL;
						$dados['valor']=$item['valor'];
						$dados['termos_download'] = 'S';

						//Insere inscrição
						$rows_affected = $this->default_model->insert('downloads_compras', $dados);
						unset($dados);
					}
					elseif($tipo_pessoa == 'F'){

						//Monta os dados
						$dados['inscrito_id'] = $this->session->userdata('SessionIdAluno');
						$dados['curso_id'] = $item['curso_id'];
						if($item['turma_id'])
							$dados['turma_id'] = $item['turma_id'];
						$dados['tipo_curso'] = $item['tipo'];
						$dados['status'] = $item['valor'] > 0 ? 'AG' : 'AP';
						$dados['valor'] = $item['valor'];
						$dados['data_aquisicao'] = date('Y-m-d');
						$dados['created'] = date('Y-m-d H:i:s');
						$dados['compra_id'] = $item['valor'] > 0 ? $compra_id : NULL;

						//Insere inscrição
						$rows_affected = $this->default_model->insert('inscricoes', $dados);
						unset($dados);
					}
					elseif ($tipo_pessoa == 'J'){


						if($item['tipo']=='BT'){

							//Monta os dados
							if ($this->session->userdata('SessionIdEmpresa')>0){
								//Id da empresa
								$dados['inscritos_id']= $this->session->userdata('SessionIdEmpresa');
							}elseif($this->session->userdata('SessionEmpresaPermissoes')>0){
								//Id da empresa
								$dados['inscritos_id']= $this->session->userdata('SessionEmpresaPermissoes');
							}

							$dados['curriculos_ids'] = str_replace('-',',',$item['turma_id']);
							$dados['valor'] = $item['valor'];
							$dados['data_inscricao'] = date('Y-m-d H:i:s');
							$dados['compra_id'] = $item['valor'] > 0 ? $compra_id : NULL;
							//Insere inscrição
							$rows_affected = $this->default_model->insert('selecao_curriculos_inscricoes', $dados);



						}else{
							//Monta os dados
							$dados['inscrito_empresa_id'] = $this->session->userdata('SessionIdEmpresa');
							$dados['curso_id'] = $item['curso_id'];
							if($item['turma_id'])
								$dados['turma_id'] = $item['turma_id'];
							$dados['tipo_curso'] = $item['tipo'];
							$dados['status'] = $item['valor'] > 0 ? 'AG' : 'AP';
							$dados['valor'] = $item['valor'];
							$dados['numero_iscritos'] = $item['numerovagas'];
							$dados['data_aquisicao'] = date('Y-m-d');
							$dados['created'] = date('Y-m-d H:i:s');
							$dados['compra_id'] = $item['valor'] > 0 ? $compra_id : NULL;
							//Insere inscrição
							$rows_affected = $this->default_model->insert('inscricoes_empresas', $dados);
						}
						unset($dados);
					}
				}

				//Retorno (Se o carrinho for zerado, será direcionado para a tela de confirmação, se não, para o pagseguro)
				if($total == 0)
					echo 'confirmacao';
				else
					echo $compra_id;
			}
			else
				echo 'erro';
		}

	}

	public function confirmacao(){

		//Título
		$data['title'] = 'Confirmação';

		$carrinho = $this->session->userdata('carrinho');


		$tipo_pessoa= $this->session->userdata('SessionTipoPessoa');
		if ($tipo_pessoa=='F'){
		   $email = $this->session->userdata('SessionEmailAluno');
		   $nome = $this->session->userdata('SessionNomeAluno');
		}elseif($tipo_pessoa=='J'){
		   $email = $this->session->userdata('SessionEmailEmpresa');
		   $nome = $this->session->userdata('SessionNomeEmpresa');
		}

		if($carrinho && $email && $nome){

			$conteudo = $this->load->view('includes/email_checkout', array('carrinho' => $carrinho, 'nome' => $nome, 'email' => $email), true);

			//carrega library de email
			$this->load->library('email');
			$config['protocol'] = 'mail';
			$config['mailtype'] = 'html';

			//Parâmetros
			$this->email->initialize($config);
			$this->email->from('luana@multiwebdigital.com.br', 'MB CONSULTORIA');
			$this->email->to($email, $nome);
			//$this->email->reply_to('mb@mb.com.br');
			//$this->email->cc(array('luana@multiwebdigital.com.br'));
			$this->email->subject('MB CONSULTORIA - PEDIDO');
			$this->email->message($conteudo);
			$this->email->send();

			//Carrega view
			$this->session->unset_userdata('carrinho');
			$this->loadView('area-restrita-carrinho-confirmacao', $data);
		}

		$this->session->unset_userdata('carrinho');

	}
}
