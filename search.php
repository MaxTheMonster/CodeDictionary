<?php
include('db.php');

$word = $_POST['word'];

$definitions = mysqli_query($link, "SELECT * FROM definitions WHERE word LIKE'%$word%' LIMIT 10");

while($defs = mysqli_fetch_array($definitions)) {
  echo "<div><a href='?wd="
   . $defs['word'] . "'><h1> "
    . $defs['word'] . "</h1></a><h2>". $defs['time'] . "</h2><p>" . $defs["definition"] . "</p><h4>By " . $defs['name'] . "</h4></div>";
}
