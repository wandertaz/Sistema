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
			redirect('multitools');
		}
	}
}
// ---------------------------------------------------------------------


/* End of file login_helper.php */
/* Location: ./system/helpers/login_helper.php */