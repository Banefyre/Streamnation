<?PHP
require_once('RESTClient.php');
if (!isset($_SESSION))
  session_start();

$rest_client3 = new RESTClient;
$json3 = $rest_client3->get('/api/v1/movies?auth_token='.$_SESSION['auth_token']);
$contents = json_decode($json3, true);
$test = array();
foreach ($contents['movies'] as $key => $string) {
  if ($string['contents']["0"]['user']['id'] != $_SESSION['auth_id'])
    $test[] = $string;
}

$rest_client = new RESTClient;
$json = $rest_client->get('api/v1/library/shared?auth_token='.$_SESSION['auth_token']);
$contents = json_decode($json, true);
$movies = array();
$files = array();

/*foreach ($contents['library'] as $key => $value) {
  if ($value['type'] == "VideoContent" && isset($value['media_type']) && $value['media_type'] == "movie")
    $movies[] = $value;
}*/

foreach ($test as $key => $movie) {

  $rest_client2 = new RESTClient;
  $json2 = $rest_client2->get('api/v1/content/'.$movie['content_ids']["0"].'?auth_token='.$_SESSION['auth_token']);
  $contents2 = json_decode($json2, true);

  foreach ($contents2 as $key => $value) {
    if ($value['type'] == "VideoContent" && isset($value['media_type']) && $value['media_type'] == "movie")
      array_push($movies, $value);
  }
}

?>
<!DOCTYPE HTML>
<html>

  <?php include('header.php');?>
  <body>
    <img id="background" src="images/background-login.jpg">

  <?PHP include('menu.php');?>

  <div id="content"> <!-- content -->
  <div id= "main-content">


  <div class="ui breadcrumb">
    <a href="./" class="section">Home</a>
    <div class="divider"> / </div>
    <div class="active section">My Films</div>
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
