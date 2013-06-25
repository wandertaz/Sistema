<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Login
 *
 * @access	public
 * @param	string
 * @return	string
 */

if ( ! function_exists('check_login'))
{
	function check_login()
	{
		$CI =& get_instance();

		if( ! $CI->session->userdata('logged_in'))
		{
			$CI->session->set_flashdata('msg', "Sessão expirada.");
			redirect('multitools/login');
		}
	}
}

if ( ! function_exists('check_login_aluno'))
{
	function check_login_aluno()
	{
		$CI =& get_instance();

		if( ! $CI->session->userdata('logged_in_Aluno'))
		{
			$CI->session->set_flashdata('msg', "Sessão expirada.");
			redirect(site_url('loginlogout'));
		}
	}
}

if ( ! function_exists('check_login_empresa'))
{
	function check_login_empresa($area_permissao=false)
	{
		$CI =& get_instance();

		if( ! $CI->session->userdata('logged_in_Empresa'))
		{

                        if( ! $CI->session->userdata('logged_in_Permissao_Juridica'))
                        {
                             $CI->session->set_flashdata('msg', "Sessão expirada.");
                             redirect(site_url('loginlogout'));
                        }
                        else{
                            if ($area_permissao!=false){
                              $monta_permissao='-'.$area_permissao.'-';
                               if(strpos($CI->session->userdata('SessionAreaPermissoes'),$monta_permissao)<=0){
                                   $CI->session->set_flashdata('msg', "Sessão expirada.");
                                   redirect(site_url('loginlogout'));
                               }
                            }

                        }
		}
	}
}

if ( ! function_exists('destroy_session_antiga'))
{
	function destroy_session_antiga()
	{
		$CI =& get_instance();

		if($CI->session->userdata('logged_in_Empresa'))
		{
                    //Encerra sessão referentes ao Empresa
                    $CI->session->unset_userdata('logged_in_Empresa');
                    $CI->session->unset_userdata('SessionIdEmpresa');
                    $CI->session->unset_userdata('SessionNomeEmpresa');
                    $CI->session->unset_userdata('SessionEmailEmpresa');
                    $CI->session->unset_userdata('SessionDtCriacao');

		}

                if($CI->session->userdata('logged_in_Aluno'))
		{
			//Encerra sessão referentes ao aluno
                        $CI->session->unset_userdata('logged_in_Aluno');
                        $CI->session->unset_userdata('SessionIdAluno');
                        $CI->session->unset_userdata('SessionNomeAluno');
                        $CI->session->unset_userdata('SessionEmailAluno');
                        $CI->session->unset_userdata('SessionDtNascimento');
		}

                //Encerra sessão que controla o menu da Area restrita
                 $CI->session->unset_userdata('Session_menu_area_restrita');

                 // Encerra  sessão referentes as permissões dadas as pessoas fisicas pelas empresas
                $CI->session->unset_userdata('logged_in_Permissao_Juridica');
                $CI->session->unset_userdata('SessionAreaPermissoes');
                $CI->session->unset_userdata('SessionEmpresaPermissoes');

                 //deleta itens do carrinho
                 $CI->session->unset_userdata('carrinho');






	}
}


if ( ! function_exists('check_login_chat'))
{
	function check_login_chat()
	{
		$CI =& get_instance();

		if( ! $CI->session->userdata('chat_login'))
		{
			$CI->session->set_flashdata('msg', "Sessão expirada.");
			redirect('multitools/login/chat');
		}
	}
}

if ( ! function_exists('check_login_aluno_empresa'))
{
	function check_login_aluno_empresa()
	{
		$CI =& get_instance();

		if(!$CI->session->userdata('logged_in_Aluno') && !$CI->session->userdata('logged_in_Empresa')){
			$CI->session->set_flashdata('msg', "Sessão expirada.");
			redirect(site_url('loginlogout'));
		}
	}
}









// ---------------------------------------------------------------------


/* End of file login_helper.php */
/* Location: ./system/helpers/login_helper.php */