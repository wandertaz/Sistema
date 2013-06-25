<?php
class Certificados_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	/**
	 * count_avaliacoes_by_usuario_curso
	 *
	 * Busca os cursos com certificados de um dado aluno
	 *
	 * @access public
	 * @author Beto Muniz
	 * @param  string
	 * @return string
	 */
    function get_certificado($usuario,$id_inscricao){
        $this->db->where('inscrito_id', $usuario);
        $this->db->where('gerar_certificado', 'S');
        $this->db->where('id', $id_inscricao);
        $q = $this->db->get('inscricoes');
        return $q->result_array();
    }
    function print_certificado($usuario,$curso){
        $this->db->where('inscrito_id', $usuario);
        $this->db->where('curso_id', $curso);
        $this->db->where('gerar_certificado', 'S');
        $q = $this->db->get('inscricoes');
        return $q->result_array();
    }

    function get_user_logged($usuario){
        $this->db->where('id', $usuario);
        $q = $this->db->get('inscritos');
        return $q->result_array();
    }

    function get_curso($curso,$tipo){
        $this->db->where('id', $curso);
        if($tipo=="AB"){
        $q = $this->db->get('cursos_abertos');
        }elseif ($tipo=="IN") {
        $q = $this->db->get('cursos_incompany');
        }elseif ($tipo=="AL") {
        $q = $this->db->get('programas_alta_performance');
        }elseif ($tipo=="DE") {
        $q = $this->db->get('programas_desenvolvimento');
        }elseif ($tipo=="EL") {
        $q = $this->db->get('elearning');
        }
        return $q->result_array();
    }

    function get_certificado_elearning($usuario,$id_inscricao){

            $notaAluno = "SELECT sum(notas.nota) nota, inscricoes.curso_id, inscricoes.tipo_curso ";
            $notaAluno .= "FROM (`inscricoes`) ";
            $notaAluno .= "JOIN `aulas` ON `aulas`.`curso_id`=`inscricoes`.`curso_id` and aulas.tipo_curso= inscricoes.tipo_curso ";
            $notaAluno .= "JOIN `exercicios` ON `exercicios`.`aula_id`=`aulas`.`id` ";
            $notaAluno .= "JOIN `notas` ON `notas`.`exercicio_id`=`exercicios`.`id` and notas.tipo_curso= inscricoes.tipo_curso ";
            $notaAluno .= "WHERE nota >= '70' ";            
            $notaAluno .= "AND inscricoes.inscrito_id = ".$usuario." ";
            $notaAluno .= "AND inscricoes.id = ".$id_inscricao." ";
            //$notaAluno .= "AND inscricoes.tipo_curso = 'EL' ";
           // $notaAluno .= "AND inscricoes.status = 'AP'";
            //$notaAluno .= "AND inscricoes.gerar_certificado = 'S'";

            $query = $this->db->query($notaAluno);

            return $query->result_array();

    }
}



/* End of file certificados_model.php */