<?php 
include $_SERVER["DOCUMENT_ROOT"]."/44/func/mysql.php";
ismember();
if(post("delete"))
{
	$id = post("id");
	$A = new db();
	$A->query("delete from reserves where id = '$id'")?:$A->error();
	echo "已刪除";
	redirect("/member/.");
} else
{
	echo "錯誤!!";
}
?>