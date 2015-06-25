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
<fieldset>
	<legend>各樓層配置圖</legend>
<table border=2>
	<tr><td>1室</td><td>2室</td><td>3室</td></tr>
	<tr><td colspan=3><center>??</center></td></tr>
	<tr><td>4室</td><td>5室</td><td>6室</td></tr>
</table>
</fieldset><br>
<fieldset>
<legend>樓層編輯</legend>
<form action="/44/admin/addfloor.php" method="post">
<label>樓層名稱：</label> <input type="texbox" name="name"> <input type="submit" value="新增">
</form>
</fieldset><br>
<fieldset>
<legend>樓層管理：</legend>
<?php
$A = new db();
$A->query("select * from floors");
if($A->count() > 0)
while($A->fetch())
{
?>
<form action="/44/admin/editfloor.php" method="post">
<input type="submit" value="儲存" name="save"> <input type="submit" value="刪除" name="delete"> <label>樓層名稱：</label><input type="hidden" name="id" value="<?php echo $A->element("id");?>"> <input type="textbox" name="name" value="<?php echo $A->element("name"); ?>"> 
<label>1室</label> <select name="status1"><option value="1" <?php echo $A->element("r1")=='1'?"selected":""; ?>>開放</option><option value="0" <?php echo $A->element("r1")=='0'?"selected":""; ?>>關閉</option></select>
<label>2室</label> <select name="status2"><option value="1" <?php echo $A->element("r2")=='1'?"selected":""; ?>>開放</option><option value="0" <?php echo $A->element("r2")=='0'?"selected":""; ?>>關閉</option></select>
<label>3室</label> <select name="status3"><option value="1" <?php echo $A->element("r3")=='1'?"selected":""; ?>>開放</option><option value="0" <?php echo $A->element("r3")=='0'?"selected":""; ?>>關閉</option></select>
<label>4室</label> <select name="status4"><option value="1" <?php echo $A->element("r4")=='1'?"selected":""; ?>>開放</option><option value="0" <?php echo $A->element("r4")=='0'?"selected":""; ?>>關閉</option></select>
<label>5室</label> <select name="status5"><option value="1" <?php echo $A->element("r5")=='1'?"selected":""; ?>>開放</option><option value="0" <?php echo $A->element("r5")=='0'?"selected":""; ?>>關閉</option></select>
<label>6室</label> <select name="status6"><option value="1" <?php echo $A->element("r6")=='1'?"selected":""; ?>>開放</option><option value="0" <?php echo $A->element("r6")=='0'?"selected":""; ?>>關閉</option></select>
</form>
<hr>
<?php
}else
echo "無紀錄!!";
?>
</fieldset>
</body>
</html>