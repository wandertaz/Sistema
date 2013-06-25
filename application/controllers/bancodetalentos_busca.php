<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class bancodetalentos_busca extends MY_Controller {

    //Retira a proteção deste controller
    protected $_dontProtectMe = true;

    public function __construct() {

        parent::__construct();
        $data['title'] = 'MB Consultoria - Serviços';
        //Carrega model e helpers
        $this->load->model("default_model");
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->helper('text_helper');
        $this->load->library('pagination');
        $this->load->helper('login_helper');
        $this->load->helper('auxiliar_helper');
    }

    public function vagas() {
        check_login_aluno();

        // este helper controla quem esta logado para exibir o menu da area restrita
        seleciona_menu_area_restrita('F');

        $data['post'] = $_POST ? trim($_POST['palavra_chave']) != '' ? 1 : 0  : 0;

        if ($data['post'] == 1) {

            $dat['vagas'] = buscar_vagas($_POST);
            $cont = $dat['vagas']['registros'];
            for ($x = 0; $x < $cont; $x++) {
                $data['vagas'][] = array('id_vaga' => $dat['vagas'][$x]->id_vaga, 'id_nivel' => $dat['vagas'][$x]->niveis_de_atuacao_id_nivel, 'titulo' => $dat['vagas'][$x]->titulo_cargo, 'exibir_nome_empresa' => $dat['vagas'][$x]->exibir_nome_empresa, 'nome_empresa' => $dat['vagas'][$x]->nome, 'descricao_cargo' => $dat['vagas'][$x]->descricao, 'quantidade_vagas' => $dat['vagas'][$x]->quantidade_vagas, 'exibir_faixa_salarial' => $dat['vagas'][$x]->exibir_faixa_salarial, 'qtd_registros' => $cont);
            }
        }

        $dados = array_merge($data);
        $this->loadView('banco_de_talentos/bancodetalentos-buscar-vagas', $dados);
    }

    public function curriculo() {
        check_login_empresa();

        if($this->session->userdata('SessionTipoPessoa')=='F'){
            // este helper controla quem esta logado para exibir o menu da area restrita
            seleciona_menu_area_restrita('FJ');
        }elseif($this->session->userdata('SessionTipoPessoa')=='J'){
            // este helper controla quem esta logado para exibir o menu da area restrita
            seleciona_menu_area_restrita('J');
        }

        $data['post'] = $_POST ? trim($_POST['palavra_chave']) != '' ? 1 : 0  : 0;

        if ($data['post'] == 1) {

            $dat['curriculos'] = buscar_curriculos($_POST);

            // aqui ele pega todos os ids de todos os curriculos
            $cont = $dat['curriculos']['registros'];
            $id_curriculos_compra = '';
            for ($x = 0; $x < $cont; $x++) {
                //$data['curriculos'][] = array('id_curriculo' => $dat['curriculos'][$x]->id_curriculo,'qtd_registros'=>$cont);
                if ($x != 0) {
                    $id_curriculos_compra = $id_curriculos_compra . '-';
                }
                $id_curriculos_compra = $id_curriculos_compra . $dat['curriculos'][$x]->id_curriculo;
            }
            $data['curriculos'] = array('id_curriculos_compra' => $id_curriculos_compra, 'qtd_registros' => $cont);

            // print_r($data['curriculos']);
            // exit;
        }

        $dados = array_merge($data);
        $this->loadView('banco_de_talentos/bancodetalentos-busca-quantitativa', $dados);
    }

    public function curriculo_busca_avancada() {
        check_login_empresa();


         if($this->session->userdata('SessionTipoPessoa')=='F'){
            // este helper controla quem esta logado para exibir o menu da area restrita
            seleciona_menu_area_restrita('FJ');
        }elseif($this->session->userdata('SessionTipoPessoa')=='J'){
            // este helper controla quem esta logado para exibir o menu da area restrita
            seleciona_menu_area_restrita('J');
        }

        //verifica quais são as Objetivos Profissionais - nivel atuacao
        $this->db->select('niveis_de_atuacao.id_nivel,niveis_de_atuacao.nome_nivel');
        $this->db->from('niveis_de_atuacao');
        $this->db->where(array('niveis_de_atuacao.ativo' => 'S'));
        $this->db->order_by('ordem');
        $query4 = $this->db->get();
        $resultado4 = $query4->result();

        // se existe registro ele envia se não ele envia array vazio(formação academica)
        if ($query4->num_rows > 0) {
            $qtd_media = round($query4->num_rows);
            foreach ($resultado4 as $itens) {
                $data['objetivosprofissionais_atuacao'][] = array('id_area' => $itens->id_nivel, 'nome_area' => $itens->nome_nivel, 'qtd_media' => $qtd_media);
            }
        }





        //verifica quais são as Objetivos Profissionais - Área de Atuação
        $this->db->select('area_de_atuacao.id_area, area_de_atuacao.nome_area');
        $this->db->from('area_de_atuacao');
        $this->db->where(array('area_de_atuacao.ativo' => 'S'));
        $this->db->order_by('ordem');
        $query = $this->db->get();
        $resultado = $query->result();



        // se existe registro ele envia se não ele envia array vazio(Objetivos Profissionais)
        if ($query->num_rows > 0) {
            $qtd_media = round($query->num_rows);
            foreach ($resultado as $itens) {
                $data['objetivosprofissionais_area_atuacao'][] = array('id_area' => $itens->id_area, 'nome_area' => $itens->nome_area, 'qtd_media' => $qtd_media);
            }
        }



        //verifica quais são as Objetivos Profissionais - pretenção salarial
        $this->db->select('pretencaosalarial.pretencaosalarial_id, pretencaosalarial.pretencaosalarial_nome');
        $this->db->from('pretencaosalarial');
        $this->db->where(array('pretencaosalarial.ativo' => 'S'));
        $this->db->order_by('ordem');
        $query = $this->db->get();
        $resultado = $query->result();


        // se existe registro ele envia se não ele envia array vazio(Objetivos Profissionais)
        if ($query->num_rows > 0) {
            $qtd_media = round($query->num_rows);
            foreach ($resultado as $itens) {
                $data['objetivosprofissionais_pretencaosalarial'][] = array('pretencaosalarial_id' => $itens->pretencaosalarial_id, 'pretencaosalarial_nome' => $itens->pretencaosalarial_nome, 'qtd_media' => $qtd_media);
            }
        }






        //verifica quais são os idiomas
        $this->db->select('id_idioma,nome_idioma');
        $this->db->from('idiomas_selecao');
        $this->db->where(array('ativo' => 'S'));
        $this->db->order_by('ordem');
        $query1 = $this->db->get();
        $data_result = $query1->result();
        // se existe registro ele envia se não ele envia array vazio(idiomas)
        if ($query1->num_rows > 0) {
            $qtd_media = round($query1->num_rows);
            foreach ($data_result as $itens) {

                $data['idiomas_lista'][] = array('id_idioma' => $itens->id_idioma, 'nome_idioma' => $itens->nome_idioma, 'qtd_media' => $qtd_media);
            }
        }





        //verifica quais são as Objetivos Profissionais - Segmento de Atuação
        $this->db->select('segmentodeatuacao.segmentodeatuacao_id, segmentodeatuacao.segmentodeatuacao_nome');
        $this->db->from('segmentodeatuacao');
        $this->db->where(array('segmentodeatuacao.ativo' => 'S'));
        $this->db->order_by('ordem');
        $query = $this->db->get();
        $resultado = $query->result();


        // se existe registro ele envia se não ele envia array vazio(Objetivos Profissionais)
        if ($query->num_rows > 0) {
            $qtd_media = round($query->num_rows);
            foreach ($resultado as $itens) {
                $data['objetivosprofissionais_segmento_atuacao'][] = array('segmentodeatuacao_id' => $itens->segmentodeatuacao_id, 'segmentodeatuacao_nome' => $itens->segmentodeatuacao_nome, 'qtd_media' => $qtd_media);
            }
        }


        //verifica quais são as Objetivos Profissionais - disponibilidade de horario
        $this->db->select('disponibilidadehorario.disponibilidadehorario_id, disponibilidadehorario.disponibilidadehorario_nome');
        $this->db->from('disponibilidadehorario');
        $this->db->where(array('disponibilidadehorario.ativo' => 'S'));
        $query = $this->db->get();
        $resultado = $query->result();
        // print_r($resultado);
        //exit;
        // se existe registro ele envia se não ele envia array vazio(Objetivos Profissionais)
        if ($query->num_rows > 0) {
            $qtd_media = round($query->num_rows);
            foreach ($resultado as $itens) {
                $data['objetivosprofissionais_disponibilidade_horario'][] = array('disponibilidadehorario_id' => $itens->disponibilidadehorario_id, 'disponibilidadehorario_nome' => $itens->disponibilidadehorario_nome, 'qtd_media' => $qtd_media);
            }
        }








        $dados = array_merge($data);
    	$dados['estados_civis']  = array('S' => 'Solteiro(a)', 'C' => 'Casado(a)', 'D' => 'Divorciado(a)', 'V' => 'Viúvo(a)');

        $this->loadView('banco_de_talentos/bancodetalentos-pesquisa-avancada-de-curriculos', $dados);
    }

    public function curriculo_busca_avancada_retorno() {





        //check_login_empresa();

        $data['post'] = $_POST ?1:0;


        if ($data['post'] == 1) {

            $dat['curriculos'] = busca_avancada_curriculo($_POST);

            // aqui ele pega todos os ids de todos os curriculos
            $cont = $dat['curriculos']['registros'];
            $id_curriculos_compra = '';
            for ($x = 0; $x < $cont; $x++) {
                //$data['curriculos'][] = array('id_curriculo' => $dat['curriculos'][$x]->id_curriculo,'qtd_registros'=>$cont);
                if ($x != 0) {
                    $id_curriculos_compra = $id_curriculos_compra . '-';
                }
                $id_curriculos_compra = $id_curriculos_compra . $dat['curriculos'][$x]->id_curriculo;
            }
            $data['curriculos'] = array('id_curriculos_compra' => $id_curriculos_compra, 'qtd_registros' => $cont);

            // print_r($data['curriculos']);
            // exit;
        }

        $dados = array_merge($data);
        $this->loadView('banco_de_talentos/bancodetalentos-busca-quantitativa', $dados);
    }

}
