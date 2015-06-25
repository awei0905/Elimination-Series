<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<script type="text/javascript" src="../func/jq.js"></script>
<script>
$(document).ready(

);
var dragnumber = null;
var draghtml = null;
function dragstart(num, tis) {
	dragnumber = num;
	draghtml = tis;
}
function dragover(ev) {
	ev.preventDefault();
}
function drop() {
	$("#ans").val($("#ans").val()+dragnumber);
	$("#answer").html($("#answer").html()+'<img src="'+$(draghtml).attr("src")+'">');
	$(draghtml).hide();
}
</script>
<style>
#answer {
	width:100px;
	height: 25px;
	background: #0F0;
}
</style>
<body>
<?php
$temp = array();
for($i = 0; $i < 4; $i++)  {
	$temp[$i] = rand(0, 9);
	for($j = 0; $j < $i; $j++)	{
		if($temp[$j] == $temp[$i])	{
			$i--;
			break;
		}
	}
}
?>
<form action="/44/func/redirect.php" method="post">
<label>帳號：</label> <input type="textbox" name="account"><br>
<label>密碼：</label> <input type="password" name="password"><br>
<label>認證碼圖片：</label><?php
for($i = 0; $i < 4; $i++)  {
	echo '<img draggable="true" ondragstart="dragstart('.$temp[$i].',this)" src="../func/image.php?number='.$temp[$i].'"> ';
} 
?><input type="button" value="重新產生" onclick="location='/44/login/'"><br>
<label>認證碼作答區：</label><div id="answer" ondrop="drop()" ondragover="dragover(event)"></div><br>
<input type="submit" value="確定"><input type="button" value="忘記密碼" onClick="location='/44/login/forget.php'">
<input type="hidden" name="correct_answer" value="<?php
for($i = 0; $i < 4; $i++)
{
	for($j = 0; $j < $i; $j++)
	{
		if($temp[$i] < $temp[$j])
		{
			$t = $temp[$i]; $temp[$i] = $temp[$j]; $temp[$j] = $t;
		}
	}
}
for($i = 0; $i < 4; $i++) echo $temp[$i];
?>">
<input type="hidden" name="your_answer" value="" id="ans">
</form>
</body>
</html>