<?PHP

require_once('get_lists.php');
if (!isset($_SESSION))
  session_start();

$res = get_lists($_SESSION['auth_token']);
$towatch = $res['towatch'];
$last_watched = $res['last_watched'];


$towatch = array();
$last_watched = array();

$rest_client = new RESTClient;
$json = $rest_client->get('api/v1/content/?auth_token='.$_SESSION['auth_token']);
$contents = json_decode($json, true);
$movies = array();

foreach ($contents['contents'] as $key => $value) {
  if ($value['type'] == "VideoContent" && isset($value['media_type']) && $value['media_type'] == "episode")
    $episodes[] = array(
      'episode' => $value,
      'rating' => $value['media_metadata']['episode']['rating'],
      'img' => $value['covers'][0]['uri']);
}

sort_array_of_array($episodes, 'rating');
$best_by_rating = array_slice($episodes, 0, 10);

$shows = $best_by_rating;

function sort_array_of_array(&$array, $subfield)
{
    $sortarray = array();
    foreach ($array as $key => $row)
    {
        $sortarray[$key] = $row[$subfield];
    }
    array_multisort($sortarray, SORT_DESC, $array);
}


?>
<!DOCTYPE HTML>
<html>
  <?php include('header.php');?>
  <body>
    <img id="background" src="images/background-login.jpg">
  <?PHP include('menu.php') ?>

  <div id="content"> <!-- content -->
  <div id= "main-content">

    <div class="ui breadcrumb">
      <a href="./" class="section">Home</a>
      <div class="divider"> / </div>
      <div class="active section">Suggested series</div>
    </div>

    <!--//TOP 5-->
    <h2 class="ui dividing header">Top 5</h2>

    <div class="ui items"> <!-- items-->

    <?php
    foreach ($shows as $s){
    ?>
      <div class="item ">
        <div class="image">
          <img src= <?php echo " \"".$s['img']."\"";?> >
          <a class="like ui corner label"> <!-- ADD LIKE IF CLICKED -->
            <i class="like icon"></i>
          </a>
        </div>
        <div class="content">
          <div class="name"><?php echo $s['episode']['title']?></div>
          <div class="extra">
              <?php echo $s['episode']['like_count'].' likes | rating: '.$s['rating']; ?>
          </div>
        </div>
      </div>
    <?php } ?>

    </div> <!-- end items -->


    </div> <!-- end items -->

  </div> <!-- endcontent -->
  </body>
</html>
