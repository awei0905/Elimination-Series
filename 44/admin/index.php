<?php
include $_SERVER["DOCUMENT_ROOT"] . "/44/func/mysql.php";
isroot();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>

<body>
<button onclick="location='/44/login/logout.php'">登出</button>
<?php
echo getsession("account") . " #" . getsession("id") . "~ Administator";
?><br>
<a href="/44/admin/">會員管理</a> | <a href="/44/admin/floor.php">樓層管理</a> | <a href="/44/admin/reserve.php">預約單管理</a>
<br><br>
<form action="/44/admin/adduser.php" method="post">
<fieldset><legend>新增帳號</legend>
<label>帳號:</label><input type="textbox" name="account"> <label>密碼:</label><input type="textbox" name="password"><br>
<label>姓名：</label><input type="textbox" name="name"><br>
<label>密碼提示語：</label><input type="textbox" name="question"> <label>答案：</label><input type="textbox" name="answer"><br>
<input type="submit" value="新增">
</fieldset>
</form><br>
<?php
$A = new db();
$A->query("select * from accounts");
?>
<fieldset><legend>修改會員資料</legend>
<?php
if($A->count() > 0)
{
while($A->fetch())
{
?>
<form action="/44/admin/edituser.php" method="post">
<input type="hidden" value="<?php echo $A->element("id");?>" name="id"><input type="submit" value="儲存" name="save"> <input type="submit" name="delete" value="刪除"> <label>帳號:<?php echo $A->element("account");?></label><br><label>密碼:</label><input type="textbox" name="password" value="<?php echo $A->element("password"); ?>"><label>姓名：</label><input type="textbox" name="name" value="<?php echo $A->element("name");?>"><br>
<label>密碼提示語：</label><input type="textbox" name="question" value="<?php echo $A->element("question");?>"> <label>答案：</label><input type="textbox" name="answer" value="<?php echo $A->element("answer");?>">
</form>
<hr>
<?php
}
}
else
echo "無資料!!";
?>
</fieldset>

</body>
</html>