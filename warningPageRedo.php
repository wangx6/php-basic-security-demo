<!DOCTYPE HTML>
<html>
<body style="background-color:#000; color:#0C0">

<?php
	$homelink = 'http://pier.pieronline.org';
	$country = 'VNM';
	$page_array = array("6","8");
	foreach($page_array as $page){
		//  we need to get the company name and the link to this company first
		$content = file_get_contents("http://pier.pieronline.org/agencies/list?country=".$country."&page=".$page);
		$table = strstr($content, '<table class=\'list\' style=\'width:100%\'>');
		$pieces = explode("</table>", $table);
		$table = $pieces[0].'</table>';
		$rows = explode("<tr id=",$table);
		array_shift($rows);
		
		
		foreach($rows as $row)
		{
			$temp = get_info($row);
			
			$company_page = file_get_contents($homelink.$temp[0]);
			$company_1 = strstr($company_page,"<div id='body'>");
			$company_2 = strstr($company_1,"<p class='small'>");
			$company_3 = explode("</p>",$company_2); // $company_3 contains possible emails
			
			if(strpos($company_3[0],"&#64;") !== false)
			{
				$t = explode("&#64;",$company_3[0]);
				//echo $company_3[0];
				$email_name = substr(strrchr($t[0], ">"), 1);
				$email_domain = explode("<br />",$t[1]);
				$email = trim($email_name).'@'.$email_domain[0];
				$company_info = $temp[1].'{{}}'.$email.'{{}}'.$homelink.$temp[0];
				
			}
			else $company_info = $temp[1].'{{}}'.'N/A'.'{{}}'.$homelink.$temp[0];
			echo $company_info.'<br>';
			
			$final_array[] = $company_info;
			
		}
	}
	
	$file = fopen("appendToTempAgency.csv","w");	
	foreach ($final_array as $line)
	{
		fputcsv($file,explode('{{}}',$line));
	}
	fclose($file); 
	
	function get_info($row)
	{
		$temp = strstr($row,"<a");
		$a = explode("</a>",$temp);
		$info = strstr($a[0],'/');
		$info = explode("\">",$info);
		//echo $info[0].'<br>'.$info[1];
		//echo '<br><br>';
		return $info;
	}
?>
</body>
</html>