<?php
$dbhost  = 'localhost';

$dbname  = 'db00';
$dbuser  = 'user00';
$dbpass  = '008926';


$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($connection->connect_error)
    die("Fatal Error 1");

function createTable($name, $query){
  queryMysql("DROP TABLE $name");
  queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
  echo "Table '$name' created or already exists.<br>";
}

function getRows(){
  $result = queryMysql("SELECT COUNT(*) FROM tasks");
  $row=$result->fetch_assoc();
  $id=$row['COUNT(*)'];
  return $id;
}

function getMemberRows(){
  $result = queryMysql("SELECT COUNT(*) FROM members");
  $row=$result->fetch_assoc();
  $id=$row['COUNT(*)'];
  return $id;
}

function getImp($name){
  $result = queryMysql("SELECT imp FROM members WHERE user='$name'");
  $row=$result->fetch_assoc();
  $id=$row['imp'];
  return $id;
}

function getTask1($name){
  $result = queryMysql("SELECT task1 FROM members WHERE user='$name'");
  $row=$result->fetch_assoc();
  $id=$row['task1'];
  return $id;
}

function getTask2($name){
  $result = queryMysql("SELECT task2 FROM members WHERE user='$name'");
  $row=$result->fetch_assoc();
  $id=$row['task2'];
  return $id;
}

function getTask3($name){
  $result = queryMysql("SELECT task3 FROM members WHERE user='$name'");
  $row=$result->fetch_assoc();
  $id=$row['task3'];
  return $id;
}

function queryMysql($query) {
    global $connection;
    $result = $connection->query($query);
    if (!$result) die("Fatal Error 2");
    return $result;
}

function destroySession() {
    $_SESSION=array();

    if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
}

function sanitizeString($var){
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    if (get_magic_quotes_gpc())
        $var = stripslashes($var);
    return $connection->real_escape_string($var);
}

function showDetailedProfile($user) {
    if (file_exists("userpics/$user.jpg"))
        echo "<img class='userpic' src='userpics/$user.jpg'>";

    $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");

    if ($result->num_rows) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo stripslashes($row['text']) . "<br style='clear:left;'><br>";
    }
    else echo "<p>Nothing to see here, yet</p><br>";
}

function showProfile($user) {
  if (file_exists("userpics/$user.jpg")){
      //echo "<img class='userpicSmall' src='userpics/$user.jpg'>";
      return "<img class='userpicSmall' src='userpics/$user.jpg'>";
  }
  else {
    //echo "<p> No profile photo found. Contact Zach or Payton if you are having trouble :(</p>";
    return "<p> No profile photo found for $user. Contact Zach or Payton if you are having trouble :(</p>";
  }
}

function showOtherProfile($user) {
  if (file_exists("userpics/$user.jpg")){
      //echo "<img class='userpicSmall' src='userpics/$user.jpg'>";
      return "<img class='userPicLeft' src='userpics/$user.jpg'>";
  }
  else {
    //echo "<p> No profile photo found. Contact Zach or Payton if you are having trouble :(</p>";
    return "<p> No profile photo found for $user. Contact Zach or Payton if you are having trouble :(</p>";
  }
}
?>
