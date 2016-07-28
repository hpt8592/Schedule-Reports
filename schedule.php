<?php
	require_once 'conf_sql.php';
	$day = date("d");
	$mon = date("m");
	$year = date("Y");
	$time = date('H:i');
	$query = "SELECT * FROM `schedule` WHERE `repeat_state`='1'";
	$r = mysqli_query($con,$query);
	function get_id()
	{
		$query = "SELECT `id` FROM `schedule` WHERE `repeat_state`='1' AND `day`='$day' AND `mon`='$mon' AND `year`='$year'";
		//$result = mysql_query($query);
	}
$current = "$year"."$mon"."$day";
$days = cal_days_in_month(CAL_GREGORIAN,$mon,$year);
$next = array();
if(($my_id['day']+7)>$days)
{
	$next[] = 7-($days-$day);
	$next[] = $next[0]+7;
	$next[] = $next[1]+7;
	$next[] = $next[2]+7;
	$next[] = $next[3]+7;
}
else
{
	$next[] = $my_id['day']+7;
	$next[] = $next[0]+7;
	$next[] = $next[1]+7;
	$next[] = $next[2]+7;
	$next[] = $next[3]+7;
}
echo $current;
	
	
	//$days = cal_days_in_month(CAL_GREGORIAN,2,1965);
	for($i=0;$i<mysqli_num_rows($r);$i++)
	{
		$my_id = mysqli_fetch_assoc($r);
		//echo $i."->".$my_id['id']."<br>";
		if($my_id['eday']==1)
		{
			if($time==$my_id['time'])
			{
				$list[$i] = $my_id['serial'];
			}
		}
		if($my_id['eweek']==1)
		{
			
			if($day==$my_id['day'] && $time==$my_id['time'])
			{
				$list[$i] = $my_id['serial'];
			}
		}
		if($my_id['emonth']==1)
		{
			if($mon==$my_id['mon'] && $day==$my_id['day'] && $time==$my_id['time'])
			{
				$list[$i] = $my_id['serial'];
			}
		}
		if($my_id['eyear']==1)
		{
			if($year==$my_id['year'] && $mon==$my_id['mon'] && $day==$my_id['day'] && $time==$my_id['time'])
			{
				$list[$i] = $my_id['serial'];
			}
		}
	}
	//echo var_dump($list);
	
	
?>