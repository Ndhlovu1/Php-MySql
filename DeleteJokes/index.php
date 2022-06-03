<?php

try{
    $pdo = new PDO('mysql:host=localhost;dbname=joke', 'joke',
    'T00R@123sultan');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES "utf8"');
}//end connect try

catch(PDOException $e) {
    $error = 'Unable to connect to the database server.';
include 'error.html.php';
exit();
}//end connect Exception



//The code for adding a joke that is used to also get the code from the
if(isset($_GET['addjoke']))
{
    include 'form.html.php';
    exit();
    }//end the check on addjoke

//code for collecting the joke that has been screated
if(isset($_POST['joketext'])){

    try{
        $sql = 'INSERT INTO joke SET
        joketext = :joketext,
        jokedate = CURDATE()';
        $s = $pdo->prepare($sql);
        $s ->bindValue(':joketext', $_POST['joketext']);
        $s->execute();
    }//end joketext try

    catch(PDOException $e){
        $error = 'Error Adding submitted joke: '. $e->getMessage();
        include 'error.html.php';
        exit();
    }//End the addjoketext Try Catch

//Ask server to view the updated list of the jokes.
    header('Location: .');
    exit();
}//end joktext if

//#############################################

//Making the delete buton to work
if(isset($_GET['deletejoke'])){
    try {
        $sql = 'DELETE FROM joke WHERE id = :id';
        //Create the ID placeholder
        $s = $pdo ->prepare($sql);
        $s -> bindValue(':id', $_POST['id']);
    //The bV is combined/bound so that to the placeholder and the query.
        $s->execute();
    //The above code is running the code
    }//end try from if butn

    catch(PDOException $e){
        $error = 'Error Deleting Joke: '. $e->getMessage();
        include 'error.html.php';
        exit();
}//end butn catch

    /* The below(Header) code is used to find the location
    The PHP HEADER is used to ask the browser to send the updated joke list
     */
    header('Location: .');
    exit();

}//end delete button if


//listing the data from the tables
try {
  //Using the join to select an data from different tables
  $sql = 'SELECT joke.id, joketext, name, email FROM
          joke INNER JOIN author ON authorid = author.id';
  //  $sql = 'SELECT id, joketext FROM joke';
    //Now we must fetch both of these columns
    $result = $pdo->query($sql);

}//end try

//The catch code in event oof an error
catch (PDOException $e){
    $error = 'Error fetching jokes: '. $e->getMessage();
    //The template to output the data to
    include 'error.html.php';
    //End the code with a cleanUp
    exit();
}//End get column CATCH

//THe code that stores the associative data arrays
//We shud make each of these columns an array of it's own right
while( $row = $result->fetch()){
    $jokes[] = array('id'=> $row['id'], 'text' => $row['joketext']);

/*
The explanation is simply defined as:
for every joke($jokes[n]) we can retrieve:
    its ID($jokes[n]['id']) and
    its text($joke[n][text])
*/
}//end while loop that stores each column as an array

include 'jokes.html.php';
/*  Using the ForEach loop to process data
foreach ($result as $row) {
    $jokes[] = array('id' => $row['id'], 'text' => $row['joketext']);

}//End foreach loop

*/






?>
