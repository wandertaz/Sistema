<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class contato extends MY_Controller {

    //Retira a proteção deste controller
    protected $_dontProtectMe = true;

    public function __construct(){

        parent::__construct();
        $data['title'] = 'MB Consultoria - Serviços';
        //Carrega model e helpers

        $this->load->model('default_model');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->helper('text_helper');
        $this->load->helper('auxiliar_helper');
        $this->load->helper('email');
        $this->load->library('email');
    }

    public function index() {

        $titulo = 'SOLICITACAO\DUVIDA';
        $msg ='Desde de já agradecemos seu contato. Por favor preencha os campos abaixo, responderemos assim que possível. Campos com * são de preenchimento obrigatório.';
        $action ='contato/enviacontato';
        $nomebotao = 'Enviar';
        $data = array('action'=>$action,'titulo'=>$titulo,'msg'=>$msg,'nomebotao'=>$nomebotao);
        //Carrega view

        $this->loadView('contato',$data);
    }

    public function enviacontato() {
        if (valid_email($_POST['email'])) {
            
            $this->email->from('net@mbconsultoria.com.br', 'MB Consultoria');
            $this->email->reply_to($_POST['email'], $_POST['nome']);
            $list = array('net@mbconsultoria.com.br');
            $this->email->to($list);
            $this->email->subject('Contato MB Consultoria');
            $form = '<h3>Email de contato formulário site<h3><br>';
            $form = $form . 'Nome:' . $_POST['nome'] . '<br>' . 'sobrenome:' . $_POST['sobrenome'] . '<br>';
            $form = $form . 'Empresa:' . $_POST['empresa'] . '<br>' . 'Cargo:' . $_POST['cargo'] . '<br>';
            $form = $form . 'Email:' . $_POST['email'] . '<br>' . 'Telefone:' . $_POST['tel'];
            $form = $form . 'Celular:' . $_POST['cel'] . '<br>' . 'Mensagem:' . $_POST['mensagem'] . '<br>';
            $this->email->message($form);
            $this->email->send();


            $data = array('Nome' => $_POST['nome'], 'Email' => $_POST['email']);
            $return = $this->default_model->insert('EmailContato', $data);
            $data = array('msg' => 'Contato foi enviado com  sucesso.', 'titulo' => 'SOLICITACAO\DUVIDA', 'sucesso' => '1');
        } else {
            $data = array('msg' => 'Erro o contato não foi enviado', 'titulo' => 'SOLICITACAO\DUVIDA', 'sucesso' => '0');
        }
        //echo 'O comentário foi enviado com sucesso';
        $this->loadView('mensagem-retorno', $data);
    }

    public function aceite_me($tipo = false) {
        $titulo = 'Contrato de Adesão';



            // Pega todos destaques e exibe com os detalhes de versão
            $this->db->select('texto_aceite');
            $this->db->from('aceite_me');
            $this->db->where('aceite_me.area_permissao_id', $tipo);
            $query = $this->db->get();
            $texto = $query->result();

            $msg = 'Desde de já agradecemos seu contato. Por favor preencha os campos abaixo, responderemos assim que possível. Campos com * são de preenchimento obrigatório.';

            $action = 'contato/enviacontato';

            $nomebotao = 'Enviar';

            $data = array('action'=>$action, 'titulo'=>$titulo,'msg'=>$msg, 'nomebotao'=>$nomebotao,'texto'=>$texto);
                       
            $this->loadView('mensagem-aceite-me',$data);

    }
}