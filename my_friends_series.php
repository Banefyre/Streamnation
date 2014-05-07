<?PHP
require_once('RESTClient.php');
if (!isset($_SESSION))
  session_start();

$rest_client = new RESTClient;
$json = $rest_client->get('api/v1/shows?auth_token='.$_SESSION['auth_token']);
$contents2 = json_decode($json, true);
$movies = array();
$test = array();
foreach ($contents2['shows'] as $key => $string) {
  if ($string['seasons']['0']['episodes']['0']['contents']["0"]['user']['id'] != $_SESSION['auth_id'])
    $test[] = $string;
}

$json = $rest_client->get('api/v1/library/shared?auth_token='.$_SESSION['auth_token']);
$contents = json_decode($json, true);
$movies = array();
$files = array();

foreach ($test as $key => $show) {

$json2 = $rest_client->get('api/v1/content/'.$show['seasons']['0']['episodes']['0']['content_ids']['0'].'?auth_token='.$_SESSION['auth_token']);
$contents2 = json_decode($json2, true);

foreach ($contents2 as $key => $value) {
  if ($value['type'] == "VideoContent" && isset($value['media_type']) && $value['media_type'] == "episode")
    array_push($movies, $value);
  }
}

?>
<!DOCTYPE HTML>
<html>
  <!--<?php include('header.php')?> -->
  <body>
    <img id="background" src="images/background-login.jpg">

  <?PHP include('menu.php'); ?>

  <div id="content"> <!-- content -->
  <div id= "main-content">


    <div class="ui breadcrumb">
      <a href="./" class="section">Home</a>
      <div class="divider"> / </div>
      <div class="active section">My Series</div>
    </div>

    <div class="ui tertiary form segment">
      <div class="field">
        <div class="ui left labeled icon input">
          <i class="search icon"></i>
          <input type="text" placeholder="Search">
        </div>
      </div>

    </div>
    <div class="ui items"> <!-- items-->

    <?php
    foreach ($movies as $m){
      foreach ($m['covers'] as $c){
        if ($c['type'] == 'native')
          $img = $c['uri'];
      }
      if (!isset($img))
        $img = $m['covers'][0]['uri'];
      $dispo = $m['playback_available'];
    ?>
      <div class="item">
        <div class="image">
          <img src= <?php echo "\"$img \""?> >
          <a class="like ui corner label"> <!-- ADD LIKE IF CLICKED -->
            <i class="like icon"></i>
          </a>
        </div>
        <div class="content">
          <div class="name"><?php echo $m['title'] ?></div>
          <p class="description"><?php echo $m['media_metadata']['show']['overview'] ?></p>
          <div class="extra">
              <?php echo $m['like_count'] ?> likes
          </div>
        </div>
      </div>
    <?php } ?>

    </div> <!-- end items -->

  </div> <!-- endcontent -->
  </body>
</html>
