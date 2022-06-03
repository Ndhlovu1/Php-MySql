<?php
//This code is designed to list all the contents of the joke db
try {
//connect to the db
    $pdo = new PDO('mysql:host=localhost;dbname=joke','joke','T00R@123sultan');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


}//end db connect try

catch (PDOException $e) {
    $error = 'Unable to connect to the database '.$e->getMessage();
    include 'error.html.php';
    exit();
}//end catch

try {
    $sql = 'Select joketext FROM joke';
    $result = $pdo->query($sql);
}//end collect data code

catch (PDOException $e){
    $error = 'Error fetching jokes: '. $e->getMessage();
    include 'error.html.php';
    exit();

}//the failure to catch rows code.

//code to controll the output
while( $row = $result->fetch()){
    $jokes[]  = $row['joketext'];
}//end condition

include'jokes.html.php';

?>
