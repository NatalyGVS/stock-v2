<?php
/* ----------------------------------- */ 
/* Class: MySQL PHP5			   */
// Fecha Creacion: 2007
// Fecha Actualizacion: 08/02/2012
/* ----------------------------------- */
class MySQL {    
	private $host	= "";
	private $user	= "";
	private $pass	= "";
	private $base	= "";
	private $conn	= NULL;
	private $debug	= true;
	private $charset = 'utf8';
	function __construct($host=DB_HOST, $base=DB_NAME, $user=DB_USER, $pass=DB_PASS) {
	//public function MySQL ($host=DB_HOST, $base=DB_NAME, $user=DB_USER, $pass=DB_PASS) {
		$this->host = $host;
		$this->base = $base;
		$this->user = $user;
		$this->pass = $pass;		
		return $this->open();
	}
	private function error($message = "") {
		if ($this->debug) {
			if ($message != "") {
				die($message);
			} else {
				die(mysql_error());
			}
		} else {
			die("");
		}
	}
	public function open() {
		if (!is_resource($this->conn)) {
			$this->conn = mysql_connect($this->host, $this->user, $this->pass);
			if (is_resource($this->conn)) {
				if (!mysql_select_db($this->base, $this->conn)) {
					$this->error();
				} else {
					mysql_set_charset($this->charset, $this->conn);
				}
			} else {
				$this->error();
			}
		}
		return $this;
	}
	public function close() {
		if (is_resource($this->conn)) {		    
			mysql_close($this->conn);
			$this->conn = NULL;	
		}		
	}
	public function status() {
		return ( $this->conn ? 'open': 'close' );
	}
	public function insert($sql = "") {
		if ($sql != "") {
			mysql_query($sql, $this->conn) or $this->error();
			return mysql_insert_id($this->conn);
		} else {
			return $this->error('ISQL Empty query');
		}
	}
	public function execute($sql = "") {
		if ($sql != "") {
			return mysql_query($sql, $this->conn) or $this->error();
		} else {
			return $this->error('ESQL Empty query');
		}
	}
	public function query($sql = "") {
		if ($sql != "") {
			if (is_resource($this->conn)) {
				return new MySQLData($sql, $this->conn);
			}
		} else {
			$this->error('SSQL Empty query');
		}
	}
	function __destruct() {
		$this->close();
	}
	/* Private */
	private function param($theValue, $theType) {
		$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
		$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
		switch ($theType) {
			case "text":
				$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
				break;    
			case "long":
			case "int":
				$theValue = ($theValue != "") ? intval($theValue) : "NULL";
				break;
			case "double":
				$theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
				break;
			case "date":
				$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
				break;
			case "mysql":
				$theValue = ($theValue != "") ? "" . $theValue . "" : "''";
				break;
		}
		return $theValue;
	}
	/* Nuevas funciones */
	public function insertArray($table, $data){
		$sField = ''; $sValues = '';
		foreach($data as $key => $values ){
			$sField .= ','.$key;
			$sValues .= "," . (is_array($values)?$this->param(current($values), key($values)):$this->param($values, 'text'));
		}
		return $this->insert("INSERT INTO ".$table."(".substr($sField,1).") VALUES(".substr($sValues,1).")");
	}
	public function updateArray($table, $data, $where=''){
		$sField = '';
		foreach($data as $key => $values )
			$sField .= ",".$key."=".(is_array($values)?$this->param(current($values), key($values)):$this->param($values, 'text'));
		$sSQL = "UPDATE ".$table." SET ".substr($sField,1);
		if($where!='')$sSQL .= " WHERE ".$where;
		$this->execute($sSQL);
	}
}
/* ----------------------------------- */ 
/* Class: MySQLData					   */
/* ----------------------------------- */
class MySQLData {		
	private $conn = NULL;
	private $data = NULL;
	private $item = NULL;
	private $rows = 0;
	private $curr = 0;
	private $size = 0;
	
	private $query = "";
	private $debug = true;
	
	function __construct($query, $conn){
	//function MySQLData($query, $conn) {
		$this->query = $query;
		$this->conn = $conn;
	}
	public function paginate($curr, $size) {
		$this->curr = $curr;
		$this->size = $size;
	}
	public function read() {
		if ($this->curr != 0) {		
			$this->data = mysql_query("SELECT count(*) as total FROM (".$this->query.") as total") or $this->error();
			$this->next();
			$this->rows = $this->field('total');
			$this->data = mysql_query($this->query." LIMIT ".(($this->curr-1)*$this->size).", ".$this->size, $this->conn) or $this->error();
		} else {
			$this->data = mysql_query($this->query, $this->conn) or $this->error();
			$this->rows = mysql_num_rows($this->data);
		}
	}
	private function error($message = "") {
		if ($this->debug) {
			if ($message != "") {
				die($message);
			} else {
				die(mysql_error());
			}
		} else {
			die("");
		}
	}
	public function total() {
		return $this->rows;	
	}
	public function page() {
		return $this->curr;	
	}
	public function pages() {
		$tpages = ceil($this->rows/$this->size);
		return $tpages;
	}
	public function count() {
		if (is_resource($this->data)) {
			return mysql_num_rows($this->data);
		} else {
			$this->error('C No Data');
		}
	}
	public function next() {
		if (is_resource($this->data)) {
			$this->item = mysql_fetch_assoc($this->data);
			return $this->item;
		} else {
			$this->error('N No Data');
		}
	}
	public function field($field) {
		return $this->item[$field];	
	}
	
	private function seek($num) {
		if (is_resource($this->data)) {
	    	mysql_data_seek($this->data, $num);
//			return $this->read();
		} else {
			$this->error('S No Data');
		}
	}
	public function first() {
		return $this->seek(0);	
	}
	function __destruct() {
		if(is_resource($this->data)) mysql_free_result($this->data);
	}
}
?>