<?php
include 'db.php';
$tagName = mysqli_real_escape_string($link, $_POST['tagName']);

$searchTags = mysqli_query($link, "SELECT tagName FROM tags WHERE tagName LIKE '%$tagName%'");

while ($row = mysqli_fetch_assoc($searchTags)) {
  echo '<div><a style="color: white !important; text-decoration: none;" href="?tag=' . $row['tagName'] . '"><h3>' . $row['tagName']. '</h3></a></div>';
}