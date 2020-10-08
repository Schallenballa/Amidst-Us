<?php
session_start();
require_once 'header.php';

echo "<link rel='stylesheet' href='css/styles.css'>";
echo "<h3>Welcome to $clubstr. </h3>";
echo "<div>";

if ($loggedin)
    echo " $user, you are logged in";
else
    echo 'Please sign up, or log in if you\'re already a member.';

echo <<<_END
    </div><br>
_END;

require_once 'footer.php';
?>
