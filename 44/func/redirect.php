<?php
include $_SERVER["DOCUMENT_ROOT"] . "/44/func/mysql.php";
if(post("your_answer")!=post("correct_answer")) {
	echo "驗證碼錯誤！";
	session_destroy();
	redirect("/login");
	die();
}
if(post("account") == "admin" && post("password") == "1234") {
	setsession("account","admin");
	setsession("id","-1");
	redirect("/admin");
	echo "請稍後...";
}
else {
	$A = new db();
	$A->query("select * from accounts where account = '" . post("account") . "' and password = '" . post("password") ."'")?:$A->error();
	if($A->fetch())
	{
		setsession("account",post("account"));
		setsession("id",$A->element("id"));
		setsession("name",$A->element("name"));
		echo "請稍後...";
		redirect("/member");
	}
	else
	{
		echo "帳號密碼錯誤！";
		redirect("/login");
		
	}
}
?>