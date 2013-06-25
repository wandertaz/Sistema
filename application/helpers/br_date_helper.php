<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Br Date Helper
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('ing_date'))
{

	function ing_date($date)
	{
		if($date == "")
		{
			return '';
		}
		else
		{
			$ano = substr($date,6,9);
			$mes = substr($date,3,2);
			$dia = substr($date,0,2);
                        
                        return $ano."-".$mes."-".$dia;
		}
	}
}







if ( ! function_exists('br_date'))
{

	function br_date($date)
	{
		if($date == "")
		{
			return '';
		}
		else
		{
			$ano = substr($date,0,4);
			$mes = substr($date,5,2);
			$dia = substr($date,8,2);
			return $dia."/".$mes."/".$ano;
		}
	}
}

// --------------------------------------------------------------------

if ( ! function_exists('w3c_date'))
{
	function w3c_date($date)
	{
		if($date == "")
		{
			return '';
		}
		else
		{
			$ano = substr($date,6,4);
			$mes = substr($date,3,2);
			$dia = substr($date,0,2);
			return $ano."-".$mes."-".$dia;
		}
	}
}

// --------------------------------------------------------------------

if ( ! function_exists('br_date_time'))
{
	function br_date_time($date, $semana = FALSE)
	{

		if($date == "")
		{
			return '';
		}
		else
		{
			$ano = substr($date,0,4);
			$mes = substr($date,5,2);
			$dia = substr($date,8,2);
			$hora = substr($date,11,2);
			$minutos = substr($date,14,2);


			if($semana == TRUE)
			{
				$dias_semana = array(
										'Domingo',
										'Segunda-feira',
										'Terça-feira',
    									'Quarta-feira',
										'Quinta-feira',
										'Sexta-feira',
										'Sábado-feira'	);

				$diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano));
			}
			else
			{
				$diasemana = '';
			}


			switch($mes)
			{
		        case "01":    $mes = 'Janeiro';     break;
		        case "02":    $mes = 'Fevereiro';   break;
		        case "03":    $mes = 'Março';       break;
		        case "04":    $mes = 'Abril';       break;
		        case "05":    $mes = 'Maio';        break;
		        case "06":    $mes = 'Junho';       break;
		        case "07":    $mes = 'Julho';       break;
		        case "08":    $mes = 'Agosto';      break;
		        case "09":    $mes = 'Setembro';    break;
		        case "10":    $mes = 'Outubro';     break;
		        case "11":    $mes = 'Novembro';    break;
		        case "12":    $mes = 'Dezembro';    break;
		 	}

			switch($diasemana)
			{
				case "0": $diasemana = "Domingo, "; break;
				case "1": $diasemana = "Segunda-feira, "; break;
				case "2": $diasemana = "Terça-feira, ";   break;
				case "3": $diasemana = "Quarta-feira, ";  break;
				case "4": $diasemana = "Quinta-feira, ";  break;
				case "5": $diasemana = "Sexta-feira, ";   break;
				case "6": $diasemana = "Sábado, "; 	break;
			}

		 	$return = $diasemana.$dia." de ".$mes." de ".$ano;

			if(strlen($date) > 10)
			{
				$return .= " às ".$hora."h".$minutos;
			}

			return  $return;
		}
	}
}



// --------------------------------------------------------------------

if ( ! function_exists('br_date_meses'))
{
	function br_date_meses($mes)
	{

		switch($mes)
		{
			case "01":    $mes = 'Janeiro';     break;
			case "02":    $mes = 'Fevereiro';   break;
			case "03":    $mes = 'Março';       break;
			case "04":    $mes = 'Abril';       break;
			case "05":    $mes = 'Maio';        break;
			case "06":    $mes = 'Junho';       break;
			case "07":    $mes = 'Julho';       break;
			case "08":    $mes = 'Agosto';      break;
			case "09":    $mes = 'Setembro';    break;
			case "10":    $mes = 'Outubro';     break;
			case "11":    $mes = 'Novembro';    break;
			case "12":    $mes = 'Dezembro';    break;
		}

		$return = $mes;

		return  $return;
	}
}

// --------------------------------------------------------------------


if ( ! function_exists('subtrair_datas'))
{
	function subtrair_datas($dt_final, $dt_inicio)
	{

		$dateDiff = strtotime($dt_final) - strtotime($dt_inicio);
		return $fullDays = floor($dateDiff/(60*60*24));

	}
}

// --------------------------------------------------------------------

if ( ! function_exists('br_time'))
{

	function br_time($time)
	{
		if($time == "")
		{
			return '';
		}
		else
		{
			$horas = substr($time, 0, 2);
			$minutos = substr($time, 3, 2);

			if($horas == '00')
			{
				$horas = '0';
			}

			return $horas.'h'.$minutos.'min';

		}
	}
}

// --------------------------------------------------------------------

// --------------------------------------------------------------------

if ( ! function_exists('personalizar_data'))
{

	function personalizar_data($formato = 'd/m/Y', $w3c_date = '0000-00-00 00:00:00')
	{

		return date($formato, strtotime($w3c_date));

	}
}

// --------------------------------------------------------------------


if ( ! function_exists('br_month'))
{

	function br_month($mes)
	{

		switch($mes)
		{
	        case "1":    $mes = 'Janeiro';     break;
	        case "01":    $mes = 'Janeiro';     break;
	        case "2":    $mes = 'Fevereiro';   break;
	        case "02":    $mes = 'Fevereiro';   break;
	        case "3":    $mes = 'Março';       break;
	        case "03":    $mes = 'Março';       break;
	        case "4":    $mes = 'Abril';       break;
	        case "04":    $mes = 'Abril';       break;
	        case "5":    $mes = 'Maio';        break;
	        case "05":    $mes = 'Maio';        break;
	        case "6":    $mes = 'Junho';       break;
	        case "06":    $mes = 'Junho';       break;
	        case "7":    $mes = 'Julho';       break;
	        case "07":    $mes = 'Julho';       break;
	        case "08":    $mes = 'Agosto';      break;
	        case "08":    $mes = 'Agosto';      break;
	        case "09":    $mes = 'Setembro';    break;
	        case "10":    $mes = 'Outubro';     break;
	        case "11":    $mes = 'Novembro';    break;
	        case "12":    $mes = 'Dezembro';    break;
		}

		return $mes;
	}
}

if ( ! function_exists('br_mes_abrev'))
{

	function br_mes_abrev($mes)
	{

		switch($mes)
		{
			case "1":    $mes = 'Jan';     break;
			case "2":    $mes = 'Fev';   break;
			case "3":    $mes = 'Mar';       break;
			case "4":    $mes = 'Abr';       break;
			case "5":    $mes = 'Maio';        break;
			case "6":    $mes = 'Jun';       break;
			case "7":    $mes = 'Jul';       break;
			case "8":    $mes = 'Ago';      break;
			case "9":    $mes = 'Set';    break;
			case "10":    $mes = 'Out';     break;
			case "11":    $mes = 'Nov';    break;
			case "12":    $mes = 'Dez';    break;
		}

		return $mes;
	}
}

if ( ! function_exists('br_semana'))
{

	function br_semana($semana)
	{

		switch($semana)
		{
			case "1":    $semana = 'Segunda';	break;
			case "2":    $semana = 'Terça';  	break;
			case "3":    $semana = 'Quarta';   	break;
			case "4":    $semana = 'Quinta';   	break;
			case "5":    $semana = 'Sexta';   	break;
			case "6":    $semana = 'Sábado';   	break;
			case "7":    $semana = 'Domingo';   break;

		}

		return $semana;
	}
}

// --------------------------------------------------------------------


/* End of file br_date_helper.php */
/* Location: ./system/helpers/br_date_helper.php */