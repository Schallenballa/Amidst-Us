<?php
$dbhost  = 'localhost';

$dbname  = 'db00';
$dbuser  = 'user00';
$dbpass  = '008926';


$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($connection->connect_error)
    die("Fatal Error 1");

function createTable($name, $query){
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or already exists.<br>";
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
