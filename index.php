<?PHP
  session_start();
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
      <div class="item">
        <div class="image">
          <img src="/images/demo/highres.jpg">
          <a class="like ui corner label">
            <i class="like icon"></i>
          </a>
        </div>
        <div class="content">
          <div class="name">Title</div>
          <p class="description">Description</p>
          <div class="extra">
              XX likes
          </div>
        </div>
      </div>

        <div class="item">
          <div class="image">
            <img src="/images/demo/highres.jpg">
            <a class="like ui corner label">
              <i class="like icon"></i>
            </a>
          </div>
          <div class="content">
            <div class="name">Title</div>
            <p class="description">Description</p>
            <div class="extra">
                XX likes
            </div>
          </div>
        </div>

          <div class="item">
            <div class="image">
              <img src="/images/demo/highres.jpg">
              <a class="like ui corner label">
                <i class="like icon"></i>
              </a>
            </div>
            <div class="content">
              <div class="name">Title</div>
              <p class="description">Description</p>
              <div class="extra">
                  XX likes
              </div>
            </div>
          </div>

            <div class="item">
              <div class="image">
                <img src="/images/demo/highres.jpg">
                <a class="like ui corner label">
                  <i class="like icon"></i>
                </a>
              </div>
              <div class="content">
                <div class="name">Title</div>
                <p class="description">Description</p>
                <div class="extra">
                    XX likes
                </div>
              </div>
            </div>
    </div> <!-- end items -->

  </div> <!-- endcontent -->
  <?PHP } ?>
  </body>
</html>
