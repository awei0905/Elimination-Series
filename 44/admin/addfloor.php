<?php
include $_SERVER["DOCUMENT_ROOT"] . "/44/func/mysql.php";
isroot();
$name = post("name");
$A = new db();
$A->query("insert into floors values('','$name',1,1,1,1,1,1)")?:$A->error();
echo "已新增";
redirect("/admin/floor.php");
?>