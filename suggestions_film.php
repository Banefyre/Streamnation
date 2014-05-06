<?PHP
require_once('RESTClient.php');
if (!isset($_SESSION))
  session_start();

$towatch = array();

$rest_client = new RESTClient;
$json = $rest_client->get('api/v1/movies?auth_token='.$_SESSION['auth_token']);
$lib = json_decode($json, true);
$last_watched = array();
foreach($lib['movies'] as $key => $movie) {// TO GET ALL INFO ABOUT EACH MOVIE
  $json2 = $rest_client->get('/api/v1/content/'.$movie['content_ids'][0].'?auth_token='.$_SESSION['auth_token']);
  $contents = json_decode($json2, true);
  if ($contents['content']['playback_available'] == true)
  {
    if (isset($contents['content']['last_watched_time']))
    {
      //2014-10-00
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


foreach($last_watched as $movie)
{// TO GET ALL INFO ABOUT EACH MOVIE
  $cast = $movie['cast'];
  foreach ($cast as $actor)
  {
    foreach($towatch as $key => $movie2)
    {
      $cast2 = $movie2['object']['cast'];
      foreach($cast2 as $actor2)
      {
        if ($actor2['name'] == $actor['name'])
        {
          $towatch[$key]['rating_actor'] += 1;
        }
      }
    }
  }
}

//genre

foreach($last_watched as $movie)
{// TO GET ALL INFO ABOUT EACH MOVIE
  $genres = $movie['genres'];
  foreach ($genres as $genre)
  {
    foreach($towatch as $key => $movie2)
    {
      $genres2 = $movie2['object']['genres'];
      foreach($genres2 as $genre2)
      {
        if ($genre2 == $genre)
        {
          $towatch[$key]['rating_genre'] += 1;
        }
      }
    }
  }
}

//rating
foreach($towatch as $key => $movie)
{
  $towatch[$key]['rating'] = $movie['object']['rating'];
  $towatch[$key]['rating_total'] = (($movie['rating_actor'] / 2 + $movie['rating_genre'])
                                  * $movie['object']['rating']) * ($movie['rating_date']);
}

//sort by actor
sort_array_of_array($towatch, 'rating_actor');
$best_by_actors = array_slice($towatch, 0, 5);
sort_array_of_array($towatch, 'rating_genre');
$best_by_genres = array_slice($towatch, 0, 5);
sort_array_of_array($towatch, 'rating');
$best_by_rating = array_slice($towatch, 0, 5);

sort_array_of_array($towatch, 'rating_total');
$movies = array_slice($towatch, 0, 5);



function sort_array_of_array(&$array, $subfield)
{
    $sortarray = array();
    foreach ($array as $key => $row)
    {
        $sortarray[$key] = $row[$subfield];
    }
    array_multisort($sortarray, SORT_DESC, $array);
}


///

///
?>
<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="UTF-8">
    <link href="css/semantic.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/login.css" rel="stylesheet" type="text/css"/>
    <link href="css/header.css" rel="stylesheet" type="text/css"/>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="javascript/semantic.js"></script>
	  <script src="javascript/login.js"></script>
    <script src="javascript/logout.js"></script>
  </head>
  <body>
    <img id="background" src="images/background-login.jpg">
  <?PHP include('menu.php') ?>

  <div id="content"> <!-- content -->
  <div id= "main-content">

    <div class="ui breadcrumb">
      <a href="./" class="section">Home</a>
      <div class="divider"> / </div>
      <div class="active section">Suggested films</div>
    </div>

    <!--//TOP 5-->
    <h2 class="ui dividing header">Top 5</h2>

    <div class="ui items"> <!-- items-->

    <?php
    foreach ($movies as $m){
      foreach ($m['object']['covers'] as $c){
        if ($c['type'] == 'native')
          $img = $c['uri'];
      }
      if (!isset($img))
        $img = $m['covers'][0]['uri'];
    ?>
      <div class="item ">
        <div class="image">
          <img src= <?php echo "\"$img \""?> >
          <a class="like ui corner label"> <!-- ADD LIKE IF CLICKED -->
            <i class="like icon"></i>
          </a>
        </div>
        <div class="content">
          <div class="name"><?php echo $m['object']['name']?></div>
          <div class="extra">
              <?php echo $m['object']['like_count'].' likes | rating: '.$m['rating']; ?>
          </div>
        </div>
      </div>
    <?php } ?>

    </div> <!-- end items -->

    <!--//BY RATING-->

    <h2 class="ui dividing header">Top 5 By rating</h2>
    <div class="ui items"> <!-- items-->
    <?php

    foreach ($best_by_rating as $m){
      foreach ($m['object']['covers'] as $c){
        if ($c['type'] == 'native')
          $img = $c['uri'];
      }
      if (!isset($img))
        $img = $m['covers'][0]['uri'];
    ?>
      <div class="item ">
        <div class="image">
          <img src= <?php echo "\"$img \""?> >
          <a class="like ui corner label"> <!-- ADD LIKE IF CLICKED -->
            <i class="like icon"></i>
          </a>
        </div>
        <div class="content">
          <div class="name"><?php echo $m['object']['name']?></div>
          <div class="extra">
              <?php echo $m['object']['like_count'].' likes | rating: '.$m['object']['rating']; ?>
          </div>
        </div>
      </div>
    <?php } ?>

    </div> <!-- end items -->


    <!--//BY ACTOR-->

    <h2 class="ui dividing header">Top 5 by Actor</h2>
    <div class="ui items"> <!-- items-->

    <?php


    foreach ($best_by_actors as $m){
      foreach ($m['object']['covers'] as $c){
        if ($c['type'] == 'native')
          $img = $c['uri'];
      }
      if (!isset($img))
        $img = $m['covers'][0]['uri'];
    ?>
      <div class="item ">
        <div class="image">
          <img src= <?php echo "\"$img \""?> >
          <a class="like ui corner label"> <!-- ADD LIKE IF CLICKED -->
            <i class="like icon"></i>
          </a>
        </div>
        <div class="content">
          <div class="name"><?php echo $m['object']['name']?></div>
          <div class="extra">
              <?php echo $m['object']['like_count'].' likes | rating '.$m['rating']; ?>
          </div>
        </div>
      </div>
    <?php } ?>

    </div> <!-- end items -->

    <!--//BY GENRE-->

    <h2 class="ui dividing header">Top 5 by genre</h2>

    <div class="ui items"> <!-- items-->

    <?php


    foreach ($best_by_genres as $m){
      foreach ($m['object']['covers'] as $c){
        if ($c['type'] == 'native')
          $img = $c['uri'];
      }
      if (!isset($img))
        $img = $m['covers'][0]['uri'];
    ?>
      <div class="item ">
        <div class="image">
          <img src= <?php echo "\"$img \""?> >
          <a class="like ui corner label"> <!-- ADD LIKE IF CLICKED -->
            <i class="like icon"></i>
          </a>
        </div>
        <div class="content">
          <div class="name"><?php echo $m['object']['name']?></div>
          <div class="extra">
              <?php echo $m['object']['like_count'].' likes | rating: '.$m['rating']; ?>
          </div>
        </div>
      </div>
    <?php } ?>

    </div> <!-- end items -->

  </div> <!-- endcontent -->
  </body>
</html>
