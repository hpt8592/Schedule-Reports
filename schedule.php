<?php
	//require_once 'conf_sql.php';
	date_default_timezone_set("Asia/Calcutta");
	$day = date("d");
	$mon = date("m");
	$year = date("Y");
	$time = date('H:i');
$query = "SELECT * FROM `schedule` WHERE `repeat_state`='1' AND `day`='$day' AND `mon`='$mon' AND `year`='$year'";
echo $query;
	//echo $date.$time;
	function get_id()
	{
		$query = "SELECT `id` FROM `schedule` WHERE `repeat_state`='1' AND `day`='$day' AND `mon`='$mon' AND `year`='$year'";
		//$result = mysql_query($query);
		
	}
?>