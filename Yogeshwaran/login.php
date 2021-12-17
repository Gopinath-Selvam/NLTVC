<?php
include("config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // username and password sent from form 

  $username = mysqli_real_escape_string($userdb, $_POST['username']);
  $password = mysqli_real_escape_string($userdb, $_POST['password']);

  $sql = "SELECT number FROM login WHERE username = '$username' and password = '$password'";
  $result = mysqli_query($userdb, $sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $active = $row['active'];

  $count = mysqli_num_rows($result);

  // If result matched $myusername and $mypassword, table row must be 1 row


  if ($count == 1) {

    $_SESSION['login_user'] = $username;
    $alert = "<script> 
        alert('LOGIN SUCCESSFUL');
        window.location.href='rating.php';
        </script>";
    echo $alert;


  } else {

    header("Location: login.php");
    echo $alert;
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="login.css">
</head>

<body style="background-image: url('bg.jpg')">

  <form name="myForm" onsubmit="return validateForm()" method="post" class="container">
    <center>
      <h1>LOGIN</h1>
    </center>
    <center>
      <b>USERNAME</b> <input type="text" name="username" placeholder="username">
      <br>
      <b>PASSWORD </b> <input type="password" placeholder="Password" name="password"><br>
      <br>
    </center>
    <br>
    <br>
    <center> <button type="submit" class="btn">LOGIN</button></center>
  </form>
  <script>
    function validateForm() {
      var f = document.forms["myForm"]["username"].value;
      if (f == "") {
        alert("Username must be entered !!");
        return false;
      }

      var g = document.forms["myForm"]["password"].value;
      if (g == "") {
        alert("Password required !!");
        return false;
      }
      //  alert("Login Successful");

    }
  </script>

</body>

</html>