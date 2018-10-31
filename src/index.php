<?php

$value = "World";
$servername = "mysql";
$username = "phpmyadmin";
$password = "phpmyadmin";

try {
    $db = new PDO("mysql:host=$servername;dbname=mydb", $username, $password);
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


$databaseTest = ($db->query('SELECT * FROM dockerSample'))->fetchAll(PDO::FETCH_OBJ);

?>

<html>
    <body>
        <h1>Hello, <?=$value?>!</h1>
        <?php foreach($databaseTest as $row):?>
            <p>Hello, <?=$row->name?></p>
        <?php endforeach;?>
    </body>
</html>