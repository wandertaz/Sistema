<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Login
 *
 * @access	public
 * @param	string
 * @return	string
 */
//calcula a idade formado de data de entrada
if (!function_exists('calculaidade')) {

    function calculaidade($data) {

        //$idade=0;
        //Data atual
        $dia = date('d');
        $mes = date('m');
        $ano = date('Y');


        $vetordata = explode('/', $data);

        //Data do aniversário
        $dianasc = ($vetordata[0]);
        $mesnasc = ($vetordata[1]);
        $anonasc = ($vetordata[2]);

        //Calculando sua idade
        //$idade= 32;
        $idade = $ano - $anonasc;
        if ($mes < $mesnasc) {
            $idade = $idade - 1;
            return $idade;
        } elseif ($mes == $mesnasc and $dia <= $dianasc) {
            $idade = $idade - 1;
            return $idade;
        } else {
            return $idade;
        }
    }

}






if (!function_exists('retornacarrinho')) {

    function retornacarrinho($opcao) {
        $CI = & get_instance();
        $dados['carrinho'] = $CI->session->userdata('carrinho');
        $qtd = 0;
        $valor = 0;
        if ($CI->session->userdata('carrinho')) {
            foreach ($dados['carrinho'] as $itens) {
                $qtd+=1;
                $valor+=$itens['valor'];
            }
        }
        if ($opcao == 1) { //opcao 1 retorna a qtd de cursos no carrinho
            return $qtd;
        } elseif ($opcao == 2) {//opcao 2 retorna o valor total dos cursos no carrinho
            return $valor;
        }
    }

}


if (!function_exists('calcula_inscricoes_restantes')) {

    function calcula_inscricoes_restantes($inscricoes_id) {
        $CI = & get_instance();

        if ($CI->session->userdata('SessionIdEmpresa') > 0) {

            $id = $CI->session->userdata('SessionIdEmpresa');
        } elseif ($CI->session->userdata('SessionEmpresaPermissoes') > 0) {
            $id = $CI->session->userdata('SessionEmpresaPermissoes');
        }

        // verifica o total de vagas
        $CI->db->select('numero_iscritos total');
        $CI->db->from('inscricoes_empresas');
        $CI->db->where(array('id' => $id));
        $query = $CI->db->get();
        $data['qtd_inscricoes'] = $query->result();

        // verifica o total de vagas preenchidas
        $CI->db->select('count(*) inscritos');
        $CI->db->from('controle_inscritos_empresa');
        $CI->db->join('inscritos', 'controle_inscritos_empresa.inscrito_id=inscritos.id');
        $CI->db->where(array('inscricoes_empresa_id' => $id, 'inscricoes_id' => $inscricoes_id));
        $query1 = $CI->db->get();
        $data['qtd'] = $query1->result();

        return $data['qtd_inscricoes'][0]->total - $data['qtd'][0]->inscritos;
    }

}














if (!function_exists('check_exercicios')) {

    function check_exercicios() {
        $CI = & get_instance();

        $id = $CI->session->userdata('SessionIdAluno');
        $CI->db->select('count(*) afazer');
        $CI->db->from('inscricoes');
        $CI->db->join('notas', 'notas.curso_id=inscricoes.curso_id and notas.tipo_curso=inscricoes.tipo_curso', 'left');
        $CI->db->where(array('inscricoes.status' => 'AP', 'inscricoes.tipo_curso' => 'EL', 'inscricoes.inscrito_id' => $id, 'notas.id is null' => null));
        $query = $CI->db->get();
        $data['qtd'] = $query->result();

        return $data['qtd'][0]->afazer;
    }

}


if (!function_exists('check_mensagens')) {

    function check_mensagens() {
        $CI = & get_instance();

        $id = $CI->session->userdata('SessionIdAluno');

        $CI->db->select('count(*) as msgnaolida');
        $CI->db->from('mensagens');
        $CI->db->join('mensagens_destinatarios', 'mensagens.id=mensagens_destinatarios.mensagem_id');
        $CI->db->where(array('mensagens_destinatarios.destinatario_id' => $id, 'mensagens_destinatarios.data_desativacao is Null' => null, 'mensagens_destinatarios.tipo_destinatario' => 'A', 'mensagens_destinatarios.lido' => 'N'));
        $query2 = $CI->db->get();
        $data['qtd'] = $query2->result();

        return $data['qtd'][0]->msgnaolida;
    }

}



if (!function_exists('validarelerning')) {

    function validarelerning($id_inscricao) {
        $CI = & get_instance();
        $id = $CI->session->userdata('SessionIdAluno');
        $CI->db->select('count(*) verificacurso');
        $CI->db->from('inscricoes');
        $CI->db->join('elearning', 'inscricoes.curso_id=elearning.id');
        $CI->db->where(array('inscricoes.id' => $id_inscricao));
        $query = $CI->db->get();
        $data['qtd'] = $query->result();

        if ($data['qtd'][0]->verificacurso == 0) {

            return false;
        } else {

            return true;
        }
    }

}

if (!function_exists('verifica_instrutor_logado')) {

    function verifica_instrutor_logado($id_inscricao) {
        $CI = & get_instance();
        $id = $CI->session->userdata('SessionIdAluno');
        $CI->db->select('count(*) verificaintrutorlogado');
        $CI->db->from('inscricoes');
        $CI->db->join('elearning', 'inscricoes.curso_id=elearning.id');
        $CI->db->join('chat_elearning_login', 'chat_elearning_login.curso_id=elearning.id');
        $CI->db->where(array('inscricoes.id' => $id_inscricao));
        $query = $CI->db->get();
        $data['qtd'] = $query->result();

        if ($data['qtd'][0]->verificaintrutorlogado == 0) {

            return false;
        } else {

            return true;
        }
    }

}




if (!function_exists('mensagens_laterais')) {

    function mensagens_laterais() {
        $CI = & get_instance();
        $id = $CI->session->userdata('SessionIdAluno');

        //mensagens
        //mensagem_resposta
        //mensagens_destinatarios
        //area que baixa as mensagens
        $CI->db->select('mensagens.id,  mensagens.remetente_id,mensagens_destinatarios.lido,mensagens.assunto, mensagens.created,mensagens.texto ,usuario.nome usuario,inscritos.nome inscritos,mensagens.tipo_remetente');
        $CI->db->from('mensagens');
        $CI->db->join('mensagens_destinatarios', 'mensagens_destinatarios.mensagem_id = mensagens.id');
        $CI->db->join('inscritos', 'inscritos.id = mensagens.remetente_id', 'left');
        $CI->db->join('usuario', 'usuario.id = mensagens.remetente_id', 'left');
        $CI->db->where(array('mensagens_destinatarios.destinatario_id' => $id, 'mensagens_destinatarios.data_desativacao is Null' => null, 'mensagens_destinatarios.tipo_destinatario' => 'A'));
        $CI->db->limit(2);
        $CI->db->order_by('lido, created');
        $query = $CI->db->get();
        $data['mensagens_lateral'] = $query->result();
        return $data['mensagens_lateral'];
    }

}

if (!function_exists('destaques')) {

    function destaques() {
        $CI = & get_instance();

        $risos = "SELECT id, titulo, descricao, imagem, url, valor, 'AB' as table_name ";
        $risos = $risos . "FROM cursos_abertos ";
        $risos = $risos . "where ativo='S' ";
        $risos = $risos . "UNION ALL ";
        $risos = $risos . "SELECT id, titulo, descricao, imagem, url, valor, 'IN' as table_name ";
        $risos = $risos . "FROM cursos_incompany ";
        $risos = $risos . "where ativo='S' ";
        $risos = $risos . "UNION ALL ";
        $risos = $risos . "SELECT id, titulo, descricao, imagem, url, valor, 'EL' as table_name ";
        $risos = $risos . "FROM elearning ";
        $risos = $risos . "where ativo='S' ";
        $risos = $risos . "UNION ALL ";
        $risos = $risos . "SELECT id, titulo, descricao, imagem, url, valor, 'AL' as table_name ";
        $risos = $risos . "FROM programas_alta_performance ";
        $risos = $risos . "where ativo='S' ";
        $risos = $risos . "UNION ALL ";
        $risos = $risos . "SELECT id, titulo, descricao, imagem, url, valor, 'DE' as table_name ";
        $risos = $risos . "FROM programas_desenvolvimento ";
        $risos = $risos . "where ativo='S' ";
        $risos = $risos . "ORDER BY rand() ";
        $risos = $risos . "limit 2 ";

        $query = $CI->db->query($risos);

        return $query->result();
    }

}


if (!function_exists('calculo_conclusao_elearning')) {

    function calculo_conclusao_elearning($curso_id) {
        $CI = & get_instance();
        $id = $CI->session->userdata('SessionIdAluno');

        //pega todos os exercicios do usuario
        $CI->db->select('count(*) qtd');
        $CI->db->from('inscricoes');
        $CI->db->join('aulas', 'aulas.curso_id=inscricoes.curso_id and aulas.tipo_curso= inscricoes.tipo_curso');
        $CI->db->join('exercicios', 'exercicios.aula_id=aulas.id');
        $CI->db->where(array('inscricoes.curso_id' => $curso_id, 'inscricoes.status' => 'AP', 'inscricoes.tipo_curso' => 'EL', 'inscricoes.inscrito_id' => $id));
        $query = $CI->db->get();
        $total = $query->result();


        //pega todos os exercicios feitos do usuario
        $CI->db->select('count(*) qtd');
        $CI->db->from('inscricoes');
        $CI->db->join('aulas', 'aulas.curso_id=inscricoes.curso_id and aulas.tipo_curso= inscricoes.tipo_curso');
        $CI->db->join('exercicios', 'exercicios.aula_id=aulas.id');
        $CI->db->join('notas', 'notas.exercicio_id=exercicios.id and notas.tipo_curso= inscricoes.tipo_curso');
        $CI->db->where(array('inscricoes.curso_id' => $curso_id, 'inscricoes.status' => 'AP', 'inscricoes.tipo_curso' => 'EL', 'inscricoes.inscrito_id' => $id));
        $query = $CI->db->get();
        $feitos = $query->result();

        if ($total[0]->qtd == 0) {

            $valor = 0;
        } else {
            if ($feitos[0]->qtd == 0) {

                $valor = 0;
            } else {

                $valor = ((100 / $total[0]->qtd) * $feitos[0]->qtd);
                if ($valor <= 0) {
                    $valor = 0;
                }
            }
            return $valor;
        }
    }

}


if (!function_exists('check_permissao_cadastramento')) {// função booleana

    function check_permissao_cadastramento($curso_id, $tipo_curso, $turma_id = false) {
        $CI = & get_instance();

        $data['curso'] = array('AB' => 'cursos_abertos', 'IN' => 'cursos_incompany', 'AL' => 'programas_alta_performance', 'DE' => 'programas_desenvolvimento', 'EL' => 'elearning');

        $tabela = $data['curso'][$tipo_curso];

        //$id=$CI->session->userdata('SessionIdAluno');
        $CI->db->select('*');
        $CI->db->from($tabela);
        $CI->db->where(array('id' => $curso_id, 'data_inicio >=' => date('Y-m-d')));
        $query = $CI->db->get();
        // se não retorna e que o curso ja começou
        // o utimo dia de cadastro e o dia que o curso ira começar
        if ($query->num_rows == 0) {
            return false;
        }

        $CI->db->select('turmas.* ');
        $CI->db->from('turmas');
        $CI->db->where(array('turmas.curso_id' => $curso_id, 'tipo_curso' => $tipo_curso, 'data_inicial >=' => date('Y-m-d')));
        $query = $CI->db->get();
        if ($query->num_rows == 0) {
            return false;
        } else {
            foreach ($query->result() as $item) {
                $numero_vagas = $item->numero_vagas;
                $id_turma = $item->id;


                $CI->db->select('count(*) as vagas_preenchidas');
                $CI->db->from('inscricoes');
                $CI->db->where(array('inscricoes.turma_id' => $id_turma, 'status !=' => 'CA'));
                $query1 = $CI->db->get();
                $resultado = $query1->result();

                if ($resultado[0]->vagas_preenchidas < 0) {
                    //
                    if ($numero_vagas <= $resultado[0]->vagas_preenchidas && $turma_id == false) {
                        return true;
                    }
                }
            }
        }


        // se a turma existir ele faz a verificação se ele tem vaga e retorna true ou false
        if ($turma_id) {
            $CI->db->select('*');
            $CI->db->from('turmas');
            $CI->db->where(array('turmas.id' => $turma_id));
            $query = $CI->db->get();
            if ($query->num_rows == 0) {
                return false;
            } else {
                foreach ($query->result() as $item) {
                    $numero_vagas = $item->numero_vagas;
                    $id_turma = $item->id;

                    $CI->db->select('count(*) as vagas_preenchidas');
                    $CI->db->from('inscricoes');
                    $CI->db->where(array('inscricoes.turma_id' => $id_turma, 'status !=' => 'CA'));
                    $query = $CI->db->get();
                    $resultado1 = $query->result();
                    if ($numero_vagas <= $resultado1[0]->vagas_preenchidas) {
                        return false;
                    }
                }
            }
        }
        return true;
    }

}

if (!function_exists('buscar_vagas')) {

    function buscar_vagas($data) {


        $CI = & get_instance();
        $CI->db->select('inscritos.nome,vagas.*');
        $CI->db->from('vagas');
        $CI->db->join('inscritos', 'inscritos.id=vagas.inscritos_id');
        $CI->db->like(array('titulo_cargo' => $data['palavra_chave']));
        $CI->db->or_like(array('nome' => $data['palavra_chave']));
        $CI->db->where(array('vagas.ativo' => 'S', 'vagas.status' => 'P'));
        $query = $CI->db->get();
        $data['vagas'] = $query->result();

        $data['vagas']['registros'] = $query->num_rows;

        return $data['vagas'];
    }

}



if (!function_exists('buscar_curriculos')) {

    function buscar_curriculos($data) {


        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('curriculos');
        $CI->db->join('inscritos', 'inscritos.id=curriculos.inscritos_id');
        $CI->db->like(array('nome' => $data['palavra_chave']));
        $CI->db->where(array('inscritos.tipo_pessoa' => 'F'));

        $query = $CI->db->get();
        $data['curriculos'] = $query->result();

        $data['curriculos']['registros'] = $query->num_rows;

        return $data['curriculos'];
    }

}






if (!function_exists('exibir_faixa_salarial')) {

    function exibir_faixa_salarial($id, $tipo) {
        //$id do curriculo ou da vaga
        //$tipo (C)urriculo e (V)aga.
        $CI = & get_instance();
        if ($tipo == 'C') {

            $CI->db->select('pretencaosalarial_nome');
            $CI->db->from('pretencaosalarial_cadastro');
            $CI->db->join('pretencaosalarial', 'pretencaosalarial.pretencaosalarial_id=pretencaosalarial_cadastro.pretencaosalarial_pretencaosalarial_id');
            $CI->db->where(array('curriculos_id_curriculo' => $id));
            $query = $CI->db->get();
            $data['obj'] = $query->result();

            return $query->num_rows > 0 ? $data['obj'][0]->pretencaosalarial_nome : '0';
        } elseif ($tipo == 'V') {


            $CI->db->select('pretencaosalarial_nome');
            $CI->db->from('pretencaosalarial_vagas');
            $CI->db->join('pretencaosalarial', 'pretencaosalarial.pretencaosalarial_id=pretencaosalarial_vagas.pretencaosalarial_pretencaosalarial_id');
            $CI->db->where(array('vaga_id_vaga' => $id));
            $query = $CI->db->get();
            $data['obj'] = $query->result();

            return $query->num_rows > 0 ? $data['obj'][0]->pretencaosalarial_nome : '0';
        } else {
            return 0;
        }
    }

}

if (!function_exists('exibir_curriculos_recebidos')) {

    function exibir_curriculos_recebidos() {

        $CI = & get_instance();

        check_login_empresa(3);
        $id_user = $CI->session->userdata('SessionIdEmpresa');
         if ($CI->session->userdata('SessionIdEmpresa')>0){
            //Id da empresa
            $id_user= $CI->session->userdata('SessionIdEmpresa');
         }elseif($CI->session->userdata('SessionEmpresaPermissoes')>0){
            //Id da empresa
            $id_user= $CI->session->userdata('SessionEmpresaPermissoes');
         }






        if ($id_user > 0) {

            $vagas = $CI->default_model->get_all('vagas', array('vagas' . '.*'), 0, 5, array('inscritos_id' => $id_user), null, 'vagas' . '.id_vaga', 'DESC');

            foreach ($vagas as $vaga) {
                echo '<li><span>' . contar_curriculos_recebidos($vaga->id_vaga) . '</span><a href="' . site_url("/bancodetalentos_empresa/ver_curriculos_recebidos/" . $vaga->id_vaga) . '">' . $vaga->titulo_cargo . '</a></li>';
            }
        } else {
            return 0;
        }
    }

    function contar_curriculos_recebidos($id_vaga) {
        $CI = & get_instance();

        $query = "SELECT COUNT(*) as count FROM (candidaturas_vagas) WHERE vaga_id_vaga = $id_vaga";
        $res = $CI->db->query($query)->result();
        return $res[0]->count;
    }

}


if (!function_exists('exibir_nivel_atuacao')) {

    function exibir_nivel_atuacao($id_nivel) {
        //$id_nivel traz o id da tabela xx para retornar o nome_nivel

        $CI = & get_instance();
        if ($id_nivel > 0) {

            $CI->db->select('nome_nivel');
            $CI->db->from('niveis_de_atuacao');
            $CI->db->where(array('id_nivel' => $id_nivel));
            $query = $CI->db->get();
            $data['obj'] = $query->result();
            return $query->num_rows > 0 ? $data['obj'][0]->nome_nivel : '0';
        } else {
            return 0;
        }
    }

}



if (!function_exists('valida_candidatura')) {

    function valida_candidatura($id_vaga) {
        //$id_nivel traz o id da tabela xx para retornar o nome_nivel

        $CI = & get_instance();
        if ($id_vaga > 0) {

            $id = $CI->session->userdata('SessionIdAluno');

            //verifica qual e o curriculos.id_curriculo
            $CI->db->select('curriculos.id_curriculo,curriculos.objetivosprofissionais');
            $CI->db->from('curriculos');
            $CI->db->where(array('curriculos.inscritos_id' => $id));
            $query_curriculo = $CI->db->get();
            $resultado = $query_curriculo->result();
            if ($query_curriculo->num_rows < 0) {
               return 0;
            } else {
                $curriculo_id = $resultado[0]->id_curriculo;
            }


            $CI->db->select('id_candidatura');
            $CI->db->from('candidaturas_vagas');
            $CI->db->where(array('vaga_id_vaga' => $id_vaga, 'curriculos_id_curriculo' => $curriculo_id));
            $query = $CI->db->get();
            $candidatura = $query->result();

            return $query->num_rows > 0 ? $candidatura[0]->id_candidatura : '0';
        } else {
            return 0;
        }
    }

}



if (!function_exists('preco_pacote_curriculo')) {

    function preco_pacote_curriculo($numero_curriculo) {
        //$id_nivel traz o id da tabela xx para retornar o nome_nivel

        $CI = & get_instance();
        if ($numero_curriculo > 0) {



            //verifica qual e o curriculos.id_curriculo
            $CI->db->select('*');
            $CI->db->from('curriculo_preco_unitario');
            $CI->db->order_by('id_preco','desc');
            $query = $CI->db->get();
            $resultado = $query->result();
            if ($query->num_rows < 0) {
               return '-';
            } else {
                 return $resultado[0]->preco_curriculo*$numero_curriculo;
            }

        } else {
            return '-';
        }
    }

}



if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!function_exists('busca_avancada_curriculo')) {

    function busca_avancada_curriculo($data) {



        //pega todos os registros de curriculos existentes
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('curriculos');
        $CI->db->join("inscritos", "inscritos.id=curriculos.inscritos_id and inscritos.tipo_pessoa='F'");
        //trata o 3º campo trata a  nivel_atuacao
        if (isset($data['grau_formacao']) || isset($data['curso_formacao'])) {
            $CI->db->join("formacao_academica", "curriculos.id_curriculo=formacao_academica.curriculos_id_curriculo");
        }

        //trata o 4º campo trata a  area_atuacao
        if (isset($data['area_atuacao'])) {
            $CI->db->join("area_atuacao_cadastro", "curriculos.id_curriculo=area_atuacao_cadastro.curriculos_id_curriculo");
        }


        //trata o 5º campo trata a  pretencao salarial
        if (isset($data['pretencaosalarial'])) {
            $CI->db->join("pretencaosalarial_cadastro", "curriculos.id_curriculo=pretencaosalarial_cadastro.curriculos_id_curriculo");
        }

        //trata o 6º campo trata a  disponibilidade de horario
        if (isset($data['disponibilidadedehorario'])) {
            $CI->db->join("disponibilidadedehorario_cadastro", "curriculos.id_curriculo=disponibilidadedehorario_cadastro.curriculos_id_curriculo");
        }

        //trata o 9º campo idioma
        if (isset($data['idioma'])) {
            $CI->db->join("idiomas_cadastro", "curriculos.id_curriculo=idiomas_cadastro.curriculos_id_curriculo");
        }




        //trata o 1ª campo que e a busca de nome
        if (trim($data['palavra_chave']) != '') {
            $CI->db->like(array('nome' => $data['palavra_chave']));
        }

        //trata o 2º campo trata a  nivel_atuacao
        if (isset($data['nivel_atuacao'])) {
            $CI->db->where_in('curriculos.niveis_de_atuacao_id_nivel', $data['nivel_atuacao']);
        }






        //trata o 3º campo grau_formacao
        if (isset($data['grau_formacao'])) {
            $CI->db->where_in('formacao_academica.grau_formacao', $data['grau_formacao']);
        }


        //trata o 4º campo area_atuacao
        if (isset($data['area_atuacao'])) {
            $CI->db->where_in('area_atuacao_cadastro.area_de_atuacao_id_area', $data['area_atuacao']);
        }


        //trata o 5º campo pretencao salarial
        if (isset($data['pretencaosalarial'])) {
            $CI->db->where_in('pretencaosalarial_cadastro.pretencaosalarial_pretencaosalarial_id', $data['pretencaosalarial']);
        }


        //trata o 6º campo disponibilidadedehorario
        if (isset($data['disponibilidadedehorario'])) {
            $CI->db->where_in('disponibilidadedehorario_cadastro.disponibilidadehorario_pretencaosalarial_id', $data['disponibilidadedehorario']);
        }

        //trata o 7º campo sexo
        if (trim($data['sexo']) != '') {
            $CI->db->where_in('inscritos.sexo', $data['sexo']);
        }


        //trata o 8º campo pretencao salarial
        if (isset($data['idade'])) {
            if ($data['idade'] == 1) {
                if ($data['faixaidadeinicial'] != '' && $data['faixaidadefinal']  !='' && $data['faixaidadeinicial'] <= $data['faixaidadefinal']) {

                    $ano=date('Y');
                    $ano_inicial = $ano - $data['faixaidadeinicial'];
                    $where_i =  $ano_inicial .'-'. date('m-d');
                    $ano_final = $ano - $data['faixaidadefinal'];
                    $where_f =$ano_final .'-'.'01-01';

                    $CI->db->where(array('inscritos.data_nascimento <= '=>$where_i, 'inscritos.data_nascimento >= '=> $where_f));
                }
            }
            elseif ($data['idade'] == 2) {
                if ($data['faixaidadeinferior'] != '') {

                    $ano=date('Y');
                    $faixaidadeinferior = $ano - $data['faixaidadeinferior'];
                    $where_in=  $faixaidadeinferior .'-'. date('m-d');


                    $CI->db->where(array('inscritos.data_nascimento <= '=>$where_in));
                }
            }
            elseif ($data['idade'] ==3) {
                if ($data['faixaidadesuperior'] != '') {

                    $ano=date('Y');
                    $faixaidadesuperior = $ano - $data['faixaidadesuperior'];
                    $where_sup=  $faixaidadesuperior .'-'. date('m-d');
                    $CI->db->where(array('inscritos.data_nascimento >= '=>$where_sup));
                }
            }

        }


       //trata o 9º campo idioma
        if (isset($data['idioma'])) {
            $CI->db->where_in('idiomas_cadastro.idiomas_id_idioma', $data['idioma']);
        }

    	//Trata o campo cidade
    	if(isset($data['cidade'])){
    		$CI->db->like('inscritos.cidade', $data['cidade']);
    	}

    	//Trata o campo estado civil
    	if(isset($data['estado_civil'])){
    		$CI->db->like('inscritos.estadocivil', $data['estado_civil']);
    	}

    	//Trata o campo Portador de Necessidades
    	if(isset($data['portador_necessidades'])){
    		$CI->db->like('inscritos.deficiencia', $data['portador_necessidades']);
    	}

    	//Trata o campo curso de formação
    	if(isset($data['curso_formacao']) && $data['curso_formacao']){
    		$CI->db->like('formacao_academica.nome_curso', $data['curso_formacao']);
    	}




        $query = $CI->db->get();
        $data['curriculos'] = $query->result();
        $data['curriculos']['registros'] = $query->num_rows;

        return $data['curriculos'];
    }

}

if (!function_exists('retorno_id_curriculo')) {

    function retorno_id_curriculo() {

        $CI = & get_instance();
        $id = $CI->session->userdata('SessionIdAluno');
        $CI->db->select('*');
        $CI->db->from('curriculos');
        $CI->db->where(array('curriculos.inscritos_id' =>$id));
        $query = $CI->db->get();
        $data= $query->result();
        return $data[0]->id_curriculo;
    }

}

if (!function_exists('retorno_permissoes')) {

    function retorno_permissoes($id) {

        $CI = & get_instance();

         //aqui pega todos as pemissoes cadastradas
        $CI->db->select('nome_area_permissoes');
        $CI->db->from('area_permissoes_concedidas');
        $CI->db->join('area_permissoes' ,'area_permissoes_concedidas.area_permissoes_area_permissoes_id= area_permissoes.area_permissoes_id');
        $array= array('inscritos_id' =>$id);

        $CI->db->where($array);
        $query = $CI->db->get();
        $data= $query->result();
       $item='';
        foreach ($data as $itens) {
            $item=$item.$itens->nome_area_permissoes."<br>";
        }

        return $item;
    }

}





if (!function_exists('retorno_colunista')) {
    //Endereço da imagem
    function retorno_colunista($id=false) {

      if($id){
       $CI = & get_instance();
      //aqui pega o nome do colunista
        $CI->db->select('nome');
        $CI->db->from('posts_colunistas');
        $CI->db->where(array('id' =>$id));
        $query = $CI->db->get();
        if($query->num_rows>0){
            $data= $query->result();
            return $data[0]->nome;
        }else{
           return '-';
        }
      }
      else{
        return '-';

      }

    }

}





if (!function_exists('retorno_dados_arquivos')) {
    //Endereço da imagem
    function retorno_dados_arquivos($EndImagem=false) {

      if($EndImagem){
            //Pegando as informações da imagem
            $TamanhoImagem = getimagesize($EndImagem);
            $Estensao = substr($EndImagem, -3);
            return getimagesize($EndImagem);
            //Criando um array com as estensões permitidas
            $EstPermitidas = array("gif", "jpg", "png", "tif", "jpeg","pdf");

            if (in_array($Estensao, $EstPermitidas)) {


                //Exibindo as informações como width e height;
                echo("Width = " . $TamanhoImagem[0] . "<br />");
                echo("Height= " . $TamanhoImagem[1] . "<br />");
            }

      }
      else{
        return false;

      }

    }

}
// pode fazer upload de 1 ou de muitos isso depende dos forms preencridos
if (!function_exists('multiplos_uploads')) {

    function multiple_upload($name = 'userfile', $upload_dir=false, $allowed_types =false, $size = 0, $rename = false, $overwrite = false, $encrypt_name = false) {

        if(!$upload_dir){
            echo'Caminho do arquivo inválido';
            exit();
        }
        
        $config['upload_path'] = $upload_dir;
        
        
        if($allowed_types){
            $config['allowed_types'] = $allowed_types;           
        }else{
           $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|pdf|txt|odt|xls|xlsx|ppt|pptx|tif|tiff|ods|xls|xlsx';
        }
        
        /*print_r($config['allowed_types'] );
        exit;*/
        if ($rename) {

            $config['file_name'] = $rename;
        }
        if($size>0){
            $config['max_size'] = $size; 
        }
        
        if($overwrite){
           $config['overwrite'] = true; 
        } else{
           $config['overwrite'] = false;                
        }    
        
       //$config['encrypt_name'] = $encrypt_name;

         //print_r($config);
        //exit;
        
        $CI = & get_instance();

        $CI->load->library('upload', $config);
        $errors = FALSE;

        /*print_r($CI->upload->do_upload($name));
        exit;*/
        
        
        if (!$CI->upload->do_upload($name)): 
            $errors =array('erro'=>$CI->upload->display_errors());            
        else:
            // salva os dados dos arquivos
            $files = $CI->upload->data();
        
        endif;
        
       

        // se tem erro apaga os arquivos e retorna o erro
        // se nÃ£o tem erro retorna os dados dos arquivos
        if ($errors):
            @unlink($files['full_path']);
            return $errors;
        else:
            return $files;
        endif;
    }

// fim do upload multiplo
}

if (!function_exists('retorna_versoes_downloads')) {

     function retorna_versoes_downloads($id_downloads=false){

         if($id_downloads==FALSE){
            return 0;
         }

         $CI = & get_instance();
      //aqui pega A VERSOES DO DOWNLOADS
        $CI->db->select('downloads_versoes.*,downloads_compras.id_downloads_compras');
        $CI->db->from('downloads_versoes');
        $CI->db->join('downloads_compras','downloads_compras.downloads_versoes_id_download_versoes=downloads_versoes.id_download_versoes','left');
        $CI->db->where(array('downloads_id_downloads' =>$id_downloads));
        $CI->db->order_by('numero_versao', 'DESC');
        $CI->db->group_by('id_download_versoes');
        $query = $CI->db->get();
        if($query->num_rows>0){
            $aux=0;
            foreach ($query->result() as $versao) {
                //a parte mais importante do metodo
                //1° ($versao->id_downloads_compras>0) pega oque o cliente comprou
                //2º ($aux>0 && $versao->cobrada =='N')pega as versões que o cliente não comprou mais a mb disponibilizou para o mesmo

              if(($versao->id_downloads_compras>0) || ($aux >= 0 && $versao->cobrada =='N') ){
                 $aux+=1;
                  $data['versoes'][]=array('id_download_versoes'=>$versao->id_download_versoes,'tamanhomb'=>$versao->tamanhoMB,'numero_versao'=>$versao->numero_versao,'descricao_versao'=>$versao->descricao_versao,'formato_arquivo'=>$versao->formato_arquivo, 'chave' => $versao->chave);

              }

            }


        }
        return isset($data['versoes'])?$data['versoes']:0;






         return $id_downloads;

    }


}




if (!function_exists('retorna_ultima_versao_downloads')) {

     function retorna_ultima_versao_downloads($id_downloads=false, $busca = false){

         if($id_downloads==FALSE){
            return 0;
         }

         $CI = & get_instance();
      //aqui pega A VERSOES DO DOWNLOADS
        $CI->db->select('downloads_versoes.*');
        $CI->db->from('downloads_versoes');
        $CI->db->where(array('downloads_id_downloads' =>$id_downloads,'downloads_versoes.ativo'=>'S'));
        $CI->db->order_by('numero_versao','desc');
        $CI->db->limit(1);
        $query = $CI->db->get();
        if($query->num_rows>0){
            $aux=0;
            foreach ($query->result() as $versao) {
                //a parte mais importante do metodo
                // retorna a ultima versão ativa cadastrada

            	//if($busca || ($busca && strpos($versao->numero_versao, $busca) != false)){
            		$data['versoes'][]=array('id_download_versoes'=>$versao->id_download_versoes,'tamanhomb'=>$versao->tamanhoMB,'numero_versao'=>$versao->numero_versao,'descricao_versao'=>$versao->descricao_versao,'formato_arquivo'=>$versao->formato_arquivo,'descricao_extensao'=>$versao->descricao_extensao,);
               /* }else{
                    if($busca==false){
                        $data['versoes'][]=array('id_download_versoes'=>$versao->id_download_versoes,'tamanhomb'=>$versao->tamanhoMB,'numero_versao'=>$versao->numero_versao,'descricao_versao'=>$versao->descricao_versao,'formato_arquivo'=>$versao->formato_arquivo);

                    }
                }*/


            }


        }

        return isset($data['versoes'])?$data['versoes']:0;

    }


}

if (!function_exists('retorna_tipos_autodiagnosticos')) {// função booleana

    function retorna_tipos_autodiagnosticos($tipo=false) {
        $CI = & get_instance();
         if ($tipo == false) {
            return '';
         }

        $CI->db->select('*');
        $CI->db->from('tipos_autodiagnosticos');
        $CI->db->where(array('id_tipo_autodiagnostico' => $tipo));
        $query = $CI->db->get();

        // se não retorna e que o curso ja começou
        // o utimo dia de cadastro e o dia que o curso ira começar
        if ($query->num_rows > 0) {
            $result= $query->result();
            return $result[0]->nome_tipo;
        }else{
            return '';

        }

    }
}

/*
   Retorna uma lista com os cursos ordenados de acordo com a disponibilidade de turmas
   (Primeiro os cursos disponíveis, depois os indisponíveis)

*/
if (!function_exists('ordena_cursos_disponibilidade')) {
	function ordena_cursos_disponibilidade($tabela, $offset, $per_page, $where, $order_by, $order_dir, $search = false) {
		$CI = & get_instance();

		//Busca todos os cursos
		if($search)
			$todos_cursos = $CI->default_model->get_by_search($tabela, array('*'), $where, 0, NULL, $search, NULL, $order_by, $order_dir);
		else
			$todos_cursos = $CI->default_model->get_all($tabela, array('*'), 0, NULL, $where, NULL, $order_by, $order_dir);

		//Separa os cursos disponíveis e indisponíveis (de acordo com disponibilidade de turmas)
		$cursos_disponiveis = $cursos_indisponiveis = array();
		foreach($todos_cursos as $key => $curso){
			if(check_permissao_cadastramento($curso->id,'AB')){
				$cursos_disponiveis[$key] = $curso;
				$cursos_disponiveis[$key]->disponivel = 'S';
			}
			else{
				$cursos_indisponiveis[$key] = $curso;
				$cursos_indisponiveis[$key]->disponivel = 'N';
			}

		}

		//Mescla arrays com os cursos disponíveis no início
		$cursos = array_merge($cursos_disponiveis, $cursos_indisponiveis);

		//Com o array ordenado, limpa itens fora do offset definido para paginação
		foreach($cursos as $key => $curso){
			if($key < $offset){
				unset($cursos[$key]);
			}
		}

		//Retorna de acordo com o número por página
		return array_slice($cursos, 0, $per_page);
	}

}

if (!function_exists('seleciona_menu_area_restrita')) {
    function seleciona_menu_area_restrita($tipo_usuario=false) {
        $CI = & get_instance();
        if (!$tipo_usuario){
            $CI->session->unset_userdata('Session_menu_area_restrita');
        }

        if ($tipo_usuario=='F'){// pessoa fisica
             $dados = array('Session_menu_area_restrita' => $tipo_usuario);
             $CI->session->set_userdata($dados);
        }
        elseif ($tipo_usuario=='J'){// pessoa juridica
             $dados = array('Session_menu_area_restrita' => $tipo_usuario);
             $CI->session->set_userdata($dados);
        }
        elseif ($tipo_usuario=='FJ'){// pessoa fisica com permisoes juridica
             $dados = array('Session_menu_area_restrita' => $tipo_usuario);
             $CI->session->set_userdata($dados);
        }




    }

}
// esta função retorna um numero esm extenso
if (!function_exists('valorPorExtenso')) {
    function valorPorExtenso($valor=0) {

        $singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
	$plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões","quatrilhões");

	$c = array("", "cem", "duzentos", "trezentos", "quatrocentos","quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
	$d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta","sessenta", "setenta", "oitenta", "noventa");
	$d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze","dezesseis", "dezesete", "dezoito", "dezenove");
	$u = array("", "um", "dois", "três", "quatro", "cinco", "seis","sete", "oito", "nove");

	$z=0;
        $rt='';
	$valor = number_format($valor, 2, ".", ".");
	$inteiro = explode(".", $valor);
	for($i=0;$i<count($inteiro);$i++)
		for($ii=strlen($inteiro[$i]);$ii<3;$ii++)
			$inteiro[$i] = "0".$inteiro[$i];

	// $fim identifica onde que deve se dar junção de centenas por "e" ou por "," ;)
	$fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2);
	for ($i=0;$i<count($inteiro);$i++) {
		$valor = $inteiro[$i];
		$rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
		$rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
		$ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

		$r = $rc.(($rc && ($rd || $ru)) ? " e " : "").$rd.(($rd && $ru) ? " e " : "").$ru;
		$t = count($inteiro)-1-$i;
		$r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : "";
		if ($valor == "000")$z++; elseif ($z > 0) $z--;
		if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " de " : "").$plural[$t];
		if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
	}

	return($rt ? $rt : "zero");



    }

}




if (!function_exists('testa_curriculo')) {
    function testa_curriculo($id=false) {
        $CI = & get_instance();
        if(!$id){
            return false;
        }

        $CI->db->select('*');
        $CI->db->from('curriculos');
        $CI->db->where(array('inscritos_id' =>$id));
        $query = $CI->db->get();
        return $query->num_rows>0?true:false;
    }
}






if (!function_exists('retorna_downloads_categorias')) {

     function retorna_downloads_categorias(){



         $CI = & get_instance();
      //aqui pega A VERSOES DO DOWNLOADS
        $CI->db->select('downloads_categorias.*');
        $CI->db->from('downloads_categorias');
        $CI->db->where(array('downloads_categorias.ativo'=>'S'));
        $CI->db->order_by('ordem','asc');
        //$CI->db->limit(1);
        $query = $CI->db->get();
        if($query->num_rows>0){
            $aux=0;
            foreach ($query->result() as $categoria) {
                //a parte mais importante do metodo
                // retorna a ultima versão ativa cadastrada


            		$data['categoria'][]=array('id_downloads_categorias'=>$categoria->id_downloads_categorias,'nome_categoria'=>$categoria->nome_categoria);



            }


        }

        return isset($data['categoria'])?$data['categoria']:0;

    }


}


if (!function_exists('retorna_paginas_midias_sociais')) {
//F facebook, T twitter, L linkedin, Y youtube
     function retorna_paginas_midias_sociais(){
        
                // Define links das redes sociais
		$data['link_facebook'] = 'http://www.facebook.com/MBConsultoria';
		$data['link_twitter'] = 'http://www.twitter.com/ifivemb';
		$data['link_youtube'] = 'http://www.youtube.com/mbconsultoria.ifive';
		$data['link_linkedin'] = 'http://www.linkedin.com/company/multiweb-ag-ncia-digital';
        return $data;
             
         
     }
     
     
}




// ---------------------------------------------------------------------


/* End of file login_helper.php */
/* Location: ./system/helpers/login_helper.php */