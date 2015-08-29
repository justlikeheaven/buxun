<?php
class model extends component {
	protected $db;
	protected $dbobj;
	protected $auto;
	protected $table;
    

	public $columns = null;
    	public $prefix;
    	public $debug = 0;
	protected $sql = null;
	public $last_sql;
	
	protected function _init(){
		//$db = $this->db ? $this->db : 'mysql.default';
		//$this->dbobj = db::driver($db);
		
	}
	
	/**
	 * 自动填充
	 * @param array $query
	 */
	protected function auto(&$query, $func='find'){
		is_array($this->auto[$func]) && is_array($query) && $query = array_merge($this->auto[$func], $query);
	}
	
	public function execute($sql){
		$sql = str_replace('#table', $this->table, $sql);
		return db::execute($sql);
	}
	
	public function fields($fields){
		is_array($fields) && $fields = implode(', ', $fields);
		$this->sql['fields'] = $fields;
		return $this;
	}
	
	public function table($table=''){
		if(empty($table))	return $this->table;
		$this->table = $table;
		return $this;
	}
	
	public function where($where){
		$this->sql['where'] = $where;
		return $this;
	}
	
	public function orderby($orderby){
		$this->sql['orderby'] = $orderby;
		return $this;
	}
	
	public function limit($start, $num=''){
		$this->sql['limit'] = $start;
		!empty($num) && $this->sql['limit'] .= ", {$num}";
		return $this;
	}

	public function get(){
		return db::get($this->sql(__FUNCTION__));
	}
	
	public function getall(){
		return db::getall($this->sql(__FUNCTION__));
	}
	
	public function count(){
		$res = db::get($this->sql(__FUNCTION__));
		return intval($res['count']);
	}
	
	public function insert($data){
		return db::insert($this->sql(__FUNCTION__, $data));
	}
	
	public function update($data){
		return db::execute($this->sql(__FUNCTION__, $data));
	}
	
	public function delete(){
		return db::execute($this->sql(__FUNCTION__));
	}

	protected function sql($method='get', $data=null){
		$fields = empty($this->sql['fields']) ? '*' : $this->sql['fields'];
		$table = $this->table ? $this->table : NFS::$controller;
		
		if(in_array($method, array('get', 'getall'))){
			$sql = "SELECT {$fields} FROM {$table}";
		}else if($method=='update'){
			foreach ($data as $k=>$v){
				is_string($v) && $v="'{$v}'";
				$set.="`{$k}`={$v},";
			}
			$set = rtrim($set, ',');
			$sql = "UPDATE {$table} SET {$set}";
		}else if($method=='delete'){
			$sql = "DELETE FROM `{$table}`";
		}else if($method=='insert'){
			foreach ($data as $k=>$v){				
				$key[]="`{$k}`";
				is_string($v) && $v="'{$v}'";
				$value[]=$v;
			}
			$keystr = implode(', ', $key);
			$valuestr = implode(', ', $value);
			$sql = "INSERT INTO {$table} ({$keystr}) VALUES ({$valuestr})";
		}else if($method=='count'){
			$sql = "SELECT COUNT(*) AS `count` FROM {$table}";
		}
		if($this->sql['where'])	{
			if(is_array($this->sql['where'])){
				foreach ($this->sql['where'] as $k=>$v){
					is_string($v) && $v = "'{$v}'";
					$cond[] = "`{$k}`={$v}";
				}
				$where = implode(' AND ', $cond);
			}else{
				$where = $this->sql['where'];
			}
			$sql.=" WHERE {$where}";
		}
		if($this->sql['orderby'])	$sql.=" ORDER BY {$this->sql['orderby']}";
		if($this->sql['groupby'])	$sql.=" GROUP BY {$this->sql['groupby']}";
		if($method=='get')	$sql.=" LIMIT 1";
		else if($this->sql['limit'])	$sql.=" LIMIT {$this->sql['limit']}";
		
		$this->last_sql = "<i>{$sql}</i>".PHP_EOL;
		$this->sql = array();
		return $sql;
	}
	
	public function getsql(){
		return $this->last_sql;
	}
}