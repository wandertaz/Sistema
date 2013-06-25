<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Database Date Helper
 *
 * @access	public
 * @param	string
 * @return	string
 */

if ( ! function_exists('database_date'))
{

	function database_date($date)
	{
		if($date == ""){
			return '';
		}else{
			$date = explode('/', $date);
			$dia = $date[0];
			$mes = $date[1];
			$ano = $date[2];
			return $ano.'-'.$mes.'-'.$dia;
		}
	}
}