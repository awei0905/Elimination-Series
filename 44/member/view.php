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
</style>
<script src="../func/jq.js"></script>
<script>
$(document).ready(function () {
$("#floor").on("change", function() {	
location = "view.php?floor=" + $("#floor").val();
});
$("#date").on("change", function() {
	$("#godate").submit();
});
$(".room").on("change", function() {
	$("#gogo").submit();
});
});
</script>
</head>
<body>
<button onclick="location='/44/login/logout.php'">登出</button>
<?php
echo getsession("account") . " #" . getsession("id") . " ~" . getsession("name");
?><br>
<a href=".">預約單/取消</a> | <a href="search.php">查詢/預約</a> | <a href="view.php">會議室瀏覽</a><br>
<br>
<fieldset><legend>請選擇樓層</legend>
<select name="floor" id="floor">
<option value="-1" <?php if(!get("floor")) {?> selected <?php }?> disabled>請選擇樓層</option>
<?php
$A = new db();
$A->query("select * from floors");
if($A->count()>0)
while($A->fetch())
{
?>
<option value="<?php echo $A->element("id");?>" <?php if(get("floor")==$A->element("id")) echo "selected"; ?>><?php echo $A->element("name");?></option>
<?php 
}
?>
</select>
</fieldset>
<?php
if(get("floor"))
{
?><br>
<form action="view.php" method="get" id="gogo">
<fieldset>
	<legend><?php echo floorname(get("floor"));?> 配置圖</legend>
    <input type="hidden" name="floor" value="<?php echo get("floor"); ?>">
<table border=2>
	<tr><td><input class="room" type="radio" name="room" value="1" <?php if(get("room")=='1') echo "checked";?>>1室</td><td><input class="room" type="radio" name="room" value="2" <?php if(get("room")=='2') echo "checked";?>>2室</td><td><input class="room" type="radio" name="room" value="3" <?php if(get("room")=='3') echo "checked";?>>3室</td></tr>
	<tr><td colspan=3><center><?php echo floorname(get("floor"));?></center></td></tr>
	<tr><td><input class="room" type="radio" name="room" value="4" <?php if(get("room")=='4') echo "checked";?>>4室</td><td><input class="room" type="radio" name="room" value="5" <?php if(get("room")=='5') echo "checked";?>>5室</td><td><input class="room" type="radio" name="room" value="6" <?php if(get("room")=='6') echo "checked";?>>6室</td></tr>
</table>
</fieldset>
</form>
<br>
<?php
}
if(get("room"))
{
?>
<form action="view.php" method="get" id="godate">
<fieldset><legend>請選擇日期</legend>
<input type="hidden" name="room" value="<?php echo get("room");?>">
<input type="hidden" name="floor" value="<?php echo get("floor");?>">
<input type="date" id="date" name="date" value="<?php echo get("date"); ?>">
</fieldset>
</form>
<?php 
}

if(get("date"))
{
	$C = new db();
?>
<br>
<fieldset><legend>請選擇時段</legend>
<table border=2 style="border-collapse:collapse;">
<tr><th width=130>時段</th><th width=130>是否可預約</th></tr>
<?php for($j=0;$j<4;$j++){?>
<tr><td><?php echo section($j); ?></td>
<?php
$date = get("date");
$room = get("room");
$floor = get("floor");
$C->query("select * from reserves where date='$date' and room='$room' and floor = '$floor' and section = '$j'");
?>
<td><?php if($C->count()>0) {?>已被預約<?php }else{?> <a href="search.php?date=<?php echo get("date");?>&section=<?php echo $j;?>&floor=<?php echo get("floor"); ?>&room=<?php echo get("room");?>&step=2">可預約</a><?php }?></td></tr>

<?php
}
?>
</table>
</fieldset>
<?php
}
?>

</body>
</html>