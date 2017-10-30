<?php
require 'vendor/autoload.php';
require "vendor/larapack/dd/src/helper.php";
require('twilio-php/Services/Twilio.php'); 

use Illuminate\Support\Collection;
use GuzzleHttp\Client;

$account_sid = 'acc_id'; 
$auth_token = 'auth_token'; 

$client = new Client(['base_uri' =>'https://www.nestaway.com/search_new.json?bed_count=1&bed_type=room&city=pune&distance=13000&engine=v3&gender=boys&isgrid=true&latitude=18.5596581&locality=baner&longitude=73.7799374&max_bed_count=20&max_movein_date=&max_price=200000&min_price=2000&nql=&order=asc&order_by=price&page=1&per_page=30&roomtype=private']);
$response = $client->request('GET', '');
$data = json_decode($response->getBody(), true);

$housedata = new Collection($data['houses']);

$filtered = $housedata->filter(function ($value, $key) {
    return $value['min_room_rent'] <= 8000;
});

if($filtered->isEmpty()){
	echo date("d-m-Y h:i:sa").'  No result found';
	die;
}


foreach ($filtered as $item) {
		$smsClient = new Services_Twilio($account_sid, $auth_token); 
		$smsClient->account->messages->create(array(  
		'From' => "+7426449898723",    
		'To' => "+918784888938",    
		'Body' => "Rent = ".$item['min_room_rent']." House = ".$item['title']." Locality = ".$item['locality']." - Suraj Adsul",    
	));
		
}

echo date("d-m-Y h:i:sa").'  success';
die;

?>