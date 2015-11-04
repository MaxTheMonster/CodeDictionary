<?php

include 'db.php';

$tag = $_POST["tagName"];

$tags = mysqli_query($link, "SELECT * FROM tags WHERE tagName LIKE'%$tag%' LIMIT 10");

while($defs = mysqli_fetch_array($tags)) {
  echo '<div><h1 class="infoTag">' . $defs["tagName"] . '</h1></div>';
}
