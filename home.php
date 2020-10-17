<?php
require_once 'header.php';

if (!$loggedin) {
    echo "<h3>Log in to view page</h3>";
    die(require 'footer.php');
}

if(array_key_exists('imp_set', $_POST)) {
            imp_set();
            echo "<p class='centerd animated_blur_out' style='color: #333; position: absolute;'>The Imposter has been set...</p>";
}

function imp_set(){
  $view = sanitizeString($_GET['view']);
  $name = "$view";
  queryMysql("UPDATE members SET imp = '0' WHERE 1=1");
  queryMysql("
  UPDATE members
  SET imp = '1'
  WHERE 1=1
  ORDER BY RAND()
  LIMIT 1;
  ");
  queryMysql("UPDATE members SET task1 = '0' WHERE 1=1");
  queryMysql("UPDATE members SET task2 = '0' WHERE 1=1");
  queryMysql("UPDATE members SET task3 = '0' WHERE 1=1");
  queryMysql("UPDATE members SET task1Complete = '0' WHERE 1=1");
  queryMysql("UPDATE members SET task2Complete = '0' WHERE 1=1");
  queryMysql("UPDATE members SET task3Complete = '0' WHERE 1=1");
  $rowCount = getRows();
  queryMysql("
  UPDATE members
  SET task1 = (RAND()*('$rowCount'-1)+1)
  WHERE 1=1;
  ");
  queryMysql("
  UPDATE members
  SET task2 = (RAND()*('$rowCount'-1)+1)
  WHERE 1=1;
  ");
  queryMysql("
  UPDATE members
  SET task3 = (RAND()*('$rowCount'-1)+1)
  WHERE 1=1;
  ");

  //The following code makes sure no one has duplicate tasks
  $result = queryMysql("SELECT * FROM members WHERE 1=1");
  $following = array();
  $num    = $result->num_rows;
  for ($j = 0 ; $j < $num ; ++$j) {
      $row           = $result->fetch_array(MYSQLI_ASSOC);
      $following[$j] = $row['user'];
  }
  foreach($following as $friend){
    $name = "$friend";

    while ((getTask1($name) == getTask2($name)) || (getTask2($name) == getTask3($name)) || (getTask3($name) == getTask1($name))){
      //echo "<p>setting the tasks for $name</p>";
      //echo "<p>row count = $rowCount</p>";
      while (getTask1($name) == getTask2($name)){
        queryMysql("
        UPDATE members
        SET task1 = (RAND()*('$rowCount'-1)+1)
        WHERE user='$name';
        ");
      }
      while (getTask2($name) == getTask3($name)){
        queryMysql("
        UPDATE members
        SET task2 = (RAND()*('$rowCount'-1)+1)
        WHERE user='$name';
        ");
      }
      while (getTask3($name) == getTask1($name)){
        queryMysql("
        UPDATE members
        SET task3 = (RAND()*('$rowCount'-1)+1)
        WHERE user='$name';
        ");
      }
    }
  }




}

$view = sanitizeString($_GET['view']);
$name = "$view";

echo "<body>";
echo "<h3 class='centered'>$name</h3>";

if (getImp($view) == '1'){
  echo "<p class='centered animated_pop_right' style='color: red;'>YOU ARE THE IMPOSTER!</p>";
}
else{
  echo "<p class='centered animated_pop_right'>You are not an imposter</p>";
}

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
echo '


<form method="post">
        <input style="background-color: #fc2525; height: 50px; margin-top: 2em; display: block; margin-right: auto; margin-left: auto;" type="submit" name="imp_set"
                class="newButton" value="SET IMPOSTER & TASKS" />
</form>

';

echo "<a class='newButton' style='margin-top: 2em; display: block; margin-right: auto; margin-left: auto;' href='game.php?view=$user'>Join Lobby</a>";


echo "</body>";
die(require 'footer.php');

require_once 'footer.php';
?>
