<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Database Setup</title>
</head>

<body>
    <h3>Setting up...</h3>

<?php
require_once 'functions.php';

createTable('members',
            'user VARCHAR(16),
            pass VARCHAR(16),
            imp VARCHAR(1),
            task1 VARCHAR(1),
            task2 VARCHAR(1),
            task3 VARCHAR(1),
            task1Complete VARCHAR(1),
            task2Complete VARCHAR(1),
            task3Complete VARCHAR(1),
            INDEX(user(6))');

createTable('messages',
            'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            auth VARCHAR(16),
            recip VARCHAR(16),
            pm CHAR(1),
            time INT UNSIGNED,
            message VARCHAR(4096),
            INDEX(auth(6)),
            INDEX(recip(6))');

createTable('friends',
            'user VARCHAR(16),
            friend VARCHAR(16),
            INDEX(user(6)),
            INDEX(friend(6))');

createTable('profiles',
            'user VARCHAR(16),
            text VARCHAR(4096),
            INDEX(user(6))');

createTable('tasks',
            'name VARCHAR(60),
            id VARCHAR(2),
            INDEX(name(6))');

createTable('score',
            'name VARCHAR(60),
            score INT(3),
            numPlayers INT(2),
            INDEX(name(6))');

queryMysql("INSERT INTO score VALUES('SCORE', 0, 0)");
queryMysql("INSERT INTO tasks VALUES('this is the first task', '1')");
queryMysql("INSERT INTO tasks VALUES('this is the second task', '2')");
queryMysql("INSERT INTO tasks VALUES('this is the third task', '3')");
queryMysql("INSERT INTO tasks VALUES('this is the fourth task', '4')");
?>

    <p>The database is ready to go.</p>
</body>
</html>
