<?php
session_start();

$clubstr = 'Amidst Us';
$userstr = 'Please Log In';

echo <<<_INIT
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <script src='javascript.js'></script>
        <link href="https://fonts.googleapis.com/css?family=Arsenal|Lora|Muli|Source+Sans+Pro|Playfair+Display&display=swap" rel="stylesheet">
        <link rel='stylesheet' href='css/styles.css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>$clubstr: $userstr</title>
        </head>
_INIT;

require_once 'functions.php';

if (isset($_SESSION['user'])) {
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr  = "Logged in as: $user";
}
else $loggedin = FALSE;

echo <<<_HEADER_OPEN

    <body>
        <div id="wrapper">
        <header>
            <div id='logo'>$clubstr</div>
_HEADER_OPEN;

if ($loggedin) {
echo <<<_LOGGEDIN

            <script>
            /* Toggle between showing and hiding the navigation menu links when the user clicks on the hamburger menu / bar icon */
            function myFunction() {
              var x = document.getElementById("myLinks");
              if (x.style.display === "block") {
                x.style.display = "none";
              } else {
                x.style.display = "block";
              }
            }
            </script>

            <!-- Top Navigation Menu -->
            <div class="topnav">
                <a href="home.php?view=$user" class="active">Home</a>
              <!-- Navigation links (hidden by default) -->
              <div id="myLinks">
                <a href="Home.php">Home</a>
                <a href="about.php">About</a>
                <a href="profile.php">Profile</a>
                <a class="logout" href="logout.php">Log Out</a>
              </div>
              <!-- "Hamburger menu" / "Bar icon" to toggle the navigation links -->
              <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
              </a>
            </div>

            <!--nav><ul>
                <li class="right-align" id="home"><a href='home.php?view=$user'>Home</a></li>
                <li class="right-align"><a href='profile.php'>Edit Profile</a></li>
                <li class="right-align"><a href='messages.php'>Messages</a></li>
                <li class="right-align"><a href='friends.php'>Friends</a></li>
                <li class="right-align"><a href='Home.php'>Home</a></li>
                <li class="right-align"><a href='logout.php'>Log out</a></li>
                <li class="right-align"><a href='about.php'>About</a></li>
                <li class="right-align"><a href='playground.php'>Playground</a></li>





            </ul></nav-->
_LOGGEDIN;
} else {
echo <<<_GUEST

            <nav><ul>
                <li><a href='index.php'>Home</a></li>
                <li><a href='signup.php'>Sign Up</a></li>
                <li><a href='login.php'>Log In</a></li>
            </ul></nav>
_GUEST;
 }

echo <<<_HEADER_CLOSE

        </header>
        <div class='username'>$userstr</div>
        <div id="content">
_HEADER_CLOSE;

?>
