<?php
include $_SERVER["DOCUMENT_ROOT"] . "/44/func/mysql.php";
isroot();
if(post("save"))
{
	$id = post("id");
	$name = post("name");
	$A = new db();
	$A->query("update floors set name='$name' where id = '$id'");
}
else if(post("delete"))
{
	$id = post("id");
	$A = new db();
	$A->query("delete from floors where id = '$id'");
} else
{
	echo "錯誤!!";
}
?>