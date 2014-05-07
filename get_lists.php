
<?php
require_once('RESTClient.php');

function get_lists($token){
	$rest_client = new RESTClient;
	$json = $rest_client->get('api/v1/movies?auth_token='.$token);
	$lib = json_decode($json, true);
	$last_watched = array();
	foreach($lib['movies'] as $key => $movie) {
	  $json2 = $rest_client->get('/api/v1/content/'.$movie['content_ids'][0].'?auth_token='.$token);
	  $contents = json_decode($json2, true);
	  if ($contents['content']['playback_available'] == true)
	  {
	    if (isset($contents['content']['last_watched_time']))
	    {
	      $str = substr($contents['content']['last_watched_time'], 0, 10);
	      $time = time() - strtotime($str);
	    }
	    else
	      $time = time() - strtotime("1980-01-01");
	    $time /= 1000000;
	    $towatch[] = array(
	      'object' => $movie,
	      'rating_actor' => 0,
	      'rating_genre' => 0,
	      'rating' => 0,
	      'rating_total' => 0,
	      'rating_date' => $time);
	  }
	  if ($contents['content']['watched'] == true )
	  {
	    $last_watched[] = $movie;
	  }
	}
	$res = array();
	$res['towatch'] = $towatch;
	$res['last_watched'] = $last_watched;
	return $res;
}