<?php

class DBLayer
{
	var $link_id;
	var $query_result;
	var $saved_queries = array();
	var $num_queries = 0;

	function DBLayer($db_host, $db_username, $db_password, $db_name)
	{
		$this->link_id = @mysql_connect($db_host, $db_username, $db_password, true);

		if ($this->link_id)
		{
			if (@mysql_select_db($db_name, $this->link_id))
				return $this->link_id;
			else
				$this->error('Unable to select database. MySQL reported: '.mysql_error(), __FILE__, __LINE__);
		}
		else
			$this->error('Unable to connect to MySQL server. MySQL reported: '.mysql_error(), __FILE__, __LINE__);
	}

    function query($sql)
	{
//        echo "<!--$sql;-->\n";
		$this->query_result = @mysql_query($sql, $this->link_id);

		if ($this->query_result)
		{
			++$this->num_queries;
            $this->logging($sql);
			return $this->query_result;
		}
		else
		{
			return false;
		}
	}


	function result($query_id = 0, $row = 0) // Возвращает значение одной ячейки результата запроса
	{
		return ($query_id) ? @mysql_result($query_id, $row) : false;
	}


	function fetch_assoc($query_id = 0) // Возвращает ассоциативный массив
	{
		return ($query_id) ? @mysql_fetch_assoc($query_id) : false;
	}


	function fetch_row($query_id = 0) // Возвращает неассоциативный массив
	{
		return ($query_id) ? @mysql_fetch_row($query_id) : false;
	}


	function num_rows($query_id = 0) // Возвращает количество рядов результата запроса
	{
		return ($query_id) ? @mysql_num_rows($query_id) : false;
	}


	function affected_rows() // Возвращает число затронутых прошлой операцией рядов
	{
		return ($this->link_id) ? @mysql_affected_rows($this->link_id) : false;
	}


	function insert_id() // Возвращает ID, сгенерированный колонкой с AUTO_INCREMENT последним запросом INSERT
	{
		return ($this->link_id) ? @mysql_insert_id($this->link_id) : false;
	}


	function get_num_queries() // Возвращает количество запросов к БД
	{
		return $this->num_queries;
	}


	function get_saved_queries() // ????
	{
		return $this->saved_queries;
	}


	function free_result($query_id = false)
	{
		return ($query_id) ? @mysql_free_result($query_id) : false;
	}


	function escape($str) // Экранирование спецсимволов в параметрах запросов
	{
		if (function_exists('mysql_real_escape_string'))
			return mysql_real_escape_string($str, $this->link_id);
		else
			return mysql_escape_string($str);
	}


	function error()
	{
		$result['error_sql'] = @current(@end($this->saved_queries));
		$result['error_no'] = @mysql_errno($this->link_id);
		$result['error_msg'] = @mysql_error($this->link_id);
		
		return $result;
	}

    function logging($sql) // Запись в БД действий пользователя (только для INSERT, UPDATE)
    {
        //print_r(preg_match('/INSERT|UPDATE/i', $sql));
        /*if (preg_match('/INSERT|UPDATE/i', $sql) == 1)
        {
            //return true;
            echo $sql;
        }*/
    }

	function close()
	{
		if ($this->link_id)
		{
			if ($this->query_result)
				@mysql_free_result($this->query_result);

			return @mysql_close($this->link_id);
		}
		else
			return false;

	}
}

?>
