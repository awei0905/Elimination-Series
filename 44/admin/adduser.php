<?php
include $_SERVER["DOCUMENT_ROOT"] . "/44/func/mysql.php";
isroot();
if(!post("account"))
die("錯誤!!");
$account = post("account");
$password = post("password");
$name = post("name");
$question = post("question");
$answer = post("answer");
$A = new db();
$A->query("select * from accounts where account='$account'")?:$A->error();
if($A->fetch())
echo "此帳號已存在!!";
else
{
$A->query("insert into accounts values ('','$account','$password','$name','$question','$answer')")?:$A->error();
echo "已新增";
}
redirect("/admin/");
?>