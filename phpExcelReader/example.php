<?php
$file = fopen("plan.csv","r");

$plan = array();
while(! feof($file))
  {
  $plan[] = fgetcsv($file);
  }
fclose($file);

var_dump($plan);

$mydate = date("d/m/y");
var_dump($mydate);

function searchForStartDate($id, $array) {
   foreach ($array as $key => $val) {
       if ($val[3] == $id) {
           return $val;
       }
   }
   return null;
}

function searchForEndDate($id, $array) {
   foreach ($array as $key => $val) {
       if ($val[4] == $id) {
           return $val;
       }
   }
   return null;
}

$data = searchForStartDate($mydate,$plan);
if(empty($data))
{
	$data = searchForEndDate($mydate,$plan);
	$flag = 'Completed';
} else{
	$data1 = searchForEndDate($mydate,$plan);
	if(empty($data1)){
		$flag = 'In-progress';
	}else{
		$flag = 'Completed';
	}
	
}

$status = "<b>Status Update ".date("m/d")."</b>\n \r\n Hello All, \n Below is the development status for today. \n ".$data[0]." - ".$flag."
Please let us know in case of any concern. \n Thanks,";

print_r($status);




?>