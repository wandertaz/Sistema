<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class bancodetalentos extends MY_Controller {

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

	public function meucurriculo($msg=false){


           check_login_aluno();
            $id= $this->session->userdata('SessionIdAluno');
            // este helper controla quem esta logado para exibir o menu da area restrita
            seleciona_menu_area_restrita('F');

            //verifica qual e o curriculos.id_curriculo
            $this->db->select('curriculos.id_curriculo,curriculos.objetivosprofissionais');
            $this->db->from('curriculos');
            $this->db->where(array('curriculos.inscritos_id'=>$id));
            $query_curriculo = $this->db->get();
            $resultado=$query_curriculo->result();

            if ($query_curriculo->num_rows>0){
                $curriculo_id=$resultado[0]->id_curriculo;
                $Obs_objetivosprofissionais=$resultado[0]->objetivosprofissionais;
                $data['objetivosprofissionais_obs']=array('objetivosprofissionais'=>$Obs_objetivosprofissionais);
            }else{


                /*$data=array(
                    'inscritos_id'=> $id,
                    'niveis_de_atuacao_id_nivel'=>null ,
                    'objetivosprofissionais'=>null,
                 );*/

                //$curriculo_id= $this->db->insert('curriculos',$data);
                 $curriculo_id= -1;

                 $Obs_objetivosprofissionais='';
            }


            //verifica os dados pessoais do aluno
            $this->db->select('*');
            $this->db->from('inscritos');
            $this->db->where(array('inscritos.id'=>$id));
            $query = $this->db->get();
            $data['dadosaluno']=$query->result();

            //verifica qual e a formacao academica
            $this->db->select('curriculos.id_curriculo,formacao_academica.*');
            $this->db->from('curriculos');
            $this->db->join('formacao_academica','curriculos.id_curriculo=formacao_academica.curriculos_id_curriculo');
            $this->db->where(array('curriculos.inscritos_id'=>$id));
            $query = $this->db->get();
            $resultado=$query->result();

            // se existe registro ele envia se não ele envia array vazio(formação academica)
            if ($query->num_rows==0){

               $data['formacaoacademica']=array('vazio'=>1);

            }else{
                foreach ($resultado as $itens){

                    $data['formacaoacademica'][]=array('id_curriculo' =>$itens->id_curriculo, 'id_formacao' =>$itens->id_formacao,'grau_formacao' => $itens->grau_formacao,'status' => $itens->status,'nome_curso' => $itens->nome_curso,'instituicao' => $itens->instituicao ,'data_inicio' => $itens->data_inicio, 'data_conclusao' => $itens->data_conclusao ,'curriculos_id_curriculo' => $itens->curriculos_id_curriculo,'vazio'=>0 );

                }

            }




             //verifica quais são os idiomas


            $this->db->select('id_idioma,nome_idioma');
            $this->db->from('idiomas_selecao');
            $this->db->where(array('ativo'=>'S'));
            $this->db->order_by('ordem');
            $query1 = $this->db->get();
            $data['idiomas_lista']=$query1->result();



            $this->db->select('id_idioma,nome_idioma,nivel_leitura,nivel_escrita,nivel_conversacao,idioma_cadastro_id');
            $this->db->from('idiomas_selecao');
            $this->db->join('idiomas_cadastro','id_idioma=idiomas_id_idioma and curriculos_id_curriculo='.$curriculo_id);
            $query = $this->db->get();
            $resultado=$query->result();


            // se existe registro ele envia se não ele envia array vazio(idioma)
            if ($query->num_rows==0){

               $data['idiomas']=array( 'vazio'=>1);

            }else{
                foreach ($resultado as $itens){
               // print_r($itens);
                //exit();
                    $data['idiomas'][]=array( 'id_idioma' =>$itens->id_idioma, 'nome_idioma' =>$itens->nome_idioma,'nivel_leitura' => $itens->nivel_leitura,'nivel_escrita' => $itens->nivel_escrita,'nivel_conversacao' => $itens->nivel_conversacao,'idioma_cadastro_id' => $itens->idioma_cadastro_id,'vazio'=>0 );

                }

            }








            //verifica qual e o Cursos Complementares
            $this->db->select('curriculos.id_curriculo,cursos_complementares.*');
            $this->db->from('curriculos');
            $this->db->join('cursos_complementares','curriculos.id_curriculo=cursos_complementares.curriculos_id_curriculo');
            $this->db->where(array('curriculos.inscritos_id'=>$id));
            $query = $this->db->get();
            $resultado=$query->result();

            // se existe registro ele envia se não ele envia array vazio(formação academica)
            if ($query->num_rows==0){

               $data['cursoscomplementares']=array( 'vazio'=>1);

            }else{
                foreach ($resultado as $itens){

                    $data['cursoscomplementares'][]=array( 'id_curriculo' =>$itens->id_curriculo, 'id_curso_complementar' =>$itens->id_curso_complementar,'nome_curso' => $itens->nome_curso,'carga_horaria' => $itens->carga_horaria,'cidade_pais' => $itens->cidade_pais,'instituicao' => $itens->instituicao ,'data_inicio' => $itens->data_inicio, 'data_conclusao' => $itens->data_fim ,'curriculos_id_curriculo' => $itens->curriculos_id_curriculo,'vazio'=>0 );

                }

            }


             //verifica qual e o historico professional
            $this->db->select('curriculos.id_curriculo,historico_experiencia.*');
            $this->db->from('curriculos');
            $this->db->join('historico_experiencia','curriculos.id_curriculo = historico_experiencia.curriculos_id_curriculo');
            $this->db->where(array('curriculos.inscritos_id'=>$id));
            $query = $this->db->get();
            $resultado1=$query->result();



            // se existe registro ele envia se não ele envia array vazio(historico professional)
            if ($query->num_rows==0){
               $data['cargos']=array ('vazio'=>1);
               $data['historicoprofessional']=array ('vazio'=>1);

            }else{
                $x=0;
                foreach ($resultado1 as $itens){

                    //verifica quais são os cargos que o funcionario já trabalho na empresa
                    $this->db->select('historico_cargo.*');
                    $this->db->from('historico_experiencia');
                    $this->db->join('historico_cargo','historico_experiencia.id_historico = historico_cargo.historico_experiencia_id_historico');
                    $this->db->where(array('historico_experiencia.curriculos_id_curriculo'=>$itens->id_curriculo,'historico_cargo.historico_experiencia_id_historico'=>$itens->id_historico));
                    $query = $this->db->get();
                    $resultado2=$query->result();
                    if ($query->num_rows==0){
                            $data['cargos']=array ('vazio'=>1);
                         } else{
                        foreach ($resultado2 as $itens2){

                            $data['cargos'][$x][]=array ( 'id_cargo' => $itens2->id_cargo,'cargo' => $itens2->cargo ,'historico_experiencia_id_historico' => $itens2->historico_experiencia_id_historico,'vazio'=>0 );
                         }
                     $x=$x+1;
                     }

                    $data['historicoprofessional'][]=array ('vazio'=>0,'id_curriculo' =>$itens->id_curriculo,'empresa' =>$itens->empresa,'id_historico' => $itens->id_historico, 'data_inicial' => $itens->data_inicial, 'data_saida' => $itens->data_saida, 'motivo_desligamento' => $itens->motivo_desligamento, 'salario' => $itens->salario, 'beneficios' => $itens->beneficios, 'superior_imediato' => $itens->superior_imediato ,'cargo_superior_imediato' => $itens->cargo_superior_imediato ,'principais_atribuicoes' => $itens->principais_atribuicoes, 'curriculos_id_curriculo' => $itens->curriculos_id_curriculo,'cargos'=>$data['cargos']);



                }

            }



            //verifica quais são as Referencias Profissionais
            $this->db->select('referencias_profissionais.*');
            $this->db->from('curriculos');
            $this->db->join('referencias_profissionais','curriculos.id_curriculo=referencias_profissionais.curriculos_id_curriculo');
            $this->db->where(array('curriculos.inscritos_id'=>$id));
            $query3 = $this->db->get();
            $resultado3=$query3->result();

            //print_r($query3->num_rows);
            //exit();
            // se existe registro ele envia se não ele envia array vazio(formação academica)
            if ($query3->num_rows==0){

               $data['referenciasprofissionais'][]=array('vazio'=>1);

            }else{
                foreach ($resultado3 as $itens){

                    $data['referenciasprofissionais'][]=array('vazio'=>0,'id_referencia' =>$itens->id_referencia, 'empresa' =>$itens->empresa,'nome_superior_imediato' => $itens->nome_superior_imediato,'cargo' => $itens->cargo,'telefone_comercial' => $itens->telefone_comercial,'email' => $itens->email);

                }
            }


            //verifica quais são as Objetivos Profissionais - nivel atuacao
            $this->db->select('niveis_de_atuacao.id_nivel,niveis_de_atuacao.nome_nivel,curriculos.id_curriculo');
            $this->db->from('niveis_de_atuacao');
            $this->db->join('curriculos','curriculos.niveis_de_atuacao_id_nivel=niveis_de_atuacao.id_nivel and curriculos.inscritos_id='.$id,'left');
            //$this->db->where(array('curriculos.inscritos_id'=>$id));
            $query4 = $this->db->get();
            $resultado4=$query4->result();

           /*print_r($resultado4);
            exit();*/


            // se existe registro ele envia se não ele envia array vazio(formação academica)
            if ($query4->num_rows>0){
              $qtd_media=round($query4->num_rows);
                foreach ($resultado4 as $itens){
                      $data['objetivosprofissionais_atuacao'][]=array('id_nivel' =>$itens->id_nivel, 'nome_nivel' =>$itens->nome_nivel,'id_curriculo' => $itens->id_curriculo,'qtd_media'=>$qtd_media);

                }
            }





            //verifica quais são as Objetivos Profissionais - Área de Atuação
            $this->db->select('area_de_atuacao.id_area, area_de_atuacao.nome_area,area_atuacao_cadastro.area_atuacao_cadastro_id');
            $this->db->from('area_de_atuacao');
            $this->db->join('area_atuacao_cadastro','area_atuacao_cadastro.area_de_atuacao_id_area=area_de_atuacao.id_area and area_atuacao_cadastro.curriculos_id_curriculo='.$curriculo_id,'left');
            //$this->db->where(array('curriculos.inscritos_id'=>$id));
            $query = $this->db->get();
            $resultado=$query->result();



            // se existe registro ele envia se não ele envia array vazio(Objetivos Profissionais)
            if ($query->num_rows>0){
              $qtd_media=round($query->num_rows);
                foreach ($resultado as $itens){
                      $data['objetivosprofissionais_area_atuacao'][]=array('id_area' =>$itens->id_area, 'nome_area' =>$itens->nome_area,'area_atuacao_cadastro_id' => $itens->area_atuacao_cadastro_id,'qtd_media'=>$qtd_media);

                }
            }



             //verifica quais são as Objetivos Profissionais - Segmento de Atuação
            $this->db->select('segmentodeatuacao.segmentodeatuacao_id, segmentodeatuacao.segmentodeatuacao_nome,segmentodeatuacao_cadastro.segmentodeatuacao_cadastro_id');
            $this->db->from('segmentodeatuacao');
            $this->db->join('segmentodeatuacao_cadastro','segmentodeatuacao.segmentodeatuacao_id=segmentodeatuacao_cadastro.segmentodeatuacao_segmentodeatuacao_id and segmentodeatuacao_cadastro.curriculos_id_curriculo='.$curriculo_id,'left');
            //$this->db->where(array('curriculos.inscritos_id'=>$id));
            $query = $this->db->get();
            $resultado=$query->result();


            // se existe registro ele envia se não ele envia array vazio(Objetivos Profissionais)
            if ($query->num_rows>0){
              $qtd_media=round($query->num_rows);
                foreach ($resultado as $itens){
                      $data['objetivosprofissionais_segmento_atuacao'][]=array('segmentodeatuacao_id' =>$itens->segmentodeatuacao_id, 'segmentodeatuacao_nome' =>$itens->segmentodeatuacao_nome,'segmentodeatuacao_cadastro_id' => $itens->segmentodeatuacao_cadastro_id,'qtd_media'=>$qtd_media);

                }
            }


           //verifica quais são as Objetivos Profissionais - disponibilidade de horario
            $this->db->select('disponibilidadehorario.disponibilidadehorario_id, disponibilidadehorario.disponibilidadehorario_nome,disponibilidadedehorario_cadastro.disponibilidadehorario_cadastro_id');
            $this->db->from('disponibilidadehorario');
            $this->db->join('disponibilidadedehorario_cadastro','disponibilidadehorario.disponibilidadehorario_id=disponibilidadedehorario_cadastro.disponibilidadehorario_pretencaosalarial_id and disponibilidadedehorario_cadastro.curriculos_id_curriculo='.$curriculo_id,'left');
            //$this->db->where(array('curriculos.inscritos_id'=>$id));
            $query = $this->db->get();
            $resultado=$query->result();
           // print_r($resultado);
            //exit;

            // se existe registro ele envia se não ele envia array vazio(Objetivos Profissionais)
            if ($query->num_rows>0){
              $qtd_media=round($query->num_rows);
                foreach ($resultado as $itens){
                      $data['objetivosprofissionais_disponibilidade_horario'][]=array('disponibilidadehorario_id' =>$itens->disponibilidadehorario_id, 'disponibilidadehorario_nome' =>$itens->disponibilidadehorario_nome,'disponibilidadehorario_cadastro_id' => $itens->disponibilidadehorario_cadastro_id,'qtd_media'=>$qtd_media);

                }
            }



             //verifica quais são as Objetivos Profissionais - pretenção salarial
            $this->db->select('pretencaosalarial.pretencaosalarial_id, pretencaosalarial.pretencaosalarial_nome,pretencaosalarial_cadastro.pretencaosalarial_cadastro_id');
            $this->db->from('pretencaosalarial');
            $this->db->join('pretencaosalarial_cadastro','pretencaosalarial.pretencaosalarial_id=pretencaosalarial_cadastro.pretencaosalarial_pretencaosalarial_id and pretencaosalarial_cadastro.curriculos_id_curriculo='.$curriculo_id,'left');
            //$this->db->where(array('curriculos.inscritos_id'=>$id));
            $query = $this->db->get();
            $resultado=$query->result();
            //print_r($resultado);
            //exit;

            // se existe registro ele envia se não ele envia array vazio(Objetivos Profissionais)
            if ($query->num_rows>0){
              $qtd_media=round($query->num_rows);
                foreach ($resultado as $itens){
                      $data['objetivosprofissionais_pretencaosalarial'][]=array('pretencaosalarial_id' =>$itens->pretencaosalarial_id, 'pretencaosalarial_nome' =>$itens->pretencaosalarial_nome,'pretencaosalarial_cadastro_id' => $itens->pretencaosalarial_cadastro_id,'qtd_media'=>$qtd_media);

                }
            }


            $dados= array_merge($data);
			$dados['msg'] = $msg;
            $this->loadView('banco_de_talentos/bancodetalentos-cadastro-curriculo',$dados);

        }


        public function salvarcurriculo($msg = false) {


            check_login_aluno();
            $id= $this->session->userdata('SessionIdAluno');

            //aqui valida se ele aceitou os termos de uso do curriculo
            $termos_de_uso=$_POST['accept_termos_de_uso'];
            if(!isset($termos_de_uso)){
                return $this->meucurriculo($msg);
            }

            //verifica qual e o curriculos.id_curriculo e o campo curriculos.objetivosprofissionais
            // se não existir ele cria o registro e seta o id para a variavel
            $this->db->select('curriculos.id_curriculo,curriculos.objetivosprofissionais');
            $this->db->from('curriculos');
            $this->db->where(array('curriculos.inscritos_id'=>$id));
            $query_curriculo = $this->db->get();
            $resultado=$query_curriculo->result();

            if ($query_curriculo->num_rows>0){
                $curriculo_id=$resultado[0]->id_curriculo;
                $Obs_objetivosprofissionais=$resultado[0]->objetivosprofissionais;
                $data['objetivosprofissionais_obs']=array('objetivosprofissionais'=>$Obs_objetivosprofissionais);
            }else{
                $data=array(
                    'inscritos_id'=> $id,
                    'niveis_de_atuacao_id_nivel'=>null ,
                    'objetivosprofissionais'=>null,
                 );
                $curriculo_id= $this->db->insert('curriculos',$data);
                 $Obs_objetivosprofissionais='';
            }


            $dt_form = str_replace('/','-',$_POST['nascimento_dados_pessoais']);
            $dt_form= date('Y-m-d', strtotime($dt_form));


           // print_r($_POST);
            //exit;



            // dados pessoais inicio

            $nome=$_POST['nome_dados_pessoais'];
            $dt_nasc= strlen($dt_form)==10?$dt_form:null;
            $sexo=$_POST['sexo_dados_pessoais'];
            $telefone=$_POST['tel_dados_pessoais'];
            $celular=$_POST['cel_dados_pessoais'];
            $estadocivil=$_POST['estado_civil_dados_pessoais'];
            $religiao=$_POST['religiao_dados_pessoais'];
            $cep=$_POST['cep_dados_pessoais'];
            $endereco=$_POST['endereco_dados_pessoais'];
            $numero=$_POST['numero_dados_pessoais'];
            $estado=$_POST['estado_dados_pessoais'];
            $cidade=$_POST['cidade_dados_pessoais'];
            $bairro=$_POST['bairro_dados_pessoais'];
            $filhos=trim($_POST['filhos_dados_pessoais']);
            $qtd_filhos=trim($_POST['quantos_filhos_dados_pessoais']);
            $cnh=$_POST['cnh_dados_pessoais'];
            $veiculo=$_POST['veiculo_dados_pessoais'];
            $deciciencia=$_POST['deficiente_dados_pessoais'];
            $qual_deciciencia=$_POST['qual_deficiencia_filhos_dados_pessoais'];
            $facebook=$_POST['facebook_dados_pessoais'];
            $twitter=$_POST['twitter_dados_pessoais'];
            $linkedin=$_POST['linkedin_dados_pessoais'];
            $trabalhar_outra_cidade=isset($_POST['trabalhar_outra_cidade'])?$_POST['trabalhar_outra_cidade']:'N';

            $datapessoal= array(

                    'nome'=>$nome,
                    'data_nascimento'=>  $dt_nasc,
                    'sexo'=>$sexo ,
                    'telefone'=>$telefone ,
                    'celular'=> $celular,
                    'endereco' =>$endereco,
                    'numero' =>$numero,
                    'bairro'=>$bairro ,
                    'cidade'=> $cidade,
                    'estado'=> $estado,
                    'cep' =>$cep,
                    'religiao'=>$religiao ,
                    'estadocivil'=>$estadocivil ,
                    'filhos'=> $filhos!=''?$filhos:null ,
                    'qtd_filhos'=> $filhos=='S'?$qtd_filhos:null ,
                    'cnh' => $cnh!=''?$cnh:null ,
                    'veiculo'=> $veiculo!=''?$veiculo:null ,
                    'deficiencia'=>$deciciencia!=''?$deciciencia:null ,
                    'qual_deficiencia'=>$deciciencia=='S'?$qual_deciciencia:null ,
                    'link_facebook'=> $facebook!=''?$facebook:null ,
                    'link_twitter' => $twitter!=''?$twitter:null,
                    'link_linkedin'=> $linkedin!=''?$linkedin:null,
                    'trabalhar_outra_cidade'=>$trabalhar_outra_cidade!=''?$trabalhar_outra_cidade:null,
                    'termos_curriculo' =>'S',
                 );

            $this->db->where(array('id'=>$id));
            $this->db->update('inscritos', $datapessoal);

            // dados pessoais fim


            // formação academica inicio

            // deleta os antigos e insere tudo denovo
            $this->db->where(array('formacao_academica.curriculos_id_curriculo'=>$curriculo_id));
            $this->db->delete('formacao_academica');

            $cont=$_POST['controleformacaoacademica'];
            for ($x=1;$x<=$cont;$x++){
               $grau_formacao=$_POST['grau_formacao_'.$x];
               $status_formacao=$_POST['status_curso_'.$x];
               $nomedocurso_form_academica=$_POST['nomedocurso_form_academica_'.$x];
               $instituicao_form_academica=$_POST['instituicao_form_academica_'.$x];


               $inicio_form_academica=$_POST['inicio_form_academica_'.$x];
               $conclusao_form_academica=$_POST['conclusao_form_academica_'.$x];

               $data = array(
                    'grau_formacao'=>$grau_formacao ,
                    'status'=>$status_formacao,
                    'nome_curso'=> $nomedocurso_form_academica,
                    'instituicao'=>$instituicao_form_academica ,
                    'data_inicio'=>$inicio_form_academica ,
                    'data_conclusao'=>$conclusao_form_academica ,
                    'curriculos_id_curriculo'=>$curriculo_id,
               );
              $this->db->insert('formacao_academica',$data);
            }

            // formação academica fim



            // Idiomas inicio
            // deleta os antigos e insere tudo denovo
            $this->db->where(array('idiomas_cadastro.curriculos_id_curriculo'=>$curriculo_id));
            $this->db->delete('idiomas_cadastro');

            $cont=count($_POST['idioma']);

            for ($x=0;$x<$cont;$x++){

               $idioma=$_POST['idioma'][$x];
               $idioma_leitura=$_POST['idioma_leitura'][$x];
               $idioma_escrita=$_POST['idioma_escrita'][$x];
               $idioma_conversacao=$_POST['idioma_conversacao'][$x];

               $data = array(
                    'idiomas_id_idioma'=>$idioma ,
                    'nivel_leitura'=>$idioma_leitura,
                    'nivel_escrita'=> $idioma_escrita,
                    'nivel_conversacao'=>$idioma_conversacao ,
                    'curriculos_id_curriculo'=>$curriculo_id,
               );
            /*   print_r($data);
               exit();*/


              $this->db->insert('idiomas_cadastro',$data);
            }
           //Idiomas fim


            // cursos complementares inicio
            // deleta os antigos e insere tudo denovo
            $this->db->where(array('cursos_complementares.curriculos_id_curriculo'=>$curriculo_id));
            $this->db->delete('cursos_complementares');


            $cont=count($_POST['nomedocurso_complementar_form_academica']);

            for ($x=0;$x<$cont;$x++){

               $nomedocurso_complementar_form_academica=$_POST['nomedocurso_complementar_form_academica'][$x];
               $carga_horaria_complementar_form_academica=$_POST['carga_horaria_complementar_form_academica'][$x];
               $cidade_pais_complementar_form_academica=$_POST['cidade_pais_complementar_form_academica'][$x];
               $instituicao_complementar_form_academica=$_POST['instituicao_complementar_form_academica'][$x];


               $inicio_form_academica=$_POST['inicio_complementar_form_academica'][$x];
               if (trim($inicio_form_academica)==''){
                   $inicio_form_academica=null;
               }else{

                  $inicio_form_academica = $inicio_form_academica;
               }

               $conclusao_form_academica=$_POST['conclusao_complementar_form_academica'][$x];
               if (trim($conclusao_form_academica)==''){
                   $conclusao_form_academica=null;
               }else{
                    $conclusao_form_academica = $conclusao_form_academica;
               }

               $data = array(
                    'nome_curso'=>$nomedocurso_complementar_form_academica ,
                    'carga_horaria'=>$carga_horaria_complementar_form_academica,
                    'cidade_pais'=> $cidade_pais_complementar_form_academica,
                    'instituicao'=>$instituicao_complementar_form_academica ,
                    'data_inicio'=>$inicio_form_academica ,
                    'data_fim'=>$conclusao_form_academica ,
                    'curriculos_id_curriculo'=>$curriculo_id,
               );
              $this->db->insert('cursos_complementares',$data);
            }
           // cursos complementares fim





             // historico professional inicio

            // deleta os antigos e insere tudo denovo

           $this->db->select('id_historico');
            $this->db->from('historico_experiencia');
            $this->db->where(array('historico_experiencia.curriculos_id_curriculo'=>$curriculo_id));
            $query = $this->db->get();

            foreach ($query->result() as $itens) {
                $this->db->where(array('historico_cargo.historico_experiencia_id_historico'=>$itens->id_historico));
                $this->db->delete('historico_cargo');
            }
            $this->db->where(array('historico_experiencia.curriculos_id_curriculo'=>$curriculo_id));
            $this->db->delete('historico_experiencia');
             // deleta os antigos e insere tudo denovo


            $cont=count($_POST['empresa_his_prof']);
            $z=0;
            for ($x=0;$x<$cont;$x++){

               $empresa_his_prof=$_POST['empresa_his_prof'][$x];

               //data
               $entrada_his_prof=$_POST['entrada_his_prof'][$x];
               if (trim($entrada_his_prof)==''){
                   $entrada_his_prof=null;
               }else{

                  $entrada_his_prof = str_replace('/','-',$entrada_his_prof);
                  $entrada_his_prof= date('Y-m-d', strtotime($entrada_his_prof));
               }
               //data
               $saida_his_prof=$_POST['saida_his_prof'][$x];
               if (trim($saida_his_prof)==''){
                   $saida_his_prof=null;
               }else{
                    $saida_his_prof = str_replace('/','-',$saida_his_prof);
                    $saida_his_prof= date('Y-m-d', strtotime($saida_his_prof));
               }

               $motivo_his_prof=$_POST['motivo_his_prof'][$x];
               $salario_his_prof=$_POST['salario_his_prof'][$x];
               $beneficios_his_prof=$_POST['beneficios_his_prof'][$x];
               $sup_imediato_his_prof=$_POST['sup_imediato_his_prof'][$x];
               $cargo_sup_imediato_his_prof=$_POST['cargo_sup_imediato_his_prof'][$x];
               $principais_atribuicoes=$_POST['principais_atribuicoes'][$x];




               $data = array(
                    'empresa'=>$empresa_his_prof ,
                    'data_inicial'=>$entrada_his_prof,
                    'data_saida'=> $saida_his_prof,
                    'motivo_desligamento'=>$motivo_his_prof ,
                    'salario'=>$salario_his_prof ,
                    'beneficios'=>$beneficios_his_prof ,
                   'superior_imediato'=>$sup_imediato_his_prof ,
                   'cargo_superior_imediato'=>$cargo_sup_imediato_his_prof ,
                   'principais_atribuicoes'=>$principais_atribuicoes ,
                   'curriculos_id_curriculo'=>$curriculo_id,
               );
             $this->db->insert('historico_experiencia',$data);
             $id_experiencia = $this->db->insert_id();

              $cont1=count($_POST['empresa_cargo_prof']);

               for ($y=0;$y<$cont1;$y++){
                    $cargo=$_POST['empresa_cargo_prof'][$z][$y];
                    if(trim($cargo)!=''){
                         $data1 = array(
                             'cargo'=>$cargo ,
                             'historico_experiencia_id_historico'=>$id_experiencia,
                         );
                           $this->db->insert('historico_cargo',$data1);
                     }
               }

               $z=$z+1;
            }
           //historico professional fim






           // referências professionais inicio
            // deleta os antigos e insere tudo denovo
            $this->db->where(array('referencias_profissionais.curriculos_id_curriculo'=>$curriculo_id));
            $this->db->delete('referencias_profissionais');

            $cont=count($_POST['empresa_ref_prof']);

            for ($x=0;$x<$cont;$x++){

               $empresa_ref_prof=$_POST['empresa_ref_prof'][$x];
               $nome_sup_imediato_ref_prof=$_POST['nome_sup_imediato_ref_prof'][$x];
               $cargo_ref_prof=$_POST['cargo_ref_prof'][$x];
               $tel_ref_prof=$_POST['tel_ref_prof'][$x];
               $email_ref_prof=$_POST['email_ref_prof'][$x];

               $data = array(
                    'empresa'=>$empresa_ref_prof ,
                    'nome_superior_imediato'=>$nome_sup_imediato_ref_prof,
                    'cargo'=> $cargo_ref_prof,
                    'telefone_comercial'=>$tel_ref_prof ,
                    'email'=>$email_ref_prof ,
                    'curriculos_id_curriculo'=>$curriculo_id,
               );

              $this->db->insert('referencias_profissionais',$data);
            }
           //referências professionais fim



            //objetivos professionais inicio
            //Observação & Nível de Atuação início
            $obsercacao=$_POST['objetivo_text_objetivos_profissionais'];
            $nivelatuacao=$_POST['nivelatuacao'];
             $data = array(
                    'objetivosprofissionais'=>trim($obsercacao)==''?null:$obsercacao ,
                   'niveis_de_atuacao_id_nivel'=>$nivelatuacao>0?$nivelatuacao:null,
               );
              $this->db->where(array('curriculos.id_curriculo'=>$curriculo_id));
              $this->db->update('curriculos',$data);
             ////Observação & Nível de Atuação fim




            //Área de Atuação início

           //deleta e depois inseri os registros
           $this->db->where(array('area_atuacao_cadastro.curriculos_id_curriculo'=>$curriculo_id));
           $this->db->delete('area_atuacao_cadastro');

           if (isset($_POST['area_atuacao'])){
               foreach ($_POST['area_atuacao'] as $item) {
                   $data = array(
                         'area_de_atuacao_id_area'=>$item,
                         'curriculos_id_curriculo'=>$curriculo_id,

                    );
                    $this->db->insert('area_atuacao_cadastro',$data);
               }

           }
             //Área de Atuação fim




          //segmento de Atuação início
           //deleta e depois inseri os registros
           $this->db->where(array('segmentodeatuacao_cadastro.curriculos_id_curriculo'=>$curriculo_id));
           $this->db->delete('segmentodeatuacao_cadastro');

           if (isset($_POST['segmentodeatuacao'])){

                   $data = array(
                         'segmentodeatuacao_segmentodeatuacao_id'=>$_POST['segmentodeatuacao'],
                         'curriculos_id_curriculo'=>$curriculo_id,

                  );
                    $this->db->insert('segmentodeatuacao_cadastro',$data);


           }
           //segmento de Atuação fim





          //disponibilidadedehorario início
           //deleta e depois inseri os registros
           $this->db->where(array('disponibilidadedehorario_cadastro.curriculos_id_curriculo'=>$curriculo_id));
           $this->db->delete('disponibilidadedehorario_cadastro');

           if (isset($_POST['disponibilidadedehorario'])){

                   $data = array(
                         'disponibilidadehorario_pretencaosalarial_id'=>$_POST['disponibilidadedehorario'],
                         'curriculos_id_curriculo'=>$curriculo_id,

                  );
                    $this->db->insert('disponibilidadedehorario_cadastro',$data);


           }
           //disponibilidadedehorario fim


            //pretenção salarial início
           //deleta e depois inseri os registros
           $this->db->where(array('pretencaosalarial_cadastro.curriculos_id_curriculo'=>$curriculo_id));
           $this->db->delete('pretencaosalarial_cadastro');

           if (isset($_POST['pretencaosalarial'])){

                   $data = array(
                         'pretencaosalarial_pretencaosalarial_id'=>$_POST['pretencaosalarial'],
                         'curriculos_id_curriculo'=>$curriculo_id,

                  );
                    $this->db->insert('pretencaosalarial_cadastro',$data);


           }
           //pretenção salarial fim

           //objetivos professionais fim

            redirect(site_url().'bancodetalentos/meucurriculo/sucesso');



        }


      /*  public function cadastrarvagas(){
            $dados=array();
            $this->loadView('banco_de_talentos/bancodetalentos-cadastro-de-vagas',$dados);
        }*/

        public function curriculos_enviados(){
            $dados=array();

            check_login_aluno();
            $id= $this->session->userdata('SessionIdAluno');

            $dados['curriculos'] = $this->default_model->get_all('curriculos', array('curriculos'.'.*'), 0, null, array('inscritos_id'=>$id), null, 'curriculos'.'.id_curriculo', 'DESC');
            foreach ($dados['curriculos'] as $curriculo) { $dados['curriculo'] = $curriculo->id_curriculo; }
            $dados['candidaturas_vagas'] = $this->default_model->get_all('candidaturas_vagas', array('candidaturas_vagas'.'.*'), 0, null, array('curriculos_id_curriculo'=>$dados['curriculo']), null, 'candidaturas_vagas'.'.id_candidatura', 'ASC');

          if(count($dados['candidaturas_vagas'])>0){

            foreach ($dados['candidaturas_vagas'] as $candidatura_vaga) { $vagas[] = $candidatura_vaga->vaga_id_vaga; $dados['candidaturas'][] = $candidatura_vaga->id_candidatura; }
            foreach ($vagas as $vaga_show) {
               $dados['pretencaosalarial_vagas'][] = $this->default_model->get_all('pretencaosalarial_vagas', array('pretencaosalarial_vagas'.'.*'), 0, null, array('vaga_id_vaga'=>$vaga_show), null, 'pretencaosalarial_vagas'.'.pretensaosalarial_vagas_id', 'DESC');
               $dados['vagas'][] = $this->default_model->get_all('vagas', array('vagas'.'.*'), 0, null, array('id_vaga'=>$vaga_show), null, 'vagas'.'.id_vaga', 'DESC');
            }
            $dados['pretencaosalarial'] = $this->default_model->get_all('pretencaosalarial', array('pretencaosalarial'.'.*'), 0, null, array(), null, 'pretencaosalarial'.'.pretencaosalarial_id', 'DESC');
            $dados['niveis_de_atuacao'] = $this->default_model->get_all('niveis_de_atuacao', array('niveis_de_atuacao'.'.*'), 0, null, array(), null, 'niveis_de_atuacao'.'.id_nivel', 'DESC');
          }
            $this->loadView('banco_de_talentos/bancodetalentos-curriculos-enviados',$dados);

        }

        public function remover_candidatura($id_vaga,$id_candidatura){

            $this->db->where(array('candidaturas_vagas.vaga_id_vaga'=>$id_vaga,'candidaturas_vagas.curriculos_id_curriculo'=>$id_candidatura));
            $this->db->delete('candidaturas_vagas');

            redirect(site_url('/bancodetalentos/curriculos_enviados'));

        }

    	public function detalhes_vaga($id){

    		//Define join
    		$join = array('inscritos' => array('where' => 'inscritos.id = inscritos_id AND inscritos.tipo_pessoa = "J"', 'type' => 'inner'),
    					  'niveis_de_atuacao' => array('where' => 'niveis_de_atuacao.id_nivel = niveis_de_atuacao_id_nivel', 'type' => 'inner')
    					);

    		//Vaga
    		$data['vaga'] = $this->default_model->get_by_id('vagas', $id, array('vagas.*, inscritos.nome as empresa, niveis_de_atuacao.nome_nivel'), array('vagas.ativo' => 'S'), $join, 'id_vaga');

    		//Dados estáticos
    		$data['graus_formacao'] = $this->graus_formacao;
    		$data['tipos_contrato'] = $this->tipos_contrato;
    		$data['niveis_idiomas'] = $this->niveis_idiomas;

    		if($data['vaga']){

	    		//Áreas de Atuação
	    		$join = array('area_de_atuacao' => array('where' => 'area_de_atuacao.id_area = area_de_atuacao_id_area', 'type' => 'inner'));
	    		$data['vaga']->areas_atuacao = $this->default_model->get_all('areas_atuacao_vagas', array('*'), 0, NULL, array('vaga_id_vaga' => $id), $join);

	    		//Faixa Salarial
	    		$join = array('pretencaosalarial' => array('where' => 'pretencaosalarial.pretencaosalarial_id = pretencaosalarial_pretencaosalarial_id', 'type' => 'inner'));
	    		$data['vaga']->faixa_salarial = $this->default_model->get_by_id('pretencaosalarial_vagas', $id, array('*'), NULL, $join, 'vaga_id_vaga');

	    		//Idiomas
	    		$join = array('idiomas_selecao' => array('where' => 'idiomas_selecao.id_idioma = idiomas_id_idioma', 'type' => 'inner'));
	    		$data['vaga']->idiomas = $this->default_model->get_all('idiomas_vagas', array('*'), 0, NULL, array('vaga_id_vaga' => $id), $join);
    		}

    		//Carrega view
    		$this->loadView('banco_de_talentos/bancodetalentos-vaga-detalhe', $data);
    	}


        public function listagem_de_vagas(){
            $dados=array();

            check_login_empresa();
            $id_user = $this->session->userdata('SessionIdEmpresa');

            $dados['vagas'] = $this->default_model->get_all('vagas', array('vagas' . '.*'), 0, 5, array('inscritos_id' => $id_user), null, 'vagas' . '.id_vaga', 'DESC');

            $this->loadView('banco_de_talentos/bancodetalentos-minhas-vagas-empresa',$dados);

        }

        public function listagem_de_curriculos($id){
            $dados=array();

            $this->loadView('banco_de_talentos/bancodetalentos-curriculos-recebidos-empresa',$dados);
        }


        public function teste_array(){
           $myArray  = array('nome1' => 'product1','nome2'=>'product2','nome3'=>'product3');
            $preparing = serialize($myArray); //converte a array em formato serialize (texto)

            print_r($preparing); //imprime na tela a array convertida em texto

            print_r('<br><br><br><br><br><br>');
            $converts = unserialize($preparing); //converte texto para array

           // print_r($converts['nome2']); //imprime na tela a array

          /*  $valor_o=date('YmdHis');
             print_r($valor_o);
             print_r('<br><br><br><br><br><br>');
            $valor=md5($valor_o);
            print_r('<br><br><br><br><br><br>');
            print_r($valor);
            print_r('<br><br><br><br><br><br>');*/
            print_r(md5('20130305110432'));
            exit();

        }





}
