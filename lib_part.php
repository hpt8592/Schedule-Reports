<?php

	function get_reports()
	{
		require 'conf_sql.php';
		$q_txt = "SELECT * FROM `reports` WHERE `active`=1";
		$result = mysql_query($q_txt);
		return $result;
	}
	
	function build_table()
	{
		$q_array = array_filter(explode(";",$ext_query));
		$sql = new lib_display_query();
		$limit = sizeof($q_array);
	}
	
	function execute_sequence()
	{
		$data = get_reports();
		$rows = mysql_num_rows($data);
		echo var_dump($rows);
	}
	
		$q_array = array_filter(explode(";",$ext_query));
		$sql = new lib_display_query();
		$limit = sizeof($q_array);
		for ($i = 0; $i < $limit; $i++)
		{
		    $cr =  array_filter(explode("||",$q_array[$i]));
		    if(sizeof($cr)>1)
		    {
		        echo $cr[0]."<br>".$cr[1]."<br>";
		        $title = $cr[0];
		        $single_query = $cr[1];
		        $data = mysql_query($single_query);
		        $sql->display_table_clear_2($data,$title);
		    }
		    else
		    {
		        echo $cr[0]."<br>";
		        $single_query = $cr[0];
		        $data = mysql_query($single_query);
		        $sql->display_table_clear_2($data,"Data Table");
		    }
		    echo "<br><br>";
		}