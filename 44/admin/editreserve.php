<?php
include $_SERVER["DOCUMENT_ROOT"] . "/44/func/mysql.php";
isroot();
if(!post("id"))
die("錯誤!!");
$id = post("id");
$A = new db();
$A->query("delete from reserves where id = '$id'")?:$A->error();
echo "已取消";
redirect("/admin/reserve.php");
?>