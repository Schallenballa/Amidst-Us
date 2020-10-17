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

function completeTask1($name){
  queryMysql("UPDATE members SET task1Complete = '1' WHERE user='$name'");
}

function completeTask2($name){
  queryMysql("UPDATE members SET task2Complete = '1' WHERE user='$name'");
}

function completeTask3($name){
  queryMysql("UPDATE members SET task3Complete = '1' WHERE user='$name'");
}

function task1Done($name){
  $result = queryMysql("SELECT task1Complete FROM members WHERE user='$name'");
  $row=$result->fetch_assoc();
  $id=$row['task1Complete'];
  if ($id == 1){
    return true;
  }
  else{
    return false;
  }
}

function task2Done($name){
  $result = queryMysql("SELECT task2Complete FROM members WHERE user='$name'");
  $row=$result->fetch_assoc();
  $id=$row['task2Complete'];
  if ($id == 1){
    return true;
  }
  else{
    return false;
  }
}

function task3Done($name){
  $result = queryMysql("SELECT task3Complete FROM members WHERE user='$name'");
  $row=$result->fetch_assoc();
  $id=$row['task3Complete'];
  if ($id == 1){
    return true;
  }
  else{
    return false;
  }
}

function getTask1Name($name){
  $taskID = queryMysql("SELECT task1 FROM members WHERE user='$name'");
  $row1=$taskID->fetch_assoc();
  $id1=$row1['task1'];
  $result = queryMysql("SELECT name FROM tasks WHERE id='$id1'");
  $row2=$result->fetch_assoc();
  $id2=$row2['name'];
  return $id2;
}

function getTask2Name($name){
  $taskID = queryMysql("SELECT task2 FROM members WHERE user='$name'");
  $row1=$taskID->fetch_assoc();
  $id1=$row1['task2'];
  $result = queryMysql("SELECT name FROM tasks WHERE id='$id1'");
  $row2=$result->fetch_assoc();
  $id2=$row2['name'];
  return $id2;
}

function getTask3Name($name){
  $taskID = queryMysql("SELECT task3 FROM members WHERE user='$name'");
  $row1=$taskID->fetch_assoc();
  $id1=$row1['task3'];
  $result = queryMysql("SELECT name FROM tasks WHERE id='$id1'");
  $row2=$result->fetch_assoc();
  $id2=$row2['name'];
  return $id2;
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
