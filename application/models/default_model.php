<?php

/**
 * @package		Multiweb
 * @author		Rafael Mariano Ferreira - rafaelemi@gmail.com
 * @since		Version 1.0
 */

class Default_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();

        //$this->output->enable_profiler(TRUE);
    }

    /*
	 * Exemplo Parametros
	 *
	 * $join = array (	"tabela1"  => array("where" => "tabela1.campo1 = tabela2.campo2", "type" => "left"),
	 * 					"tabela2"  => array("where" => "tabela1.campo1 = tabela2.campo2", "type" => "inner")
	 * 					);
	 *
	 */

	function get_all($table, array $fields, $offset = 0, $per_page = NULL, $where = NULL, $join = NULL, $order_by = NULL, $direction_order_by = "ASC", $group_by = NULL)
	{

		$this->db->select($fields);

		if( ! is_null($where))
		{
			$this->db->where($where);
		}

		if( ! is_null($join))
		{
			foreach ($join as $table_join => $params)
			{
				foreach ($params as $key => $value)
				{
					if($key == 'where')
					{
						$where = $value;
					}

					if($key == 'type')
					{
						$type = $value;
					}
				}

				$this->db->join($table_join, $where, $type);
			}

		}

		if( ! is_null($order_by))
		{

			if( is_array($order_by))
			{

				foreach ($order_by as $i_order_by => $i_direction_order_by)
				{
					$this->db->order_by($i_order_by, $i_direction_order_by);
				}
			}
			else
			{
					$this->db->order_by($order_by, $direction_order_by);
			}


		}

		if( ! is_null($per_page))
		{
			$this->db->limit($per_page, $offset);
		}

		if( ! is_null($group_by))
		{
			$this->db->group_by($group_by);
		}

		$query = $this->db->get($table);
        return $query->result();
	}


	function get_by_id($table, $id, array $fields = array('*'), $where = NULL, array $join = NULL, $campo_id = 'id')
	{
		$this->db->select($fields);

		if( ! is_null($where))
		{
			$this->db->where($where);
		}

		if( ! is_null($join))
		{
			foreach ($join as $table_join => $params)
			{
				foreach ($params as $key => $value)
				{
					if($key == 'where')
					{
						$where_j = $value;
					}

					if($key == 'type')
					{
						$type = $value;
					}
				}

				$this->db->join($table_join, $where_j, $type);
			}

		}

		$this->db->limit('1');
		$query = $this->db->get_where($table, array($table.'.'.$campo_id => $id));
        return $query->row();
	}

	function get_by_search($table, array $fields, $where = NULL, $offset = 0, $per_page = NULL, array $search, array $join = NULL, $order_by = NULL, $direction_order_by = "ASC", $group_by = NULL)
	{

		if( ! is_null($join))
		{
			foreach ($join as $table_join => $params)
			{
				foreach ($params as $key => $value)
				{
					if($key == 'where')
					{
						$where_j = $value;
					}

					if($key == 'type')
					{
						$type = $value;
					}
				}

				$this->db->join($table_join, $where_j, $type);
			}

		}

		if( ! is_null($order_by))
		{

			if( is_array($order_by))
			{

				foreach ($order_by as $i_order_by => $i_direction_order_by)
				{
					$this->db->order_by($i_order_by, $i_direction_order_by);
				}
			}
			else
			{
					$this->db->order_by($order_by, $direction_order_by);
			}


		}

		if( ! is_null($where))
		{
			$this->db->where($where);
		}


		$this->db->select($fields);
		$this->db->limit($per_page, $offset);
		$this->db->or_like($search);
		if( ! is_null($group_by))
		{
			$this->db->group_by($group_by);
		}
		$query = $this->db->get($table);
        return $query->result();
	}



        function get_by_search_All($table,$fields, $where=null, $offset = 0, $per_page = NULL, $search, array $join = NULL, $order_by = NULL, $direction_order_by = "ASC")
	{

            $Sql="SELECT ".$fields." FROM (".$table.") WHERE ";
            $Sql=$Sql.$search;

            $result = $this->db->query($Sql);
            $result2 =$result->result();
            return $result2;
	}

	function insert($table, array $data)
	{
		$this->db->insert($table, $data);
		return $this->db->affected_rows();
	}

	function update($table, $id, array $data, $campo_id = 'id')
	{
		$this->db->where($campo_id, $id);
		$this->db->update($table, $data);
		return $this->db->affected_rows();
	}

	function update_where($table, array $data, $where)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
		return $this->db->affected_rows();
	}

	function delete($table, array $where)
	{
		$this->db->delete($table, $where);
		return $this->db->affected_rows();
	}

	function count($table, array $where = NULL, array $join = NULL, $group_by = NULL)
	{

		if( ! is_null($join))
		{
			foreach ($join as $table_join => $params)
			{
				foreach ($params as $key => $value)
				{
					if($key == 'where')
					{
						$where_j = $value;
					}

					if($key == 'type')
					{
						$type = $value;
					}
				}

				$this->db->join($table_join, $where_j, $type);
			}

		}

		if( ! is_null($where))
		{
			$this->db->where($where);
		}

		if( ! is_null($group_by))
		{
			$this->db->group_by($group_by);
		}

		return $this->db->count_all_results($table);
	}

	function count_by_search($table, array $search, array $where = NULL, array $join = NULL, $group_by = NULL)
	{

		if( ! is_null($join))
		{
			foreach ($join as $table_join => $params)
			{
				foreach ($params as $key => $value)
				{
					if($key == 'where')
					{
						$where_j = $value;
					}

					if($key == 'type')
					{
						$type = $value;
					}
				}

				$this->db->join($table_join, $where_j, $type);
			}

		}


		if( ! is_null($where))
		{
			$this->db->where($where);
		}

		if( ! is_null($group_by))
		{
			$this->db->group_by($group_by);
		}

		$this->db->or_like($search);
       	return $this->db->count_all_results($table);
	}

	/**
	 * listaAssociativa
	 *
	 * Retorna uma listagem associativa
	 *
	 * @access public
	 * @author Luana
	 * @since  2010
	 * @return array||boolean
	 */
	public function listaAssociativa($table, $field, $join = NULL, $where = NULL, $order = NULL, $dir = 'ASC', $date = false, $campo_id = 'id', $fields = false) {

		//Executa a busca
		$fields = ($fields ? $fields : array($table.'.*'));
		$dados = $this->get_all($table, $fields, NULL, NULL, $where, $join, $order, $dir);

		//Associa os dados (se necess�rio)
		$_ret = array("" => "--Selecione--");
		if($dados) {
			foreach($dados as $value)
				$_ret[$value->$campo_id] = ($date ? br_date($value->$field) : $value->$field);
		}

		//Limpa a mem�ria e retorna os dados
		unset($dados);
		return $_ret;
	}


	function __destruct()
	{
		//echo $this->db->last_query();
	}

}

/* End of file default_model.php */
/* Location: ./application/models/multitools/default_model.php */