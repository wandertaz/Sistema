<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!function_exists('busca_avancada_curriculo')) {

    function busca_avancada_curriculo($data) {



        //pega todos os registros de curriculos existentes
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('curriculos');
        $CI->db->join("inscritos", "inscritos.id=curriculos.inscritos_id and inscritos.tipo_pessoa='F'");
        //trata o 3º campo trata a  nivel_atuacao
        if (isset($data['grau_formacao'])) {
            $CI->db->join("formacao_academica", "curriculos.id_curriculo=formacao_academica.curriculos_id_curriculo");
        }

        //trata o 4º campo trata a  area_atuacao
        if (isset($data['area_atuacao'])) {
            $CI->db->join("area_atuacao_cadastro", "curriculos.id_curriculo=area_atuacao_cadastro.curriculos_id_curriculo");
        }


        //trata o 5º campo trata a  pretencao salarial
        if (isset($data['pretencaosalarial'])) {
            $CI->db->join("pretencaosalarial_cadastro", "curriculos.id_curriculo=pretencaosalarial_cadastro.curriculos_id_curriculo");
        }

        //trata o 6º campo trata a  disponibilidade de horario
        if (isset($data['disponibilidadedehorario'])) {
            $CI->db->join("disponibilidadedehorario_cadastro", "curriculos.id_curriculo=disponibilidadedehorario_cadastro.curriculos_id_curriculo");
        }




        //trata o 1ª campo que e a busca de nome
        if (trim($data['palavra_chave']) != '') {
            $CI->db->like(array('nome' => $data['palavra_chave']));
        }

        //trata o 2º campo trata a  nivel_atuacao
        if (isset($data['nivel_atuacao'])) {
            $CI->db->where_in('curriculos.niveis_de_atuacao_id_nivel', $data['nivel_atuacao']);
        }






        //trata o 3º campo grau_formacao
        if (isset($data['grau_formacao'])) {
            $CI->db->where_in('formacao_academica.niveis_de_atuacao_id_nivel', $data['grau_formacao']);
        }


        //trata o 4º campo area_atuacao
        if (isset($data['area_atuacao'])) {
            $CI->db->where_in('area_atuacao_cadastro.area_de_atuacao_id_area', $data['area_atuacao']);
        }


        //trata o 5º campo pretencao salarial
        if (isset($data['pretencaosalarial'])) {
            $CI->db->where_in('pretencaosalarial_cadastro.pretencaosalarial_pretencaosalarial_id', $data['pretencaosalarial']);
        }


        //trata o 6º campo pretencao salarial
        if (isset($data['disponibilidadedehorario'])) {
            $CI->db->where_in('disponibilidadedehorario_cadastro.disponibilidadehorario_pretencaosalarial_id', $data['disponibilidadedehorario']);
        }

        //trata o 7º campo sexo
        if (trim($data['sexo']) != '') {
            $CI->db->where_in('inscritos.sexo', $data['sexo']);
        }


        //trata o 8º campo pretencao salarial
        if (isset($data['idade'])) {
            if ($data['idade'] == 1) {
                if ($data['faixaidadeinicial'] != '' && $data['faixaidadefinal'] = !'' && $data['faixaidadeinicial'] <= $data['faixaidadefinal']) {


                    $ano_inicial = date('Y') - $data['faixaidadeinicial'];

                    $where = '"' . $ano_inicial . '-' . date('m-d') . '"';
                    $CI->db->where('inscritos.data_nascimento <= ', $where);


                    $ano_final = date('Y') - $data['faixaidadefinal'];
                    $where = '"' . $ano_inicial . '-' . date('01-01') . '"';
                    $CI->db->where('inscritos.data_nascimento >= ', $where);
                }



                //$CI->db->where(array('inscritos.data_nascimento'=>$data['faixaidadeinicial'],'data <='=>$data['faixaidadefinal']));
            }
        }
        //}
        // $CI->db->where(array('inscritos.tipo_pessoa' => 'F'));

        $query = $CI->db->get();
        $data['curriculos'] = $query->result();

        $data['curriculos']['registros'] = $query->num_rows;

        return $data['curriculos'];
    }

}
?>