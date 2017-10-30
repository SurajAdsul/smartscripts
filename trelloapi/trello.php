<?php

require 'vendor/autoload.php';

$pluckedColumns = [
	'idShort',
	'closed',
	'listName',
	'name',
	'shortUrl',
];

// Put your trello board json file data in this file 
$trelloData = json_decode(file_get_contents('trellodata.json'), TRUE);

// This will print the ids of list and name of the list 
$trelloLists = collect($trelloData['lists'])->map(function($list){
	return [$list['id'] => $list['name']];
})->collapse();

$trelloListsFlipped = $trelloLists->flip()->values()->toArray();

$trelloCardsData = collect($trelloData['cards'])->map(function($card) use ($trelloLists){
	$singleCard = [
		'idShort' => '#'.$card['idShort'],
		'idList' => $card['idList'],
		'listName' => $trelloLists[$card['idList']],
		'closed' => $card['closed'] ? 'Yes': 'No',
		'name' => $card['name'],
		'shortUrl' => $card['shortUrl'],
		'completed' => 'No',
		'assignedTo' => 'SURAJ', //Add your name here
	];

	// Add your id of done list 
	if($card['idList'] == '592d81089693562c6545a9fd15'){
		$singleCard['completed'] = 'Yes';
	}

	return $singleCard;
})->reject(function($card, $key){
	return $card['closed'] =='Yes';
})->groupBy(function ($card, $key) {
	return $card['idList'];
})->sortBy(function($card, $key) use ($trelloListsFlipped){
	return array_search($key, $trelloListsFlipped);
 })->flatten(1);


$trelloCardsDataKeys = implode(',', array_keys($trelloCardsData->first()));

$trelloCardsData = $trelloCardsData->map(function($item, $key){
	return implode(',', $item);
})->prepend($trelloCardsDataKeys);


header('Content-Type: application/excel');
header('Content-Disposition: attachment; filename="sample.csv"');

$fp = fopen('php://output', 'w');
foreach ( $trelloCardsData as $key=> $line ) {
	$val = str_getcsv($line, ",", '"');
	fputcsv($fp, $val);
}
fclose($fp);


?>