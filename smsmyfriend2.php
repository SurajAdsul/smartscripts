<?php
// Suraj Adsul 
require('twilio-php/Services/Twilio.php'); 
 
$messages = [
"Can I have your picture so I can show Santa what I want for Christmas?",
"If I had a star for every time you brightened my day, I'd have a galaxy in my hand.",
"Now what's on the menu? Me-n-u",
"You may fall from the sky, you may fall from a tree, but the best way to fall... is in love with me.",
"You're so beautiful you made me forget my pick up line.",
"Are you a computer whiz? it seems you know how to turn my software to hardware.",
"I used to think love() was abstract, until you implemented it in MyHeart.",
"Every function without you will always be void of love.",
"Your smile must be a black hole, nothing can escape its pull.",
"Are you a keyboard? Because you're my type!",
"You're more special than relativity.",
"I'm attracted to you so strongly, scientists will have to develop a fifth fundamental force.",
"Are you made of copper and tellurium? Because you're CuTe",
"Are you the energizer bunny cause you just keep going and going through my mind.",
"Why don't software engineers need eye glasses? Because they C# (C Sharp)",
"A bus station is where a bus stops. A train station is where a train stops. On my desk, I have a work station..",
"If you think nobody cares if you’re alive, try missing a couple of payments.",

];

$account_sid = 'acc_id'; 
$auth_token = 'token'; 
$client = new Services_Twilio($account_sid, $auth_token); 
 
//8805658824
$key = array_rand($messages);
$msg = $messages[$key];

$client->account->messages->create(array(  'From' => "+146788766810068",    
     	'To' => "+688389838",    
'Body' => $msg . " - Suraj Adsul",    
));

?>


