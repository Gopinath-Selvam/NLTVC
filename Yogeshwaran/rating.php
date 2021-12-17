<?php
include("config.php");
session_start();
$username = mysqli_real_escape_string($ratingdb, $_SESSION['login_user']);

if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
    die();
}

$sql1 = "SELECT * FROM rating WHERE username = '$username'";
$sql2 = "SELECT AVG(rating) FROM rating";
$result1 = mysqli_query($ratingdb, $sql1);
$result2 = mysqli_query($ratingdb, $sql2);
$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
$row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
$_SESSION['rating'] = $row1['rating'];
$_SESSION['avg-rating'] = $row2['AVG(rating)'];

$rating = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
}

if (array_key_exists('submit', $_POST)) {
    $rating =  $_POST["hiddencontainer"];
    $sql3 = "UPDATE rating SET rating = '$rating', flag = 1 WHERE username = '$username'";
    $ratingdb->query($sql3);
    $result1 = mysqli_query($ratingdb, $sql1);
    $result2 = mysqli_query($ratingdb, $sql2);
    $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
    $_SESSION['rating'] = $row1['rating'];
    $_SESSION['avg-rating'] = $row2['AVG(rating)'];
}


if (array_key_exists('logout', $_POST)) {
    logout();
}

function logout()
{
    session_destroy();
    echo "<script> 
    window.location.href='login.php';
    </script>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>

<body style="background-image: url('bg.jpg')">

    <form class="container" method="post" onsubmit="return setRating()">
        <center>
            <p><?php echo "WELCOME {$_SESSION['login_user']}" ?></p>
        </center>
        <center>
            <div class="stars">
                <input class="star star-5" id="star-5" value="5" type="radio" name="star" /> <label class="star star-5" for="star-5"></label> <input class="star star-4" id="star-4" value="4" type="radio" name="star" /> <label class="star star-4" for="star-4"></label> <input class="star star-3" id="star-3" value="3" type="radio" name="star" /> <label class="star star-3" for="star-3"></label> <input class="star star-2" id="star-2" value="2" type="radio" name="star" /> <label class="star star-2" for="star-2"></label> <input class="star star-1" value="1" id="star-1" type="radio" name="star" /> <label class="star star-1" for="star-1"></label>
            </div>
        </center>
        <center>
            <p><?php echo "YOUR RATING: {$_SESSION['rating']}" ?></p>
        </center>
        <center>
            <p><?php echo "AVERAGE RATING: {$_SESSION['avg-rating']}" ?></p>
        </center>
        <center></center>
        <input type="hidden" id="hiddencontainer" name="hiddencontainer" />
        <center> <button type="submit" class="btn" name="submit">SUBMIT</button></center>
        <center> <button type="submit" class="btn" name="logout">LOGOUT</button></center>
    </form>

    <script>
        function setRating() {
            const star5 = document.getElementById("star-5").checked;
            const star4 = document.getElementById("star-4").checked;
            const star3 = document.getElementById("star-3").checked;
            const star2 = document.getElementById("star-2").checked;
            const star1 = document.getElementById("star-1").checked;
            var myhidden = document.getElementById("hiddencontainer");
            if (star5 === true) {
                myhidden.value = 5;
            } else if (star4 === true) {
                myhidden.value = 4;
            } else if (star3 === true) {
                myhidden.value = 3;
            } else if (star2 === true) {
                myhidden.value = 2;
            } else if (star1 === true) {
                myhidden.value = 1;
            }
            console.log(myhidden.value);
        }
    </script>
</body>

</html>