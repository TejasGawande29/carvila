<link rel="stylesheet" href="CSS/bootstrap.min.css">
<link rel="stylesheet" href="CSS/carvas.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<div id="container">

  <div class="element" id="box1"> <a href="index.php"><img src="img/logocarvila.webp" alt="" width="100px" height="70px"></a></div>
  <div class="element" id="box2"> <a href="">HOME</a></div>
  <div class="element" id="box3"><a href="">SERVICE</a> </div>
  <div class="element" id="box4"> <a href="">FEATURED CARDS</a></div>
  <div class="element" id="box5"> <a href="">NEW CARS</a></div>
  <div class="element" id="box6"> <a href="">BRANDS</a></div>
  <div class="element" id="box7"> <a href="">CONTACT</a></div>

  <?php
  session_start();
  if (isset($_SESSION["LOGIN"]) && $_SESSION["LOGIN"]) {
    echo "Welcome " . $_SESSION["USERNAME"];
    echo "<button class='btn btn-danger' style='width:6%; margin-top: 24px; margin-right: 28px; margin-bottom: 40px; font-size: 22px; ' onclick='redirectToLogout();'>Logout</button>";
  } else {

  ?>

    <button class="btn btn-danger" style="width:6%; margin-top: 24px; margin-right: 28px; margin-bottom: 40px; font-size: 22px; " onclick="redirectToLogin();">Login</button>
  <?php
  }
  ?>
</div>
<script>
  function redirectToLogin() {
    window.location.href = "login.php"
  }

  function redirectToLogout(){
    window.location.replace("logout.php");
  }
</script>