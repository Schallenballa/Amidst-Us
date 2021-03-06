<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <meta http-equiv="refresh" content="5">
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <script src='javascript.js'></script>
  <link href="https://fonts.googleapis.com/css?family=Arsenal|Lora|Muli|Source+Sans+Pro|Playfair+Display&display=swap" rel="stylesheet">
  <link rel='stylesheet' href='css/styles.css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container">
    <div id="progressBar">
     <div id="progressBarFull"></div>
    </div>
  </div>
  <?php include 'injectables.php';?>
  <div id="name"></div>
  <?php
    if(array_key_exists('c_t_1', $_POST)) {
      completeTask1($user);
      incrementScore();
    }

    if(array_key_exists('c_t_2', $_POST)) {
      completeTask2($user);
      incrementScore();
    }

    if(array_key_exists('c_t_3', $_POST)) {
      completeTask3($user);
      incrementScore();
    }

    if (!task1Done($user)){
        echo '<div id="task1" class="task"></div>';
        if (!getImp($user)){
          echo'
            <form method="post">
              <input style="background-color: #357564; height: 50px; margin-top: 1em; display: block; margin-right: auto; margin-left: auto;" type="submit" name="c_t_1"
                      class="newButton" value="Complete Task 1" />
            </form>
          ';
        }
    }
    else {
      echo '<div id="task1" class="task" hidden></div>';
    }

    if (!task2Done($user)){
      echo '<div id="task2" class="task"></div>';
      if (!getImp($user)){
        echo'
          <form method="post">
            <input style="background-color: #357564; height: 50px; margin-top: 1em; display: block; margin-right: auto; margin-left: auto;" type="submit" name="c_t_2"
                    class="newButton" value="Complete Task 2" />
          </form>
        ';
      }
    }
    else {
      echo '<div id="task2" class="task" hidden></div>';
    }

    if (!task3Done($user)){
      echo '<div id="task3" class="task"></div>';
      if (!getImp($user)){
        echo'

          <form method="post">
            <input style="background-color: #357564; height: 50px; margin-top: 1em; display: block; margin-right: auto; margin-left: auto;" type="submit" name="c_t_3"
                    class="newButton" value="Complete Task 3" />
          </form>
        ';
      }
    }
    else {
      echo '<div id="task3" class="task" hidden></div>';
    }
    echo '
      <hr style="padding-top: 1em;">
      <form method="post">
        <input style="background-color: #DA4423; height: 50px; margin-top: 1em; display: block; margin-right: auto; margin-left: auto;" type="submit" name="report"
                class="newButton" value="REPORT BODY" />
        <input style="background-color: #328BEA; height: 50px; margin-top: 1em; display: block; margin-right: auto; margin-left: auto;" type="submit" name="meeting"
                class="newButton" value="CALL MEETING" />
      </form>
    ';
  ?>


  <!--?php echo 'While this is going to be parsed.'; ?-->
  <?php $task1= getTask1Name($user); ?>
  <?php $task2= getTask2Name($user); ?>
  <?php $task3= getTask3Name($user); ?>
  <?php $pFull= getPFull(); ?>
  <?php $pCurrent= getPCurrent(); ?>
</body>


</html>



<script>
  var name = "<?php echo $user ?>";
  var task1 = "<?php echo $task1 ?>";
  var task2 = "<?php echo $task2 ?>";
  var task3 = "<?php echo $task3 ?>";
  var progressFull = "<?php echo $pFull ?>";
  var progressCurrent = "<?php echo $pCurrent ?>";

  document.getElementById("name").innerHTML = ("My name is: " + name);
  document.getElementById("task1").innerHTML = ("Task 1: " + task1);
  document.getElementById("task2").innerHTML = ("Task 2: " + task2);
  document.getElementById("task3").innerHTML = ("Task 3: " + task3);

  const progressBarFull = document.getElementById('progressBarFull');
  let taskCount = progressCurrent;
  const MAX_TASKS = (progressFull - 3);
  progressBarFull.style.width = `${(taskCount / MAX_TASKS) * 100}%`;
  //alert("A body has been discovered!");
</script>

<style>

  .task{
    padding-top: 1em;
    padding-bottom: 1em;
  }
  .taskComplete{
    height: 40px;
    width: 40px;
    border-radius: 50%;
  }

  #progressBar {
    width: 100%;
    height: 4rem;
    border: 0.3rem solid purple;
    margin-top: 1.5rem;
    background-color: #eee;
  }
  #progressBarFull {
    height: 4rem;
    background-color: purple;
    width: 0%;
  }

</style>
