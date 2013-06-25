<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Login
 *
 * @access	public
 * @param	string
 * @return	string
 */
//calcula a idade formado de data de entrada
if (!function_exists('calculaidade')) {

    function calculaidade($data) {

        //$idade=0;
        //Data atual
        $dia = date('d');
        $mes = date('m');
        $ano = date('Y');


        $vetordata = explode('/', $data);

        //Data do aniversário
        $dianasc = ($vetordata[0]);
        $mesnasc = ($vetordata[1]);
        $anonasc = ($vetordata[2]);

        //Calculando sua idade
        //$idade= 32;
        $idade = $ano - $anonasc;
        if ($mes < $mesnasc) {
            $idade = $idade - 1;
            return $idade;
        } elseif ($mes == $mesnasc and $dia <= $dianasc) {
            $idade = $idade - 1;
            return $idade;
        } else {
            return $idade;
        }
    }

}


// pode fazer upload de 1 ou de muitos isso depende dos forms preencridos
if (!function_exists('multiplos_uploads')) {

    function multiple_upload($name = 'userfile', $upload_dir=false, $allowed_types =false, $size = 0, $rename = false, $overwrite = false, $encrypt_name = false) {

        if(!$upload_dir){
            echo'Caminho do arquivo inv�lido';
            exit();
        }
        
        $config['upload_path'] = $upload_dir;
        if($allowed_types){
            $config['allowed_types'] = $allowed_types;           
        }else{
           $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|pdf|txt|odt|xls|xlsx|ppt|pptx|tif|tiff|ods';
        }
        /*print_r($config['allowed_types'] );
        exit;*/
        if ($rename) {

            $config['file_name'] = $rename;
        }
        if($size<=0){
            $config['max_size'] = $size; 
        }
                
        $config['overwrite'] = $overwrite;
       //$config['encrypt_name'] = $encrypt_name;

        $CI = & get_instance();

        $CI->load->library('upload', $config);
        $errors = FALSE;

        if (!$CI->upload->do_upload($name)): 
            $errors = TRUE;
        else:
            // salva os dados dos arquivos
            $files = $CI->upload->data();
        endif;

        // se tem erro apaga os arquivos e retorna o erro
        // se não tem erro retorna os dados dos arquivos
        if ($errors):
            @unlink($files['full_path']);
            return false;
        else:
            return $files;
        endif;
    }

// fim do upload multiplo
}

// esta função retorna um numero esm extenso
if (!function_exists('valorPorExtenso')) {

    function valorPorExtenso($valor = 0) {

        $singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
        $plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões", "quatrilhões");

        $c = array("", "cem", "duzentos", "trezentos", "quatrocentos", "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
        $d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta", "sessenta", "setenta", "oitenta", "noventa");
        $d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze", "dezesseis", "dezesete", "dezoito", "dezenove");
        $u = array("", "um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove");

        $z = 0;
        $rt = '';
        $valor = number_format($valor, 2, ".", ".");
        $inteiro = explode(".", $valor);
        for ($i = 0; $i < count($inteiro); $i++)
            for ($ii = strlen($inteiro[$i]); $ii < 3; $ii++)
                $inteiro[$i] = "0" . $inteiro[$i];

        // $fim identifica onde que deve se dar junção de centenas por "e" ou por "," ;)
        $fim = count($inteiro) - ($inteiro[count($inteiro) - 1] > 0 ? 1 : 2);
        for ($i = 0; $i < count($inteiro); $i++) {
            $valor = $inteiro[$i];
            $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
            $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
            $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

            $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd && $ru) ? " e " : "") . $ru;
            $t = count($inteiro) - 1 - $i;
            $r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
            if ($valor == "000")
                $z++; elseif ($z > 0)
                $z--;
            if (($t == 1) && ($z > 0) && ($inteiro[0] > 0))
                $r .= (($z > 1) ? " de " : "") . $plural[$t];
            if ($r)
                $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
        }

        return($rt ? $rt : "zero");
    }

}


// ---------------------------------------------------------------------


/* End of file login_helper.php */
/* Location: ./system/helpers/login_helper.php */