<?php
include $_SERVER["DOCUMENT_ROOT"] . "/44/func/mysql.php";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>

<body>
<?php
switch(get("step"))
{
	case 0:
?>
<form action="/44/login/forget.php" method="get">
<fieldset><legend>忘記密碼</legend>
<label>請輸入帳號以便登入：</label><br>
<label>會員帳號：</label><input type="hidden" name="step" value="1"><input type="textbox" name="account"><input type="submit" value="確定">
</fieldset>
</form>
<?php
	break;
	
	case 1:
$A = new db();
$account = get("account");
$A->query("select * from accounts where account = '$account'");
if($A->count()>0)
{
	$A->fetch();
?>
<form action="/44/login/forget.php" method="get">
<fieldset><legend>忘記密碼</legend>
<label>請輸入答案以便登入：</label><br>
<label>會員帳號：<?php echo get("account");?></label><input type="hidden" name="account" value="<?php echo get("account");?>"><br>
<label>密碼提示語：<?php echo $A->element("question");?></label><input type="hidden" name="step" value="2"><br>
<label>答案：</label><input type="textbox" name="answer"><input type="submit" value="確定">
</fieldset>
</form>
<?php
}
else
{
?>
<fieldset><legend>忘記密碼</legend>
<label>查無此帳號!!</label></fieldset>
<?php
}
	break;
	
	case 2:
$A = new db();
$account = get("account");
$answer = get("answer");
$A->query("select * from accounts where account = '$account' and answer='$answer'");
if($A->count()>0)
{
	$A->fetch();
	setsession("account",get("account"));
	setsession("id",$A->element("id"));
?>
<form action="/44/member/" method="post">
<fieldset><legend>忘記密碼</legend>
<label>已成功回答問題，已將您登入。</label><br>
<input type="submit" value="確定">
</fieldset>
</form>
<?php
}
else
{
?>
<fieldset><legend>忘記密碼</legend>
<label>答案錯誤!!</label></fieldset>
<?php
redirect("/login/forget.php");
}
	break;
	
}
?>
</body>
</html>