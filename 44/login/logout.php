<?php
include $_SERVER["DOCUMENT_ROOT"] . "/44/func/mysql.php";
session_destroy();
echo "已登出";
redirect("/login");
?>