<?php

if (get_magic_quotes_gpc())
{
$process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);

while (list($key, $val) = each($process))
{
foreach ($val as $k => $v)
{
unset($process[$key][$k]);
if (is_array($v))
{
$process[$key][stripslashes($k)] = $v;
$process[] = &$process[$key][stripslashes($k)];
}
else
{
$process[$key][stripslashes($k)] = stripslashes($v);
}
}
}
unset($process);
}

if (isset($_GET['addjoke']))
{
include 'form.html.php';
exit();
}
try
{
$pdo = new PDO('mysql:host=localhost;dbname=joke', 'joke',
'T00R@123sultan');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
$error = 'Unable to connect to the database server.';
include 'error.html.php';
exit();
}//end dbc

if (isset($_POST['joketext']))
{
try
{
$sql = 'INSERT INTO joke SET
joketext = :joketext,jokedate = CURDATE()';
$s = $pdo->prepare($sql);
$s->bindValue(':joketext', $_POST['joketext']);
$s->execute();

/*The Values above are prepared statements that are given to the
Server to be prepared to execute in this case it's the "joketext"
The ":joketext" is the placeholder, shown by the ":" colon primarily
The "prepare" tells the server to prepare to run the scripts

The Prepare method returns the PDOStatement object, i.e the one from a SELECT Query
this result is then stored in the $s
*/

}
catch (PDOException $e)
{
$error = 'Error adding submitted joke: ' . $e->getMessage();
include 'error.html.php';
exit();
}
header('Location: .');
exit();
}
try
{
$sql = 'SELECT joketext FROM joke';
$result = $pdo->query($sql);
}
catch (PDOException $e)
{
$error = 'Error fetching jokes: ' . $e->getMessage();
include 'error.html.php';
exit();
}
while ($row = $result->fetch())
{
$jokes[] = $row['joketext'];
}
include 'jokes.html.php';



?>
