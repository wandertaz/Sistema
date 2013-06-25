<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class armazenamento_nas_nuvens extends MY_Controller {

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
        //esta função faz download direto sem estar logado
	public function functionUp_($id_armazenamento=false,$chave=false){

            if($id_armazenamento==false || $chave==false) {
                return false;
            }
                $this->db->select('*');
                $this->db->from('armazenamento_na_nuvem');
                $this->db->where(array('id_armazenamento'=>$id_armazenamento,'chave'=>$chave));
                $query=  $this->db->get();

                if ($query->num_rows>0) {
                     $result= $query->result();
                     
                   //Define o cabeçalho para download
                   header('Content-type: application/'.trim($result[0]->formato_arquivo));                   
                   header('Content-Disposition: attachment; filename="'.trim($result[0]->nome_arquivo_original.'"'));
                   header("Content-Transfer-Encoding: binary");
                   header('Expires: 0');
                   header('Pragma: no-cache');
                   readfile('assets/uploads/armazenamento_nuvem/'.trim($result[0]->nome_arquivo_servidor));
                    
                   

                }else{
                   return false;
                }

        }

        public function index($TipoAcesso=false,$id_pasta=false){

        	//Título
        	$data['title'] = 'Armazenamento nas Nuvens';
        	$data['url_pagina'] = 'armazenamento_nuvens';

        	// aqui verifica aonde fica o gerenciamento de permissoes da area ele pe
        	if ($TipoAcesso=='J'){
        		check_login_empresa();
        		$usuario_id= $this->session->userdata('SessionIdEmpresa'); //Id do usu�rio logado e selecionado
        	}elseif ($TipoAcesso=='F'){
        		check_login_aluno();
        		$usuario_id=$this->session->userdata('SessionIdAluno'); //Id do usu�rio logado e selecionado

        	}elseif ($TipoAcesso =='FJ'){
        		check_login_empresa(5);
        		$usuario_id= $this->session->userdata('SessionEmpresaPermissoes'); //Id do usu�rio logado e selecionado

        	}
        	else{

        		redirect(site_url());// redireciona para a home caso nenhuma opção seja selecionada
        	}
        	$data['TipoAcesso']=$TipoAcesso;
                        // este helper controla quem esta logado para exibir o menu da area restrita
                        seleciona_menu_area_restrita($TipoAcesso);
           if($TipoAcesso=='F'){
              
               $this->db->select('armazenamento_permissoes.id_pasta,armazenamento_pasta.nome,armazenamento_pasta.ativo');
               $this->db->from('armazenamento_permissoes');
               $this->db->join('armazenamento_pasta','armazenamento_pasta.id_pasta=armazenamento_permissoes.id_pasta','inner');
               $this->db->where(array('armazenamento_permissoes.id_inscritos'=>$usuario_id,'armazenamento_pasta.ativo'=>'S'));
               
           }else{          
                $this->db->select('id_pasta,nome,ativo');
                $this->db->from('armazenamento_pasta');
                $this->db->where(array('inscritos_id'=>$usuario_id,'ativo'=>'S'));
           }
            $query=$this->db->get();
            if($query->num_rows>0){
                foreach ($query->result() as $itens) {
                    if(!$this->session->userdata('Session_pasta_selecionada')){
                       $id_pasta_selecionada=$itens->id_pasta;
                       $dados = array('Session_pasta_selecionada' => $itens->id_pasta);
                        $this->session->set_userdata($dados);
                    }else{
                        if($id_pasta==$itens->id_pasta){
                            $id_pasta_selecionada=$itens->id_pasta;
                            $dados = array('Session_pasta_selecionada' =>$id_pasta,
                             );
                             $this->session->set_userdata($dados);
                        }
                    }

                     $data['pastas'][]=array('id_pasta'=>$itens->id_pasta,'nome_pasta'=>$itens->nome);
                }
            }

            if($this->session->userdata('Session_pasta_selecionada')){

                $this->db->select('armazenamento_na_nuvem.*, armazenamento_pasta.nome');
                $this->db->from('armazenamento_na_nuvem');
                $this->db->join('armazenamento_pasta','armazenamento_pasta.id_pasta = armazenamento_pasta_id_pasta','inner');
				$this->db->where(array('armazenamento_pasta_id_pasta'=>$this->session->userdata('Session_pasta_selecionada'),'armazenamento_na_nuvem.ativo'=>'S'));

            	//Verifica se existe busca
            	$busca = $this->input->get('busca');
				if($busca)
                	$this->db->like('titulo', $busca);

				$this->db->order_by('data_atualizacao', 'DESC');
                $query=$this->db->get();
                if($query->num_rows>0){
                	$data['arquivos'] = $query->result();

                }else{

                    $data['arquivos'] = false;
                }

            }

        	$this->db->select('armazenamento_na_nuvem.*');
        	$this->db->from('armazenamento_na_nuvem');
        	$this->db->join('armazenamento_pasta','armazenamento_pasta.id_pasta = armazenamento_pasta_id_pasta','inner');
        	$this->db->join('inscritos','inscritos.id = armazenamento_pasta.inscritos_id','inner');
        	$this->db->where(array('armazenamento_na_nuvem.ativo'=>'S', 'armazenamento_pasta.inscritos_id' => $usuario_id));
        	$this->db->order_by('data_atualizacao', 'DESC');
        	$this->db->limit(3);
        	$query=$this->db->get();
        	if($query->num_rows>0)
        		$data['ultimos_arquivos'] = $query->result();

			$this->loadView('armazenamento_nas_nuvens/armazenamento_nas_nuvens',$data);
        }
}