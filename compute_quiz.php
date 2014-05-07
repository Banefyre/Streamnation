<?PHP
require_once('get_lists.php');
if (!isset($_SESSION))
  session_start();

$res_genres = array ();
$duration = 5000000;

if (isset($_POST['duration']) && $_POST['duration'] > 0)
{
  $duration = $_POST['duration'];
}

if (isset($_POST['pizza']) && $_POST['pizza'] == 1)
{

  $res_genres[] = "Action";
  $res_genres[] = "Adventure";
  $res_genres[] = "Annimation";
  $res_genres[] = "Comedy";
  $res_genres[] = "Thriller";
  $res_genres[] = "Suspense";
  $res_genres[] = "Horror";
  $res_genres[] = "Science Fiction";
  $res_genres[] = "Fantasy";
}

if (isset($_POST['popcorn']) && $_POST['popcorn'] == 1)
{

  $res_genres[] = "Action";
  $res_genres[] = "Adventure";
  $res_genres[] = "Comedy";
}

if (isset($_POST['icecream']) && $_POST['icecream'] == 1)
{

  $res_genres[] = "Drama";
  $res_genres[] = "Romance";
}

if (isset($_POST['chillaxed']) && $_POST['chillaxed'] == 1)
{

  $res_genres[] = "Action";
  $res_genres[] = "Adventure";
  $res_genres[] = "Annimation";
  $res_genres[] = "Horor";
  $res_genres[] = "Suspence";
  $res_genres[] = "Thriller";
}

if (isset($_POST['omg']) && $_POST['omg'] == 1)
{

  $res_genres[] = "Comedy";
  $res_genres[] = "Romance";
}

if (isset($_POST['amazing']) && $_POST['amazing'] == 1)
{

  $res_genres[] = "Science Fiction";
  $res_genres[] = "Fantasy";
}

$res = get_lists($_SESSION['auth_token']);
$towatch = array();
$towatch = $res['towatch'];
$last_watched = $res['last_watched'];



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
  if (isset($_POST['critic']) && $_POST['critic'] == 'yes')
    $critic = $movie['object']['rating'];
  else if (isset($_POST['critic']) && $_POST['critic'] == 'ok')
    $critic = $movie['object']['rating'] / 2;
  else if (isset($_POST['critic']) && $_POST['critic'] == 'no')
    $critic = 1;
  else
    $critic = $movie['object']['rating'] / 2;
  $towatch[$key]['rating_total'] = (($movie['rating_actor'] / 2 + $movie['rating_genre'])
                                  * $movie['object']['rating']) * ($movie['rating_date']);
}


sort_array_of_array($towatch, 'rating_total');

function sort_array_of_array(&$array, $subfield)
{
    $sortarray = array();
    foreach ($array as $key => $row)
    {
        $sortarray[$key] = $row[$subfield];
    }
    array_multisort($sortarray, SORT_DESC, $array);
}

if ($duration)
{
  foreach ($towatch as $key => $movie)
  {
    foreach ($movie['object']['contents'] as $content)
    {
      if ($content['duration'] > $duration)
      {
        unset($towatch[$key]);
      }
    }
  }
}


if (count($res_genres))
{
  foreach ($towatch as $key => $movie)
  {
    $found = 0;
    foreach ($movie['object']['genres'] as $g)
    {
      if (in_array($g, $res_genres))
      {
        $found = 1;
      }
    }
    if (!$found)
    {
      unset($towatch[$key]);
    }
  }
}


$movies = array_slice($towatch, 0, 5);

$rand = rand(0, 4);
$i = 0;
foreach ($towatch as $m)
{
  if ($i == $rand)
    echo (json_encode($m));
  $i++;
}

?>
