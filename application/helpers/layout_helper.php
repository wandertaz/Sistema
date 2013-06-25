<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Layout
 *
 * @access	public
 * @param	string
 * @return	string
 */


// ---------------------------------------------------------------------

if ( ! function_exists('get_menuSite'))
{
	function get_menuSite()
	{
		$CI =& get_instance();
		$CI->load->view('components/menu');
	}
}


// ---------------------------------------------------------------------

if ( ! function_exists('get_header'))
{
	function get_header($title = '', $multitools = FALSE)
	{
		$CI =& get_instance();
		$dados['title'] = $title;

		if($multitools)
		{
			$dir = 'multitools/';
		}
		else
		{
			$dir = '';
		}

		$CI->load->view($dir.'components/header', $dados);
	}
}

// ---------------------------------------------------------------------

if ( ! function_exists('get_footer'))
{
	function get_footer($multitools = FALSE)
	{

		$CI =& get_instance();

		if($multitools)
		{
			$dir = 'multitools/';
		}
		else
		{
			$dir = '';
		}

		$CI->load->view($dir.'components/footer');
	}
}

// ---------------------------------------------------------------------

if ( ! function_exists('get_menu'))
{
	function get_menu()
	{

		$CI =& get_instance();

		$CI->load->view('multitools/components/menu');
	}
}


/* End of file layout_helper.php */
/* Location: ./system/helpers/layout_helper.php */