<?php
include $_SERVER["DOCUMENT_ROOT"] . "/44/func/mysql.php";
isroot();
$id = post("id");
$password = post("password");
$name = post("name");
$question = post("question");
$answer = post("answer");
$A = new db();
if(post("delete"))
{
	$A->query("delete from accounts where id = '$id'")?:$A->error();
	echo "已刪除";
	redirect("/admin/");
}
else if(post("save"))
{
	$A->query("update accounts set password='$password', name='$name', question='$question', answer='$answer' where id='$id'")?:$A->error();
	echo "已更新";
	redirect("/admin/");
}
else
{
	echo "錯誤!!";
}
?>