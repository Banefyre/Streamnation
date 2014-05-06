<?php
//LIST.PHP
include_once('RESTClient.php');
if (!isset($_SESSION))
	session_start();

// $rest_client = new RESTClient;
// $json = $rest_client->get('api/v1/content/?auth_token='.$_SESSION['auth_token']);
// $contents = json_decode($json, true);

// foreach ($contents['contents'] as $key => $value) {
// 	echo "</br>";
// 	echo "$key => ";
// 	foreach ($value as $k => $v) {
// 		echo "</br>";
// 		echo "$k => ";
// 		var_dump($v);
// 		echo "</br>";
// 	}
// 	echo "</br>";
// }


$rest_client = new RESTClient;
$json = $rest_client->get('api/v1/movies?auth_token='.$_SESSION['auth_token']);
$lib = json_decode($json, true);
foreach($lib['movies'] as $key => $movie) {// TO GET ALL INFO ABOUT EACH MOVIE
	$json2 = $rest_client->get('api/v1/content/'.$movie["content_ids"][0].'?auth_token='.$_SESSION["auth_token"]);
	$contents = json_decode($json2, true);
	//var_dump($contents);
	foreach ($contents as $key => $value) {
		echo "</br>";
		echo "$key => ";
		// var_dump($value);
		foreach ($value as $ke => $va) {
			echo "</br>";
			echo "$ke => ";
			var_dump($va);
			echo "</br>";
		}
		echo "</br>";
	}
}



// $json = $rest_client->get('api/v1/history?offset=0&number=10', $_SESSION['auth_token']);
// $array = json_decode($json, true);
// foreach ($array['contents'] as $key => $string) {
// 	echo "</br>";
// 	echo $key;
// 	foreach($string as $k => $s){
// 		echo $k." => ";
// 		echo "</br>".var_dump($s)."</br>";
// 	}
// 	echo "</br>";
// 	echo "</br>";
// 	echo "-------------------------------------------------------------------------";
// 	echo "</br>";
// }
// $movies = array();
// $episodes = array();

// foreach ($array['contents'] as $object){
// 	if ($object['type'] == "VideoContent" && array_key_exists('media_type', $object) && $object['media_type'] == "movie")
// 	{
// 		$movies[] = $object['title'];
// 	}
// }

// foreach ($array['contents'] as $object){
// 	if ($object['type'] == "VideoContent" && array_key_exists('media_type', $object) && $object['media_type'] == "episode")
// 	{
// 		$episodes[] = $object['title'];
// 	}
// }

// echo "MOVIES RECENTLY ADDED: ";
// 	foreach( $movies as $movie)
// 		echo $movie."</br>";
//  echo "EPISODES RECENTLY ADDED: ";
//  foreach( $episodes as $episode)
// 		echo $episode."</br>";

// echo "<hr>";

// $rest_client = new RESTClient;
// $json = $rest_client->get('api/v1/user/me?auth_token='.$_SESSION['auth_token'], $_SESSION['auth_token']);
// $user = json_decode($json, true);

// var_dump($user);


// $rest_client = new RESTClient;
// $json = $rest_client->get('api/v1/movies?auth_token='.$_SESSION['auth_token'].'&sortby=title');
// $lib = json_decode($json, true);

// 	foreach($lib['movies'] as $key => $movie) // TO GET ALL INFO ABOUT EACH MOVIE
// 	{
		
// 		echo $movie['name'];

// 		var_dump($movie['content_ids']);
// 		echo "</br>";
// 		$rest_client2 = new RESTClient;
// 		$json2 = $rest_client2->get('/api/v1/content/'.$movie['content_ids'][0].'?auth_token='.$_SESSION['auth_token']);
// 		$contents = json_decode($json2, true);
// 		echo "</br>";
// 		var_dump($contents);





		// foreach ($contents['content'] as $key => $value) {
		// 	echo "</br>";
		// 	echo "$key    =>  ";
		// 	foreach ($value as $k => $v) {
		// 		echo "</br>";
		// 		echo "$k    =>  ";
		// 		var_dump($v);
		// 	}
		// 	echo "</br>";
		// }
	//}
	


	// foreach ($lib['movies'][0] as $key => $value) {
	// 	echo "</br>";
	// echo "</br>";
	// 	echo "$key      =>";
	// 	var_dump($value);
	// 	echo "</br>";
	// echo "</br>";
	// }




	//var_dump($lib['movies'][0]);
	// 	foreach ($string as $key => $value) {
	// 		// echo "</br>";
	// 		// echo "$key  => ";
	// 		// var_dump($value);
	// 		// echo "</br>";
	// 		if ($key == "name")
	// 			var_dump($value);
	// 	}
	// }

// 	if ($lib[])
// }

?>