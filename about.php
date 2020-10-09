<?php
require_once 'header.php';

echo "<h2>About Page</h2>";
echo "<p>This is the about page.</p>";
echo "<p>Below is a description of what each page does:</p>";
echo "<h3><a class='button' href='home.php?view=$user'>Home</a></h3>";
echo "<ul><li>Home shows you your profile and allows you to click a button to view your messages</li></ul>";
echo "<h3><a class='button' href='home.php'>Home</a></h3>";
echo "<ul><li>Home shows a list of all the current members of the site. You can click on their names to follow them or leave a message</li></ul>";
echo "<h3><a class='button' href='friends.php'>Friends</a></h3>";
echo "<ul><li>Friends is a page that will show you your current relation with others on the website (in terms of mutual friends, followers, or following)</li></ul>";
echo "<h3><a class='button' href='messages.php'>Messages</a></h3>";
echo "<ul><li>Messages allows you to view along with post any Public/Private messages to your profile's board. Others' messages will also appear here</li></ul>";
echo "<h3><a class='button' href='profile.php'>Edit Profile</a></h3>";
echo "<ul><li>Edit Profile allows for you to edit your bio and change your profile photo</ul></li>";
echo "<h3><a class='button' href='playground.php'>Playground</a></h3>";
echo "<ul><li>Playground is a fun and wacky place for you to view CSS animations and interact with the page</li></ul>";

require_once 'footer.php';
?>
