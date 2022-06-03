<?php
//This code is designed to create a table into the database.

try {
//Connect to the db
$pdo = new PDO('mysql:host=localhost;dbname=joke','joke','T00R@123sultan');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//end of connect to db
$sql = 'CREATE TABLE JOKE (
        id INT NOT null AUTO_INCREMENT PRIMARY KEY,
        joketext TEXT,
        jokedate DATE NOT NULL

)DEFAULT CHARACTER SET utf8 ENGINE=InnoDB';
$pdo->exec($sql);

}//end try

 catch (PDOException $e) {

    $output = 'Error  creating joke table: '. $e->getMessage();
    include 'output.html.php';
    exit();
}//end

$output = 'Joke table successfully created.';
include 'output.html.php';




?>
