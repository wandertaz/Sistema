<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('respostas_por_valor')) {
	function respostas_por_valor($subpergunta_id, $valor){

		$CI = & get_instance();

		$count_valor = $CI->default_model->get_all('pesquisas_respostas', array('COUNT(*) AS total'), 0, NULL, array('pesquisas_perguntas_id_pesquisas_perguntas' => $subpergunta_id, 'valor' => $valor));
		$total_respostas = $count_valor[0]->total;

		return $total_respostas;

	}
}

if (!function_exists('calcula_porcentagem')) {
	function calcula_porcentagem($total_opcao, $total_geral){

		$porcentagem = ($total_opcao*100)/$total_geral;
		return round($porcentagem, 2);

	}
}

// ---------------------------------------------------------------------

/* End of file login_helper.php */
/* Location: ./system/helpers/login_helper.php */