<?php
session_start();

$clubstr = 'Amidst Us';
if (isset($_SESSION['user'])) {
  $userstr = $_SESSION['user'];
}
else{
  $userstr = 'USER IS NOT LOGGED IN';
}


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

function getTask(){
  $result = queryMysql("SELECT name FROM tasks ORDER BY RAND() LIMIT 1;");
  $row=$result->fetch_assoc();
  $id=$row['name'];
  return $id;
}

if (isset($_SESSION['user'])) {
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr  = "Logged in as: $user";
}
else $loggedin = FALSE;

echo <<<_HEADER_OPEN

    <body>
_HEADER_OPEN;

if ($loggedin) {
echo <<<_LOGGEDIN


_LOGGEDIN;
} else {
echo <<<_GUEST


_GUEST;
 }

echo <<<_HEADER_CLOSE

_HEADER_CLOSE;

?>
