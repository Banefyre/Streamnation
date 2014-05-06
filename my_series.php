<?PHP
require_once('RESTClient.php');
if (!isset($_SESSION))
  session_start();

$rest_client = new RESTClient;
$json = $rest_client->get('api/v1/content/?auth_token='.$_SESSION['auth_token']);
$contents = json_decode($json, true);
$movies = array();

foreach ($contents['contents'] as $key => $value) {
  if ($value['type'] == "VideoContent" && isset($value['media_type']) && $value['media_type'] == "episode")
    $movies[] = $value;
}

?>
<!DOCTYPE HTML>
<html>
  <head>
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
