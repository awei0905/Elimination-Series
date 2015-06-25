<?php
include $_SERVER["DOCUMENT_ROOT"] . "/44/func/mysql.php";
ismember();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<style>
a:hover {
	color:red;
}
a {
	color:blue;
}
table {
	border-collapse: collapse;
}
th, td {
	width: 140px;
}
</style>
</head>

<body>
<button onclick="location='/44/login/logout.php'">登出</button>
<?php
echo getsession("account") . " #" . getsession("id") . " ~" . getsession("name");
?><br>
<a href=".">預約單/取消</a> | <a href="search.php">查詢/預約</a> | <a href="view.php">會議室瀏覽</a><br>
<br>
<fieldset><legend>預約單</legend>
<table border=2>
<tr><th><a href=".?sort=0">預約單編號</a></th><th><a href=".?sort=1">使用日期</a><br>(年/月/日)</th><th>使用時段</th><th>會議室編號</th><th>借用人</th><th></th></tr>
<?php
$A = new db();
$B = new db();
switch(get("sort"))
{
	case 0:
	$A->query("select * from reserves where name='".getsession("id")."' order by serial")?:$A->error();
	break;
	case 1:
	$A->query("select * from reserves where name='".getsession('id')."' order by date")?:$A->error();
	break;
}

if($A->count()>0)
while($A->fetch())
{
?>
<tr>
<td><?php echo $A->element("serial");?></td>
<td><?php echo str_replace("-","/",$A->element("date"));?></td>
<td><?php echo section($A->element("section"));?></td>
<td><?php echo floorname($A->element("floor"))." - ".$A->element("room")."室";?></td>
<td><?php echo username($A->element("name"));?></td>
<td>
<form action="editreserve.php" method="post">
<input type="submit" value="取消">
<input type="hidden" name="delete" value="1">
<input type="hidden" name="id" value="<?php echo $A->element("id");?>">
</form></td>
</tr>
<?php 
}else{
?>
<tr><td>N/A</td><td>N/A</td><td>N/A</td><td>N/A</td><td>N/A</td><td>N/A</td></tr>
<?php
}
?>
</table>
</fieldset>
</body>
</html>