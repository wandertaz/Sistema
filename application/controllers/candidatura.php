<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class candidatura extends MY_Controller {

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

    public function vaga($id_vaga = false) {
        check_login_aluno();

        if ($id_vaga) {

           // valida_candidatura($id_vaga);


            $id = $this->session->userdata('SessionIdAluno');

            //verifica qual e o curriculos.id_curriculo
            $this->db->select('curriculos.id_curriculo,curriculos.objetivosprofissionais');
            $this->db->from('curriculos');
            $this->db->where(array('curriculos.inscritos_id' => $id));
            $query_curriculo = $this->db->get();
            $resultado = $query_curriculo->result();

            if ($query_curriculo->num_rows < 0) {
                $data = array('msg' => 'Erro você não se candidatou na vaga, porque nao tem curriculo cadastrado', 'titulo' => 'CANDIDATURA\VAGA', 'sucesso' => '0');
            } else {

                $curriculo_id = $resultado[0]->id_curriculo;
                $data = array(
                    'curriculos_id_curriculo' => $curriculo_id,
                    'vaga_id_vaga' => $id_vaga,
                    'created' => date('Y-m-d H:i:s'),
                );
                $confirmacao = $this->db->insert('candidaturas_vagas', $data);

                if ($confirmacao == 1) {
                    $data = array('msg' => 'Candidatura foi enviada com  sucesso.', 'titulo' => 'CANDIDATURA\VAGA', 'sucesso' => '1');
                } else {

                    $data = array('msg' => 'Erro você não se candidatou na vaga', 'titulo' => 'CANDIDATURA\VAGA', 'sucesso' => '0');
                }

                $this->loadView('mensagem-retorno', $data);
            }
        }
    }

    public function curriculo() {
        check_login_aluno();
    }

}