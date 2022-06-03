<!DOCTYPE html>
<html lang="en-US">
<head>
    <title> Delete Jokes html </title>
    <meta charset="UTF-8">
</head>
<body>
    <center>
        <h1>
<span style="width:100%; height:90px; background:yellow; font-family:serif;">
My First Database driven Site<br />#THEJOKESITE</span></h1>


</center>
<br />
<p><a href="?addjoke">Add your own joke</a></p>
    <?php foreach($jokes as $joke): ?>

    <form action="?deletejoke" method="post">
    <!-- 1
    The ?deletejoke query string in the action attribute is
    to signal the deletion of a joke
     -->

   <blockquote>
        <p>
    <!-- This template is retrieving the data from the database it akso has a delete button-->
<?php echo htmlspecialchars($joke['text'], ENT_QUOTES, 'UTF-8'); ?>
<!-- 2
This is simply a reminder to fetch the joke texts since $joke[]
is a 2-item array
 -->
  <input type="hidden" name="id" value="<?php echo $joke['id']; ?>">
 <!-- Three
 This form sends the ID as well but its not necessary
 -->

 <input type="submit" value="Delete">
<!-- FOUR
This submit btn submits the form once it's been sent.
-->
<!--Adding the emails to be added to the jokes-->
(by <a href="mailto:<?php
  echo htmlspecialchars($joke['email'], ENT_QUOTES, 'UTF-8'); ?>" >
  <?php
  echo htmlspecialchars($joke['name'], ENT_QUOTES, 'UTF-8'); ?></a>)

</p>
    </blockquote>
</form>
<!-- Five

End Form

-->

<?php endforeach ?>
