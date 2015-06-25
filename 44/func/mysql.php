<?php
session_start();
setcookie('PHPSESSID', session_id(), time()+1200);
function post($p) {
	if(isset($_POST[$p]))
		return $_POST[$p];
	else
		return false;
}
function get($g) {
	if(isset($_GET[$g]))
		return $_GET[$g];
	else
		return false;
}
function getsession($s) {	
	if(isset($_SESSION[$s]))
		return $_SESSION[$s];
	else
		return false;
}
function setsession($s,$v) {
 	$_SESSION[$s] = $v;
	return;
}
function redirect($url) {
	header("refresh:0.2; url=/44".$url);
}
function isroot() {
	if(getsession("id")=='-1')
		return true;
	else die("權限不足!!");
}
function ismember() {
	if(getsession("id")==false)
		die("權限不足!!");
	else return true; 
}
function section($sec) {
	switch($sec)
	{
		case 0:
		return "10:00-12:00";
		case 1:
		return "12:00-14:00";
		case 2:
		return "14:00-16:00";
		case 3:
		return "16:00-18:00";
	}
}
function floorname($name) {
	$floorname = new db();
	$floorname->query("select name from floors where id = '$name'");
	$floorname->fetch();
	return $floorname->element("name");
}
function username($id) {
	$username = new db();
	$username->query("select name from accounts where id = '$id'");
	$username->fetch();
	return $username->element("name");
}

class db {
	var $db;
	var $result;
	var $element;
	
	function __construct()	{
		$this->db = mysql_connect("127.0.0.1","admin","1234");
		mysql_query("set names utf8");
		mysql_select_db("S44");
	}
	
	public function query($command) {
		$this->result = mysql_query($command);
		if($this->result==true)
			return true;
		else
			return false;
	}
	
	public function error() {
		die(mysql_error($this->db));
	}
	
	public function fetch() {
		$this->element = mysql_fetch_array($this->result);
		return $this->element;
	}
	
	public function element($ele) {
		return $this->element[$ele];
	}
	
	public function count() {
		return mysql_num_rows($this->result);
	}
}
?>