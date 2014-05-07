<?PHP
require_once('RESTClient.php');
require_once('get_lists.php');

if (!isset($_SESSION))
  session_start();
?>
<!DOCTYPE HTML>
<html>
  <?php include('header.php');?>
    <script src="javascript/quiz.js"></script>
  <body>
    <img id="background" src="images/background-login.jpg">

    <?PHP include('menu.php');?>
      <div id="content"> <!-- content -->



          <div id="quiz" class="ui form" >

            <div class="grouped inline fields">
              How much time do you have?
              <div class="field" id ="question1">
                <div class="ui radio checkbox">
                  <input type="radio" name="time" value="1" id="duration_low">
                  <label>An hour or less</label>
                </div>
              </div>
              <div class="field" id ="question1">
                <div class="ui radio checkbox">
                  <input type="radio" name="time" value="2" id="duration_medium">
                  <label>1-2 hours</label>
                </div>
              </div>
              <div class="field" id ="question1">
                <div class="ui radio checkbox">
                  <input type="radio" name="time" value="3" id="duration_low">
                  <label>Allll daaayyyyy</label>
                </div>
              </div>
            </div>


            <div class="grouped inline fields">
              What snacks do you have?
              <div class="field" id ="question2">
                <div class="ui radio checkbox">
                  <input type="radio" name="snacks" value="3" id="pizza">
                  <label>Pizza</label>
                </div>
              </div>
              <div class="field" id ="question2">
                <div class="ui radio checkbox">
                  <input type="radio" name="snacks" value="3" id="popcorn">
                  <label>Popcorn</label>
                </div>
              </div>
              <div class="field" id ="question2">
                <div class="ui radio checkbox">
                  <input type="radio" name="snacks" value="3" id="icecream">
                  <label>Icecream</label>
                </div>
              </div>
            </div>

            <div class="grouped inline fields">
               How's your day been so far?
              <div class="field" id ="question3">
                <div class="ui radio checkbox">
                  <input type="radio" name="mood" value="3" id="chillaxed">
                  <label>Chillaxed</label>
                </div>
              </div>
              <div class="field" id ="question3">
                <div class="ui radio checkbox">
                  <input type="radio" name="mood" value="3" id="omg">
                  <label>OMG I can't even</label>
                </div>
              </div>
              <div class="field" id ="question3">
                <div class="ui radio checkbox">
                  <input type="radio" name="mood" value="3" id="amazing">
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
                  <input type="radio" name="rating" id="yes">
                  <label>All the time, it's like they're reading my mind...</label>
                </div>
              </div>
              <div class="field" id ="question6">
                <div class="ui radio checkbox">
                  <input type="radio" name="rating" id="no">
                  <label>I always disagree - it's their job to be mean!</label>
                </div>
              </div>
              <div class="field" id ="question6">
                <div class="ui radio checkbox">
                  <input type="radio" name="rating" id="ok">
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
            <div class="ui button" id="send_quiz">
              Submit
            </div>
          </div>

      <br />
      <div id="loader" style="display:none;">
        <i class="huge loading icon"></i>
      </div>

      <div class="ui items" id="res" style="display:none;"> <!-- items-->
        <div class="item">
          <div class="image">
            <img id="res_img" src=".">
            <a class="like ui corner label"> <!-- ADD LIKE IF CLICKED -->
              <i class="like icon"></i>
            </a>
          </div>
          <div class="content">
            <div id ="res_name" class="name">Name</div>
            <div class="extra" id="res_likes">
                likes
            </div>
          </div>
        </div>
      </div>


      </div>




        </div>
      </div> <!-- endcontent -->
  </body>
</html>
