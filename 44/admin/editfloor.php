<?php
include $_SERVER["DOCUMENT_ROOT"] . "/44/func/mysql.php";
isroot();
if(post("save"))
{
	if(post("N"))
	{
		redirect("/admin/floor.php");
		die("已取消操作!!");
	}
	$A = new db();
	$id = post("id");
	$name = post("name");
	$status = array();
	for($i=0;$i<6;$i++)
	{
		$status[$i] = post("status".($i+1));
	}
	if(!post("Y"))
	{
	$msg = '0';
	$B = new db();
	for($i=1;$i<7;$i++)
	{
		if($status[($i-1)]=='0')
		{
			$B->query("select * from reserves where room = '$i' and floor = '$id'")?:$B->error();
			while($B->fetch())
			{
				if($msg=='0')
				{
				?>
                <table border=2>
					<tr>
						<th>預約單編號</th><th>使用日期<br>(年/月/日)</th><th>使用時段</th><th>會議室號碼</th><th>借用人</th>
					</tr>
                <?php
				}
				?>
                <tr>
                <td><?php echo $B->element("serial");?></td>
				<td><?php echo str_replace("-","/",$B->element("date"));?></td>
				<td><?php echo section($B->element("section"));?></td>
				<td><?php echo floorname($B->element("floor")) . " - " . $B->element("room") . "室";?></td>
				<td><?php echo username($B->element("name"));?></td>
                </tr>
                <?php
				$msg='1';
			}
			
		}
	}
	if($msg=='1')
	{
			?>           
            </table><br>
            以上預約已存在，是否刪除？ <form action="editfloor.php" method="post"><input type="submit" name="Y" value="是"><input type="submit" name="N" value="否">
            <?php
			foreach($_POST as $k=>$l)echo "<input type='hidden'  name='$k' value='$l'>";
			?>
            </form>
            <?php
			die();
	}
	else
	{
	$A->query("update floors set name='$name',r1='$status[0]',r2='$status[1]',r3='$status[2]',r4='$status[3]',r5='$status[4]',r6='$status[5]' where id = '$id'")?:$A->error();
	echo "已更新";
	}
	}
	else
	{
	
	$id = post("id");
	$name = post("name");
	$status = array();
	for($i=0;$i<6;$i++)
	{
		$status[$i] = post("status".($i+1));
	}
		
	$B = new db();
	for($i=1;$i<7;$i++)
	{
		if($status[($i-1)]=='0')
		{
			$B->query("delete from reserves where room = '$i' and floor = '$id'")?:$B->error();
		}
	}	
	
	$A->query("update floors set name='$name',r1='$status[0]',r2='$status[1]',r3='$status[2]',r4='$status[3]',r5='$status[4]',r6='$status[5]' where id = '$id'")?:$A->error();
	echo "已更新";
	}
}
else if(post("delete"))
{
	if(post("N"))
	{
		redirect("/admin/floor.php");
		die("已取消操作!!");
	}	
	$id = post("id");
	$A = new db();
	$B = new db();
	$msg = '0';
	if(post("Y"))
	{
		$A->query("delete from floors where id = '$id'")?:$A->error();
		$B->query("delete from reserves where floor = '$id'");
		redirect("/admin/floor.php");
		die("已刪除");
	}
	$B->query("select * from reserves where floor='$id'");
	if($B->count()>0)
	{
	while($B->fetch())
	{
		if($msg=='0')
				{
				?>
                <table border=2>
					<tr>
						<th>預約單編號</th><th>使用日期<br>(年/月/日)</th><th>使用時段</th><th>會議室號碼</th><th>借用人</th>
					</tr>
                <?php
				}
				?>
                <tr>
                <td><?php echo $B->element("serial");?></td>
				<td><?php echo str_replace("-","/",$B->element("date"));?></td>
				<td><?php echo section($B->element("section"));?></td>
				<td><?php echo floorname($B->element("floor")) . " - " . $B->element("room") . "室";?></td>
				<td><?php echo username($B->element("name"));?></td>
                </tr>
                <?php
				$msg='1';
	}
	if($msg=='1')
	{
			?>           
            </table><br>
            以上預約已存在，是否刪除？ <form action="editfloor.php" method="post"><input type="submit" name="Y" value="是"><input type="submit" name="N" value="否">
            <?php
			foreach($_POST as $k=>$l)echo "<input type='hidden'  name='$k' value='$l'>";
			?>
            </form>
            <?php
			die();
	}
	}	
	$A->query("delete from floors where id = '$id'")?:$A->error();
	echo "已刪除";
} else
{
	die("錯誤!!");
}
redirect("/admin/floor.php");
?>