<div class="ui large vertical inverted labeled icon sidebar menu active" id="menu">
<a class="item" href="#">
  <i class="inverted circular green home icon"></i>
  <?PHP echo $_SESSION['auth_username']; ?>
</a>

<a class="item" href="#">
  <i class="inverted circular blue awesome upload cloud icon"></i>
</a>

<div class="item">
    <b>My storage</b>
  <div class="menu">

      <a class="item" href="#"><i class="folder outline icon"></i>My Files</a>

      <a class="item" href="#"><i class="video icon"></i>My films</a>

      <a class="item" href="#"><i class="video icon"></i>My series</a>

      <a class="item" href="#"><i class="photo icon"></i>My photos</a>

  </div>
</div>
<a class="item" href="#">
  <i class="moon icon"></i>What for tonight ?
</a>
<div class="item">
  <b>Friends</b>
  <div class="menu">

      <a class="item" href="#"><i class="user icon"></i>View Friends</a>

      <a class="item" href="#"><i class="folder outline icon"></i>My Friends Files</a>

      <a class="item" href="#"><i class="video icon"></i>My Friends Movies</a>

      <a class="item" href="#"><i class="video icon"></i>My Friends Series</a>

      <a class="item" href="#"><i class="photo icon"></i>My Friends Photos</a>

  </div>
</div>
<a class="item" id="logout-conf">
  <i class="red awesome off icon"></i> <b>Logout</b>
</a>


<div class="ui small modal">
  <i class="close icon"></i>
  <div class="header">
    Lougout
  </div>
  <div class="content">
    <p>Are you sure you want to logout ?</p>
  </div>
  <div class="actions">
    <div class="ui negative button">
      No
    </div>
    <a href="logout.php">
    <div class="ui positive right labeled icon button logout-button">

      Yes
      <i class="checkmark icon"></i>

    </div>
  </a>
  </div>
</div>

</div>