<?php

	require 'lib.php';

	function connect_sql()
	{
		mysql_connect("localhost","root","iamadmin");
		mysql_select_db("p1");
	}

	function get_reports()
	{
		require 'conf_sql.php';
		$q_txt = "SELECT * FROM `reports` WHERE `active`=1";
		$result = mysql_query($q_txt);
		return $result;
	}
	
	function get_num_rows()
	{
		$data = get_reports();
		$rows = mysql_num_rows($data);
		return $rows;
	}

	function get_data_row($data)
	{
		$row = mysql_fetch_row($data);
		return $row;
	}
	
	function get_mail_header($row)
	{
		$to = $row[1];
		$from = $row[2];
		$cc = $row[3];
		$bcc = $row[4];
		$subject = $row[5];
		$mail_array = array("to"=>$to, "from"=>$from, "cc"=>$cc, "bcc"=>$bcc, "subject"=>$subject);
		return  $mail_array;
	}
	
	function implement_table($row)
	{
		$data = $row[6];
		$sql = new lib_display_query();
		$q_array = array_filter(explode(";",$data));
		$loop = sizeof($q_array);
		for($i=0;$i<$loop;$i++)
		{
			$last_data = array_filter(explode("||",$q_array[$i]));
			if(sizeof($last_data)>1)
			{
				$title = $last_data[0];
				$q_txt = $last_data[1];
			}
			else
			{
				$title = "Data Table";
				$q_txt = $last_data[0];
			}
			echo $q_txt;
			connect_sql();
			$data_table = mysql_query($q_txt);
			$sql->display_table_clear_2($data_table,$title);
			echo "<br>";
		}
	}
	
	function get_url_content($url)
	{
		$cSession = curl_init();
		curl_setopt($cSession,CURLOPT_URL,$url);
		curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($cSession,CURLOPT_HEADER, false);
		$result=curl_exec($cSession);
		return $result;
		curl_close($cSession);
	}
	
	function send_mail($mail_array,$html)
	{
		$to = $mail_array[0];
		$from = $mail_array[1];
		$subject = $mail_array[4];
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$from."\r\n".
			'Reply-To: '.$from."\r\n" .
			'X-Mailer: PHP/' . phpversion();
		$headers .= "Return-Path: ".$from."\r\n";
		$headers .= "CC: ".$mail_array[2]."\r\n";
		$headers .= "BCC: ".$mail_array[3]."\r\n";
		if(mail($to, $subject, $html, $headers))
		{
			echo 'Your mail has been sent successfully.';
		}
		else
		{
			echo 'Unable to send email. Please try again.';
		}
	}
	
	function send_mail_phpmailer($header,$msg)
	{
		require_once 'phpmailer/PHPMailerAutoload.php';
		$mail = new PHPMailer;
		
		$mail->isSMTP();
		$mail->Host = 'vps.mataji.org';
		$mail->SMTPAuth = true;
		$mail->Username = 'hardik@webmavens.in';
		$mail->Password = 'megatronpro';
		$mail->SMTPSecure = 'ssl';
		$mail->Port = 465;
		
		$mail->setFrom($header['from']);
		$mail->addAddress($header['to']);
		//$mail->addAddress('ellen@example.com');
		//$mail->addReplyTo('info@example.com', 'Information');
		$mail->addCC($header['cc']);
		//$mail->addBCC($header['bcc']);
		
		$mail->Subject = $header['subject'];
		$mail->Body    = $msg;
		$mail->IsHTML(true);
		
		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo 'Message has been sent';
		}
		//echo var_dump($header);
	}
	
	function execute_sequence()
	{
		$data = get_reports();
		$rows = mysql_num_rows($data);
		for($i=0;$i<$rows;$i++)
		{
			$row = get_data_row($data);
			ob_start();
			implement_table($row);
			$html = ob_get_clean();
			if($row[7]!="" || $row!=null)
			{
				$url_curl = get_url_content($row[7]);
				$send = "<html><body>".$html."<br><br><strong>URL Result:</strong>".$url_curl."<br></body>";
			}
			else
			{
				$send = "<html><body>".$html."<br></body>";
			}
			
			$mail_array = get_mail_header($row);
			
			send_mail_phpmailer($mail_array,$send);
		}
	}
	
?>