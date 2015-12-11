<?php
include 'db.php';
$tagName = mysqli_real_escape_string($link, $_POST['tagName']);

$searchTags = mysqli_query($link, "SELECT word, definition, name, tagName, id, time FROM definitions WHERE tagName LIKE '%$tagName%'");

while ($row = mysqli_fetch_assoc($searchTags)) {
  echo '<div><a style="color: white !important; text-decoration: none;" href="?tag=' . $row['tagName'] . '"><h2>' . $row['tagName']. '</h2></a></div>';
}