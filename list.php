<?php
//LIST.PHP
include_once('RESTClient.php');
if (!isset($_SESSION))
	session_start();


$rest_client = new RESTClient;

$data = [
    'offset' => 0,
    'number' => 10
];

$json = $rest_client->get('api/v1/history?offset=0&number=10', $_SESSION['auth_token']);
$array = json_decode($json, true);
foreach ($array['contents'] as $key => $string) {
	echo "</br>";
	echo $key;
	foreach($string as $k => $s){
		echo $k." => ";
		echo "</br>".var_dump($s)."</br>";
	}
	echo "</br>";
	echo "</br>";
	echo "-------------------------------------------------------------------------";
}
$movies = array();
$episodes = array();

foreach ($array['contents'] as $object){
	if ($object['type'] == "VideoContent" && array_key_exists('media_type', $object) && $object['media_type'] == "movie")
		$movies[] = $object['title'];
}

foreach ($array['contents'] as $object){
	if ($object['type'] == "VideoContent" && array_key_exists('media_type', $object) && $object['media_type'] == "epidsode")
		$episodes[] = $object['title'];
}

echo "MOVIES RECENTLY ADDED: ".print_r($movies); 
echo "EPISODES RECENTLY ADDED: ".print_r($episodes); 
?>