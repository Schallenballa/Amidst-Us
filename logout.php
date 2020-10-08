<?php
require_once 'header.php';

if (isset($_SESSION['user'])) {
    destroySession();
    echo "<br><div class='center'>You have been logged out. Please
    <a data-transition='slide' href='index.php'>click here</a>
    to refresh the screen.</div>";
}
else 
    echo "<div class='center'>You can't log out because you're not logged in</div>";

require_once 'footer.php';
?>
