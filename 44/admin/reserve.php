<?php
include $_SERVER["DOCUMENT_ROOT"] . "/44/func/mysql.php";
isroot();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script src='/44/func/jq.js' type='text/javascript'></script>
</head>
<style>
td, th {
	width: 140px;
}
table {
	border-collapse: collapse;
}
</style>
<script>
$(function(){
$("#cl").on("click", function(){
	$("#date").val("");
	$("#floor").val(-1);
	$("#room").val(-1);
});
});
</script>
<body>
<button onclick="location='/44/login/logout.php'">登出</button>
<?php
echo getsession("account") . " #" . getsession("id") . "~ Administator";
?><br>
<a href="/44/admin/">會員管理</a> | <a href="/44/admin/floor.php">樓層管理</a> | <a href="/44/admin/reserve.php">預約單管理</a>
<br><br>
<form action="reserve.php" method="get">
<fieldset><legend>預約單管理</legend>
排列： 依日期 <input type="date" id="date" name="date" value="<?php if(get("date")) echo get("date");?>"> 依會議室 <select name="floor" id="floor"><option <?php if(!get("floor")) {?>selected<?php }?> disabled value="-1">請選擇樓層...</option><?php
$byroom = new db();
$byroom->query("select name,id from floors");
while($byroom->fetch())
{
?><option value="<?php echo $byroom->element('id');?>" <?php if(get("floor")) if(get("floor")==$byroom->element('id')) echo "selected";?>><?php echo $byroom->element('name');?>"</option><?php
}
?></select> <select name="room" id="room">
<option value="-1" <?php if(!get("room")) {?>selected<?php }?> disabled>請選擇會議室...</option>
<?php for($i=1;$i<7;$i++){?>
<option value="<?php echo $i;?>" <?php if(get("room")) if(get("room")==$i) echo "selected";?>><?php echo $i;?>室</option>
<?php }?>
</select> <input type="button" value="清除" id="cl"> <input type="submit" value="Go"></form><br>
<table border=2>
<tr>
<th>預約單編號</th><th>使用日期<br>(年/月/日)</th><th>使用時段</th><th>會議室號碼</th><th>借用人</th><th></th>
</tr>
<?php 
$A = new db();
$ind = 0;
$output = "select * from reserves ";
$arr = array(
);
if(get("date"))
$arr[$ind++] = "date";
if(get("floor"))
$arr[$ind++] = "floor";
if(get("room"))
$arr[$ind++] = "room";
if($ind!=0)
{
	for($i=0;$i<$ind;$i++)
	{
		if($i==0)
			$output .= "where";
		else
		    $output .= " and ";
		$output .= " " . $arr[$i] . " = '" . get($arr[$i]) . "'";
	}
}
$A->query($output);
if($A->count()>0)
while($A->fetch())
{
?>
<tr>
<td><?php echo $A->element("serial");?></td>
<td><?php echo str_replace("-","/",$A->element("date"));?></td>
<td><?php echo section($A->element("section"));?></td>
<td><?php echo floorname($A->element("floor")) . " - " . $A->element("room") . "室";?></td>
<td><?php echo username($A->element("name"));?></td>
<td><form action="/44/admin/editreserve.php" method="post"> <input type="submit" value="取消"><input type="hidden" name="id" value="<?php echo $A->element("id");?>"></form></td>
</tr>
<?php
}
else
{
?>
<tr><?php for($j=0;$j<6;$j++){?><td>N/A</td><?php }?></tr>
<?php 
}
?>
</table>
</fieldset>
</body>
</html>