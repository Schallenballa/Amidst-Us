<?php
require_once 'header.php';

if (!$loggedin) {
    echo "<h3>Log in to view page</h3>";
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
  <h4 class="centered">Other Members</h4>
';
echo showProfile($view);
echo "<a class='button' href='messages.php?view=$view'>Start Game</a>";
echo "</body>";
die(require 'footer.php');

require_once 'footer.php';
?>
