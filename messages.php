<?php
require_once 'header.php';

if (!$loggedin)
    die("Log in for messages</div><footer></footer></body></html>");

if (isset($_GET['view'])) 
    $view = sanitizeString($_GET['view']);
else 
    $view = $user;

if (isset($_POST['text'])) {
    $text = sanitizeString($_POST['text']);

    if ($text != "") {
        $pm   = substr(sanitizeString($_POST['pm']),0,1);
        $time = time();
        queryMysql("INSERT INTO messages VALUES(NULL, '$user','$view', '$pm', $time, '$text')");
    }
}

if ($view != "") {
    if ($view == $user) 
        $name1 = $name2 = "Your";
    else {
        $name1 = "<a href='members.php?view=$view'>$view</a>'s";
        $name2 = "$view's";
  }

  echo "<h3>$name1 Messages</h3>";
  // showProfile($view);

  echo <<<_END
  <form method='post' action='messages.php?view=$view'>
    <fieldset data-role="controlgroup" data-type="horizontal">
        <legend>Type here to leave a message</legend>
        <input type='radio' name='pm' id='public' value='0' checked='checked'>
        <label for="public">Public Post</label>
        <input type='radio' name='pm' id='private' value='1'>
        <label for="private">Private Note</label><br><br>
        <textarea name='text'></textarea><br>
    </fieldset>

    <input data-transition='slide' type='submit' value='Post Message'>
</form><br>
_END;

date_default_timezone_set('UTC');

if (isset($_GET['erase'])) {
    $erase = sanitizeString($_GET['erase']);
    queryMysql("DELETE FROM messages WHERE id=$erase AND recip='$user'");
}

$query  = "SELECT * FROM messages WHERE recip='$view' ORDER BY time DESC";
$result = queryMysql($query);
$num    = $result->num_rows;

for ($j = 0 ; $j < $num ; ++$j)
{
  $row = $result->fetch_array(MYSQLI_ASSOC);

  if ($row['pm'] == 0 || $row['auth'] == $user || $row['recip'] == $user) {
      echo date('M jS \'y g:ia:', $row['time']);
      echo " <a href='messages.php?view=" . $row['auth'] . "'>" . $row['auth']. "</a> ";

      if ($row['pm'] == 0)
          echo "wrote a <em>public post</em>:<div>&quot;" . $row['message'] . "&quot; ";
      else
          echo "wrote a <em>private note</em>:<br><div>&quot;" . $row['message']. "&quot; ";

      if ($row['recip'] == $user)
          echo "[<a href='messages.php?view=$view" . "&erase=" . $row['id'] . "'>Delete</a>]";
      echo "</div>";
  }
}
}

if (!$num)
    echo "<br><span class='info'>No messages yet</span><br><br>";

echo "<br><a data-role='button' href='messages.php?view=$view'>Refresh messages</a>";

require_once 'footer.php';
?>