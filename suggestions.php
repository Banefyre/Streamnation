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
  if ($contents['content']['playback_available'] == true){
    $towatch[] = array(
      'object' => $movie,
      'rating_actor' => 0,
      'rating_genre' => 0,
      'rating' => 0,
      'rating_total' => 0);
  }
  if ($contents['content']['watched'] == true ){
    $last_watched[] = $movie;
    echo $movie['name'];
  }
}
///
$movies = array(); // FILL THIS WITH TOP 5
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
    <?PHP if (!isset($_SESSION['auth_token']))
    {
    ?>
      <div id="login-form" class="main container">
        <div class="ui form segment">
          <div class="field">
            <label>Username</label>
            <div class="ui left labeled icon input">
              <input id="login" type="text" placeholder="Username">
              <i class="user icon"></i>
              <div class="ui corner label">
                <i class="icon asterisk"></i>
              </div>
            </div>
          </div>
          <div class="field">
            <label>Password</label>
            <div class="ui left labeled icon input">
              <input id="password" type="password">
              <i class="lock icon"></i>
              <div class="ui corner label">
                <i class="icon asterisk"></i>
              </div>
            </div>
          </div>
          <div class="ui error message">
            <div class="header">We noticed some issues</div>
          </div>
          <div class="ui blue submit button" id="login-button">Login</div>
        </div>
      <div>
    </div>
  <?PHP }else{ include('menu.php');?>

  <div id="content"> <!-- content -->
  <div id= "main-content">
    <div class="ui steps">
      <div class="ui step">
        Files
      </div>
      <div class="ui step">
        Series
      </div>
      <div class="ui active step">
        Games of Throne
      </div>
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
    ?>
      <div class="item ">
        <div class="image">
          <img src= <?php echo "\"$img \""?> >
          <a class="like ui corner label"> <!-- ADD LIKE IF CLICKED -->
            <i class="like icon"></i>
          </a>
        </div>
        <div class="content">
          <div class="name"><?php echo $m['name'] ?></div>`
          <div class="extra">
              <?php echo $m['like_count'] ?> likes
          </div>
        </div>
      </div>
    <?php } ?>

    </div> <!-- end items -->

  </div> <!-- endcontent -->
  <?PHP } ?>
  </body>
</html>
