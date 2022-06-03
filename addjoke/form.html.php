<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <title>Add Joke</title></title>
    <style type="text/css">
    textarea {
        display: block;
        width: 50%;
            }
    </style>
    </head>
<body>
<!--The ? means the form is going to return a query string-->
<form action="?" method="post">
    <div>
        <p><a href="?addjoke">Add your own joke</a></p>

        <label for="joketext">Type your joke here:</label>
        <textarea name="joketext" id="joketext" cols="3" rows="4"></textarea>
    </div>    
              <input type="submit" value="Add">
        </div>


</form>
</body>
</html>



