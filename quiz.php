<?PHP
require_once('RESTClient.php');
require_once('get_lists.php');

if (!isset($_SESSION))
  session_start();

if (isset($_POST))
  var_dump($_POST);
?>
<!DOCTYPE HTML>
<html>
  <?php include('header.php');?>
    <script src="javascript/quiz.js"></script>
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
        <form action="#" method="POST">
          <div id="quiz" class="ui form" >

            <div class="grouped inline fields">
              How much time do you have?
              <div class="field" id ="question1">
                <div class="ui radio checkbox">
                  <input type="radio" name="time" value="1">
                  <label>An hour or less</label>
                </div>
              </div>
              <div class="field" id ="question1">
                <div class="ui radio checkbox">
                  <input type="radio" name="time" value="2">
                  <label>1-2 hours</label>
                </div>
              </div>
              <div class="field" id ="question1">
                <div class="ui radio checkbox">
                  <input type="radio" name="time" value="3">
                  <label>Allll daaayyyyy</label>
                </div>
              </div>
            </div>
          

            <div class="grouped inline fields">
              What snacks do you have?
              <div class="field" id ="question2">
                <div class="ui radio checkbox">
                  <input type="radio" name="snacks" value="3">
                  <label>Pizza</label>
                </div>
              </div>
              <div class="field" id ="question2">
                <div class="ui radio checkbox">
                  <input type="radio" name="snacks" value="3">
                  <label>Popcorn</label>
                </div>
              </div>
              <div class="field" id ="question2">
                <div class="ui radio checkbox">
                  <input type="radio" name="snacks" value="3">
                  <label>Icecream</label>
                </div>
              </div>
            </div>

            <div class="grouped inline fields">
               How's your day been so far?
              <div class="field" id ="question3">
                <div class="ui radio checkbox">
                  <input type="radio" name="mood" value="3">
                  <label>Chillaxed</label>
                </div>
              </div>
              <div class="field" id ="question3">
                <div class="ui radio checkbox">
                  <input type="radio" name="mood" value="3">
                  <label>OMG I can't even</label>
                </div>
              </div>
              <div class="field" id ="question3">
                <div class="ui radio checkbox">
                  <input type="radio" name="mood" value="3">
                  <label>Super-amazing-awesome :)</label>
                </div>
              </div>
            </div>

            <div class="grouped inline fields">
               I like movies from... 
              <div class="field" id ="question4">
                <div class="ui radio checkbox">
                  <input type="radio" name="date">
                  <label>Oldy-times</label>
                </div>
              </div>
              <div class="field" id ="question4">
                <div class="ui radio checkbox">
                  <input type="radio" name="date">
                  <label>the EIGHTIES</label>
                </div>
              </div>
              <div class="field" id ="question4">
                <div class="ui radio checkbox">
                  <input type="radio" name="date">
                  <label>2014 thank you</label>
                </div>
              </div>
            </div>

            <div class="grouped inline fields">
                What's the weather doing today?
              <div class="field" id ="question5">
                <div class="ui radio checkbox">
                  <input type="radio" name="temps">
                  <label>Sunny & warm</label>
                </div>
              </div>
              <div class="field" id ="question5">
                <div class="ui radio checkbox">
                  <input type="radio" name="temps">
                  <label>rain :(</label>
                </div>
              </div>
              <div class="field" id ="question5">
                <div class="ui radio checkbox">
                  <input type="radio" name="temps">
                  <label>Icy and cold</label>
                </div>
              </div>
            </div>

            <div class="grouped inline fields">
                How often do you agree with the critics opinions about films?
              <div class="field" id ="question6">
                <div class="ui radio checkbox">
                  <input type="radio" name="rating">
                  <label>All the time, it's like they're reading my mind...</label>
                </div>
              </div>
              <div class="field" id ="question6">
                <div class="ui radio checkbox">
                  <input type="radio" name="rating">
                  <label>I always disagree - it's their job to be mean!</label>
                </div>
              </div>
              <div class="field" id ="question6">
                <div class="ui radio checkbox">
                  <input type="radio" name="rating">
                  <label>I don't read critics</label>
                </div>
              </div>
            </div>

             <div class="grouped inline fields">
                Do you fancy a change?
              <div class="field" id ="question7">
                <div class="ui radio checkbox">
                  <input type="radio" name="change">
                  <label>Yes</label>
                </div>
              </div>
              <div class="field" id ="question7">
                <div class="ui radio checkbox">
                  <input type="radio" name="change">
                  <label>No</label>
                </div>
              </div>
              <div class="field" id ="question7">
                <div class="ui radio checkbox">
                  <input type="radio" name="change">
                  <label>What's one of them?</label>
                </div>
              </div>
            </div>
            <div class="ui button" value="OK" type="submit">
              Submit
            </div>
          </div>
        </form>
      </div>


          
            
         <!--  <div id ="question2">
            What snacks do you have?
          </div>
          <div id ="answers2">
            <div class="three fluid ui buttons">
              <div class="ui button">Pizza</div>
              <div class="ui button">Popcorn</div>
              <div class="ui button">Haribo</div>
            </div>
          </div>
          <div id ="question3">
            How's your day been so far?
          </div>
          <div id ="answers3">
            <div class="three fluid ui buttons">
              <div class="ui button">Chillaxed</div>
              <div class="ui button">OMG I can't even</div>
              <div class="ui button">Super-amazing-awesome :)</div>
            </div>
          </div>
          <div id ="question4">
            I like movies from... 
          </div>
          <div id ="answers4">
            <div class="three fluid ui buttons">
              <div class="ui button">Oldy-times</div>
              <div class="ui button">the EIGHTIES</div>
              <div class="ui button">2014 thank you</div>
            </div>
          </div>
          <div id ="question5">
            What's the weather doing today?
          </div>
          <div id ="answers5">
            <div class="three fluid ui buttons">
              <div class="ui button">Sunny & warm</div>
              <div class="ui button">rain :(</div>
              <div class="ui button">Icy and cold</div>
            </div>
          </div>
          <div id ="question7">
            How often do you agree with the critics opinions about films?
          </div>
          <div id ="answers6">
            <div class="three fluid ui buttons">
              <div class="ui button">All the time, it's like they're reading my mind...</div>
              <div class="ui button">I always disagree - it's their job to be mean!</div>
              <div class="ui button">I don't read critics</div>
            </div>
          </div>
          <div id ="question7">
            Do you fancy a change?
          </div>
          <div id ="answers7">
            <div class="three fluid ui buttons">
              <div class="ui button">Yes</div>
              <div class="ui button">No</div>
              <div class="ui button">What's one of them?</div>
            </div>
          </div> -->
        </div>
      </div> <!-- endcontent -->
    <?PHP } ?>
  </body>
</html>