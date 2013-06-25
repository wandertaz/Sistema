<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	var $titulo = 'Página Inicial';
	var $dir = 'multitools/';

	public function __construct()
    {
		parent::__construct();

		$this->load->model('usuarios_model');
    }

	public function index()
	{
		$title = 'Login';

    	$this->load->view($this->dir.'login');

	}

	public function entrar()
	{
		$data = $this->usuarios_model->login($_POST);

		if($data)
		{

			$this->session->sess_destroy();

			$dados_usuario = array(
									'logged_in' => TRUE,
									'id' => $data->id,
									'nome' => $data->nome,
                                                                        'email' => $data->email,
                                                                        'tipo' => $data->tipo
								);

            $this->session->set_userdata($dados_usuario);
			redirect('multitools/home');
		}
		else
		{
			$this->session->set_flashdata('msg', "Login ou Senha Inválidos.");
			redirect(base_url().'multitools');
		}
	}

	public function sair()
	{

		$this->session->sess_destroy();
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('nome');
                
                $this->session->unset_userdata('email');
                $this->session->unset_userdata('tipo');
                
		$this->session->set_flashdata('msg', "Sessão encerrada com sucesso.");
		redirect('multitools');

	}

	public function chat(){

		//Cabeçalho
		get_header('Chat', TRUE);
		$data['h1'] = 'Chat';

		//Menu
		get_menu();

		//Cursos
		$data['cursos'] = array('' => 'Selecione o Curso') + $this->default_model->listaAssociativa('elearning', 'titulo', NULL, array('instrutor_id' => $this->session->userdata('id')));

		$this->load->view('multitools/chat/login',$data);
		get_footer(TRUE);

	}

	public function chat_entrar(){
		$instrutor_id = $_POST['instrutor_id'];
		$curso_id = $_POST['curso_id'];

		if($instrutor_id && $curso_id){

			//Exclui login de chat
			$this->chat_sair(false);

			//Salva novo login
			$rows_affected = $this->default_model->insert('chat_elearning_login', array('instrutor_id' => $instrutor_id, 'curso_id' => $curso_id, 'created' => date('Y-m-d H:i:s')));

			if($rows_affected){
				$dados_usuario = array(
										'chat_login' => TRUE,
										'chat_instrutor_id' => $instrutor_id,
										'chat_curso_id' => $curso_id
									);

				$this->session->set_userdata($dados_usuario);
				redirect('multitools/chat');
			}
		}
	}

	public function chat_sair($redireciona = true){

		$this->default_model->delete('chat_elearning_login', array('instrutor_id' => $this->session->userdata('chat_instrutor_id')));
		$this->session->sess_destroy();
		$this->session->unset_userdata('chat_login');
		$this->session->unset_userdata('chat_instrutor_id');
		$this->session->unset_userdata('chat_curso_id');

		if($redireciona)
			redirect('multitools/chat');
	}

}

/* End of file login.php */
/* Location: ./application/controllers/multitools/login.php */