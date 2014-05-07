<?PHP
require_once('RESTClient.php');
if (!isset($_SESSION))
  session_start();

?>
<!DOCTYPE HTML>
<html>
  <?php include('header.php');?>
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
      <div> </div>
    <?PHP }else{ include('menu.php');?>
      <div id="content"> <!-- content -->
        <div id="quiz"> 
          <div id ="question1">
            A QUESTION ABOUT ACTORS
          </div>
          <div id ="answers1">
            <div class="three fluid ui buttons">
              <div class="ui button">One</div>
              <div class="ui button">Two</div>
              <div class="ui button">Three</div>
            </div>
          </div>
          <div id ="question2">
            A QUESTION ABOUT RATINGS
          </div>
          <div id ="answers2">
            <div class="three fluid ui buttons">
              <div class="ui button">One</div>
              <div class="ui button">Two</div>
              <div class="ui button">Three</div>
            </div>
          </div>
          <div id ="question3">
            A QUESTION ABOUT GENRE
          </div>
          <div id ="answers3">
            <div class="three fluid ui buttons">
              <div class="ui button">One</div>
              <div class="ui button">Two</div>
              <div class="ui button">Three</div>
            </div>
          </div>
          <div id ="question4">
            A QUESTION ABOUT DATE
          </div>
          <div id ="answers4">
            <div class="three fluid ui buttons">
              <div class="ui button">One</div>
              <div class="ui button">Two</div>
              <div class="ui button">Three</div>
            </div>
          </div>
          <div id ="question5">
            A QUESTION ABOUT NOTHING
          </div>
          <div id ="answers5">
            <div class="three fluid ui buttons">
              <div class="ui button">One</div>
              <div class="ui button">Two</div>
              <div class="ui button">Three</div>
            </div>
          </div>
          <div id ="question6">
            A QUESTION ABOUT SANDWICHES
          </div>
          <div id ="answers6">
            <div class="three fluid ui buttons">
              <div class="ui button">One</div>
              <div class="ui button">Two</div>
              <div class="ui button">Three</div>
            </div>
          </div>
          <div id ="question7">
            A QUESTION ABOUT SANDWICHES
          </div>
          <div id ="answers7">
            <div class="three fluid ui buttons">
              <div class="ui button">One</div>
              <div class="ui button">Two</div>
              <div class="ui button">Three</div>
            </div>
          </div>
        </div>
      </div> <!-- endcontent -->
    <?PHP } ?>
  </body>
</html>