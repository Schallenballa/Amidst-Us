<?php
require_once 'header.php';

if (!$loggedin)
    die("</div></body></html>");

if (isset($_GET['view']))
    $view = sanitizeString($_GET['view']);
else
    $view = $user;

if ($view == $user) {
    $name1 = $name2 = "Your";
    $name3 =          "You are";
}
else {
    $name1 = "<a data-transition='slide'
    href='members.php?view=$view'>$view</a>'s";
    $name2 = "$view's";
    $name3 = "$view is";
}

// showProfile($view);

$followers = array();
$following = array();

$result = queryMysql("SELECT * FROM friends WHERE user='$view'");
$num    = $result->num_rows;

for ($j = 0 ; $j < $num ; ++$j) {
    $row           = $result->fetch_array(MYSQLI_ASSOC);
    $followers[$j] = $row['friend'];
}

$result = queryMysql("SELECT * FROM friends WHERE friend='$view'");
$num    = $result->num_rows;

for ($j = 0 ; $j < $num ; ++$j) {
    $row           = $result->fetch_array(MYSQLI_ASSOC);
    $following[$j] = $row['user'];
}

$mutual    = array_intersect($followers, $following);
$followers = array_diff($followers, $mutual);
$following = array_diff($following, $mutual);
$friends   = FALSE;

if (sizeof($mutual)) {
    echo "<h3>$name2 mutual friends</h3><ul>";
    foreach($mutual as $friend)
    echo "<li style=\"list-style-type: none;\"><a href='members.php?view=$friend'>$friend</a>", "<p>  </p>", showProfile($friend);
    echo "</ul>";
    $friends = TRUE;
}

if (sizeof($followers)) {
    echo "<h3>$name2 followers</h3><ul>";
    foreach($followers as $friend)
    echo "<li style=\"list-style-type: none;\"><a href='members.php?view=$friend'>$friend</a>", "<p>  </p>", showProfile($friend);
    echo "</ul>";
    $friends = TRUE;
}

if (sizeof($following)) {
    echo "<h3>$name3 following</h3><ul>";
    foreach($following as $friend)
    echo "<li style=\"list-style-type: none;\"><a href='members.php?view=$friend'>$friend</a>", "<p>  </p>", showProfile($friend);
    echo "</ul>";
    $friends = TRUE;
}

if (!$friends)
    echo "<br>You don't have any friends, loser.";

require_once 'footer.php';
?>
