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
	border-collapse:collapse;
}
th, td {
	width:140px;
}
</style>
<script src="../func/jq.js"></script>

</head>

<body>
<button onclick="location='/44/login/logout.php'">登出</button>
<?php
echo getsession("account") . " #" . getsession("id") . " ~" . getsession("name");
?><br>
<a href=".">預約單/取消</a> | <a href="search.php">查詢/預約</a> | <a href="view.php">會議室瀏覽</a><br>
<br>
<?php
switch(get("step"))
{
	case 0:
?>
<script>
function chk() {
	var flag = true;
	var correct = '<span style="color:green;"><strong>正確</strong></span>';
	if($("#date").val()=='')
	{
		$("#datemsg").html('<span style="color:red;"><strong>請選擇日期</strong></span>');
		flag = false;
	}
	else
		$("#datemsg").html(correct);
	if($("#section").val()==null)
	{
		$("#sectionmsg").html('<span style="color:red;"><strong>請選擇時段</strong></span>');
		flag = false;
	}
	else
		$("#sectionmsg").html(correct);
	return flag;	
}
function clr() {
	$("#date").val("");
	$("#section").val("");
}
</script>
<form action="search.php" method="get" onSubmit="return chk()">
<fieldset><legend>請選擇日期及時段</legend>
<label>日期</label> <input type="date" name="date" id="date" value="<?php echo date("Y-m-d",time());?>" min="<?php echo date("Y-m-d",time());?>" max="<?php echo date("Y-m-d",time()+604800);?>"><label id="datemsg"></label><br>
<label>時段</label> <select name="section" id="section">
<option selected disabled>請選擇時段...</option>
<?php for($o=0;$o<4;$o++){?>
<option value="<?php echo $o;?>"><?php echo section($o);?></option>
<?php }?>
</select>
<label id="sectionmsg"></label><br>
<input type="hidden" value="1" name="step">
<input type="submit" value="確定"> <input type="button" value="清除" onclick="clr()">
<?php
	break;
	case 1:
?>
<fieldset><legend>查詢結果 -  可預約的會議室</legend>
<?php
$stampoftime;
switch(get("section"))
{
	case 0:
	$stampoftime = "10:00";
	break;
	case 1:
	$stampoftime = "12:00";
	break;
	case 2:
	$stampoftime = "14:00";
	break;
	case 3:
	$stampoftime = "16:00";	
	break;
}
if(strtotime(date("H:i:s",time()))>strtotime($stampoftime))
{
	die ("預約時間已過！！</fieldset>");
}
?>
<table border=2>
<tr><th>使用日期<br>(年/月/日)</th><th>使用時段</th><th>會議室號碼</th><th></th></tr>
<?php 
$A = new db();
$B = new db();
$date = get("date");
$section = get("section");
$A->query("select * from floors where 1")?:$A->error();
if($A->count()>0)
{
	while($A->fetch())
	{
		for($i=1;$i<7;$i++)
		{
			$B->query("select * from reserves where date = '".get("date")."' and floor = '".$A->element("id")."' and room='$i' and section='".get("section")."'"?:$B-error());
			if($B->count() == 0)
				{
?>
<tr>
<td><?php echo str_replace("-","/",get("date"));?></td>
<td><?php echo section(get("section"));?></td>
<td><?php echo $A->element("name")." - ".$i. "室"?></td>
<td><form action="search.php" method="get">
<input type="submit" value="預約">
<input type="hidden" name="date" value="<?php echo get("date");?>">
<input type="hidden" name="section" value="<?php echo get("section");?>">
<input type="hidden" name="floor" value="<?php echo $A->element("id");?>">
<input type="hidden" name="room" value="<?php echo $i;?>">
<input type="hidden" name="step" value="2">
</form></td>
</tr>
<?php
				}
		}
	}
}
else
{
?>
<tr><td>N/A</td><td>N/A</td><td>N/A</td><td>N/A</td></tr>
<?php
}
	break;
	case 2:
	?>
    <fieldset><legend>確認預約</legend>
    <table border=2>
    <tr><th>使用日期<br>(年/月/日)</th><th>使用時段</th><th>會議室號碼</th><th></th></tr>
    <tr>
    <td><?php echo str_replace("/","-",get("date"));?></td>
    <td><?php echo section(get("section"));?></td>
    <td><?php echo floorname(get("floor"))." - ".get("room")."室";?></td>
    <td><form action="search.php" method="get"><input type="submit" value="確定預約">
    
    <?php
    foreach($_GET as $f=>$s)
	{
		?>
        <input type="hidden" name="<?php echo $f;?>" value="<?php echo $s;?>">
        <?php
	}
	?>
    <input type="hidden" name="step" value="3">
    </form></td>
    </tr>
    </table>
    </fieldset>
    <?php
	break;
	case 3:
	$A = new db();
	$serial = rand(999999,9999999);
	$date = get("date");
	$section = get("section");
	$floor = get("floor");
	$room = get("room");
	$name = getsession("id");
	$A->query("insert into reserves values ('','$serial','$date','$section','$floor','$room','$name')")?:$A->error();
	?>
    <fieldset><legend>已新增以下預約單</legend>
     <table border=2>
    <tr><th>使用日期<br>(年/月/日)</th><th>使用時段</th><th>會議室號碼</th></tr>
    <tr>
    <td><?php echo str_replace("/","-",get("date"));?></td>
    <td><?php echo section(get("section"));?></td>
    <td><a href="search.php?step=4&floor=<?php echo get("floor");?>&date=<?php echo get("date");?>&section=<?php echo get("section"); ?>"><?php echo floorname(get("floor"))."</a> - ".get("room")."室";?></td>
    </tr>
    </table>
    </fieldset>
    <?php
	break;
	case 4:
	$floor = get("floor");
	$date = get("date");
	$rooms = array();
	$A = new db();
	for($i = 1; $i < 7;$i ++)
	{
		$A->query("select * from reserves where date='$date' and floor = '$floor' and room = '$i'");
		if($A->count() > 0)
		$rooms[$i] = true;
		else
		$rooms[$i] = false;
	}
?>
    <fieldset>
	<legend><?php echo floorname(get("floor")); ?> 層配置圖</legend>
<table border=2 style="float:left;">
	<tr>
<?php
for($j=1;$j<4;$j++)
{
?>
     <td><?php if($rooms[$j]==true){ echo '<span style="color:red;font-weight:bold;">'.$j; ?>室 <?php echo '</a>';} else 
	 {echo '<a href="search.php?date='.$date.'&section='.get("section").'&floor='.get("floor").'&room='.$j.'&step=2">'.$j;?>室<?php echo "</a>";}?></td>     
<?php
}
?>
    </tr>
	<tr><td colspan=3><center><?php echo floorname(get("floor")); ?> </center></td></tr>
	<tr>
   <?php
for($j=4;$j<7;$j++)
{
?>
     <td><?php if($rooms[$j]==true){ echo '<span style="color:red;font-weight:bold;">'.$j; ?>室 <?php echo '</a>';} else 
	 {echo '<a href="search.php?date='.$date.'&section='.get("section").'&floor='.get("floor").'&room='.$j.'&step=2">'.$j;?>室<?php echo "</a>";}?></td>     
<?php
}
?>
</table>
<table border=2 style="float:left; margin: 0 0 0 20px;">
<tr><th>顏色</th><th>狀態</th></tr>
<tr><td><span style="color:red;">紅色</td><td>無法預約</td></span></tr>
<tr><td><span style="color:blue;">藍色</td><td>可以預約</td></span></tr>
</table>
<br>
<div style="width:740px; height:50px; clear:both; float:left;">
<div style="display:table;   margin: 20px auto 0;">
<button style="clear:both; text-align:center; float:left;" onclick="<?php echo "location='search.php?date=".$date.'&section='.get("section").'&floor='.get("floor").'&room='.$j."&step=1'";?> ">回查詢結果頁面</button>
</div>
</div>
</fieldset>
<?php
	break;
}
?>
</table>
</fieldset>
</body>
</html>