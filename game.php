<?php
require_once 'header.php';

if (!$loggedin) {
    echo "<h3>You have been logged out :(</h3>";
    die(require 'footer.php');
}

$view = sanitizeString($_GET['view']);
$name = "$view";

echo "<body>";
echo "<h3 class='centered'>$name</h3>";
echo "<div style='display: block;'>";
echo showProfile($view);
echo  "</div>";
echo '
  <hr>
  <h5 class="centered">Other Members</h5>
';

$result = queryMysql("SELECT * FROM members WHERE user!='$view'");
$following = array();
$num    = $result->num_rows;
for ($j = 0 ; $j < $num ; ++$j) {
    $row           = $result->fetch_array(MYSQLI_ASSOC);
    $following[$j] = $row['user'];
}
echo "<div class='otherUsers'>";
foreach($following as $friend){
  $name = "$friend";
  echo "<div style='border: 1px inset;'>";
  echo "<p class='centered'>$name</p>";
  echo showProfile($friend);
  echo "</div>";
}
echo "</div>";

echo "<a class='button' href='game.php'>Start Game</a>";
echo "</body>";
die(require 'footer.php');

require_once 'footer.php';
?>
