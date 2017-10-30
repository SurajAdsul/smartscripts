<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$curentDate  = date("y/d/m");
$contents = file_get_contents('/var/www/html/smartscripts/status.txt', FILE_TEXT, NULL);


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://hooks.zapier.com/hooks/catch/998658958/1eilkjf9/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"status\"\r\n\r\nAmol: #2181 - Add Similar Offers to Offer Details page on ap1 1] Try to use laravel model in core php part - Completed 2] Get similar offers related to that camp-id - In-Progress 3] Display the similar offers\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"date\"\r\n\r\n04/28/17\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
    "date:".$curentDate,
    "postman-token: 67a0baf9-7d35-a1c7-8428-5ffd25d294a3",
    "text:".$contents
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}



?>