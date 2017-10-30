<?php

require 'vendor/autoload.php';
require "vendor/larapack/dd/src/helper.php";

use Illuminate\Support\Collection;
use GuzzleHttp\Client;


$optimalTime = strtotime('-5 hours');

$users = collect([
	'U0ewee6GM' => 'XYZ',
	'U0ewdse6GM' => 'ABC',
	'U0efdwe6GM' => 'CBC',
	'U0ewe6GM' => 'TBD',
	'U0evvwe6GM' => 'PTC',
	'U0etytwe6GM' => 'GTS',
	'U0eytywe6GM' => 'UIT',
	'U0ewewee6GM' => 'TPL'
]);

$flippedUsers = $users->flip()->values()->toArray();

$client = new GuzzleHttp\Client(['base_uri' => 'https://slack.com/api/']);

$response = $client->request('GET', 'groups.history?token=token&channel=channel_id&latest='.time().'&oldest='.$optimalTime.'&pretty=0');

$botMessage = json_decode($response->getBody(), TRUE);

$botMessage = collect($botMessage['messages'])->where('bot_id', 'B51D899FPD')->first();

$response = $client->request('GET', 'files.list?token=token&channel=channel_id&ts_from='.$optimalTime.'&pretty=0');

$fileListData = json_decode($response->getBody(), TRUE);

$fileContents = collect($fileListData['files'])->pluck('id')->map(function($fileId, $key) use ($client, $users, $botMessage){
	$response = $client->request('GET', 'files.info?token=token_id&file='.$fileId.'&pretty=0');
	$fileListData = json_decode($response->getBody(), TRUE);
	if($fileListData['file']['user']=='UYTGFV3NF'){
		$fileContents[$fileListData['file']['user']] = "\n\n".$users[$fileListData['file']['user']]." \n".$fileListData['content']."\n\n".$botMessage['text'];
	}else{
		$fileContents[$fileListData['file']['user']] = "\n\n".$users[$fileListData['file']['user']]." \n".$fileListData['content'];
	}
	return $fileContents;
})->collapse()->sortBy(function($status, $key) use ($flippedUsers){
	return array_search($key, $flippedUsers);
})->implode("\n");


$fileContents = date('m/d/Y')."\n\n".'========================================================================='.$fileContents;

$postData = [
	'token' =>'token',
	'channels' => 'C78YUNKS3',
	'content' => $fileContents,
	'title' => date('m/d/Y')
];

$response = $client->request('POST', 'files.upload', ['form_params' => $postData]);

dd('done');

?>
