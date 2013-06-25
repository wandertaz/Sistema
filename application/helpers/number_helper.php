<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Number Helpers
 *
 * Contém os helpers que manipulam números
 *
 */

/**
 * numero_pt_para_mysql
 *
 * Converte um número em português para um número aceito como float no MySQL
 *
 * @access	public
 * @param	string  Valor
 * @return	string  Valor formatado
 */
if (!function_exists('numero_pt_para_mysql')) {
    function numero_pt_para_mysql($str) {

        //Valida o número
        if(strpos($str, ",") === false)
            return $str;

        //Troca os separadores decimais e de milhares
        $str = str_replace(".", "", $str);
        $str = str_replace(",", ".", $str);
        //Retorna o valor tratado
        return $str;
    }
}

/**
 * retorna_numero_romano
 *
 * Formata o número passado para romano
 *
 * @access	public
 * @param	string  $type = 'upper' ou 'low'
 * @return	string  Número formatado
 */
if (!function_exists('retorna_numero_romano')) {
	function retorna_numero_romano($num, $type = 'upper'){

		//Retorno em maiúsculo
		if($type == 'upper'){

			//Valor inteiro
			$n = intval($num);
			$result = '';

			//Seta matriz com os números possíveis
			$lookup = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
							'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
							'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);

			//Calcula valor referente
			foreach ($lookup as $roman => $value){
				$matches = intval($n / $value);
				$result .= str_repeat($roman, $matches);
				$n = $n % $value;
			}

			//Retorna o numeral romano
			return $result;
		}
		//Retorno em minúsculo
		elseif($type == 'low'){

			//Valor inteiro
			$n = intval($num);
			$result = '';

			//Seta matriz com os números possíveis
			$lookup = array('m' => 1000, 'cm' => 900, 'd' => 500, 'cd' => 400,
							'c' => 100, 'xc' => 90, 'l' => 50, 'xl' => 40,
							'x' => 10, 'ix' => 9, 'v' => 5, 'iv' => 4, 'i' => 1);

			//Calcula valor referente
			foreach ($lookup as $roman => $value){
				$matches = intval($n / $value);
				$result .= str_repeat($roman, $matches);
				$n = $n % $value;
			}

			//Retorna o numeral romano
			return $result;
		}
	}
}
?>