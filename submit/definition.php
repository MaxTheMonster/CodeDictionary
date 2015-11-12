<?php
$siteRoot = "localhost/codeDictionary/";
include '../db.php';

if (empty(mysqli_real_escape_string($link, $_POST['word']) && mysqli_real_escape_string($link, $_POST['definition']))) {
  echo 'You need to fill in a Word and a definition!';
} else {

echo mysqli_real_escape_string($link, $_POST['tagName']);

$getTags = mysqli_query($link, "SELECT tagName FROM tags WHERE tagName = '" . mysqli_real_escape_string($link, $_POST['tagName']) . "'");

if (mysqli_num_rows($getTags) == 0) {
  echo 'Does not exist.';
  $newTag = mysqli_query($link, "INSERT INTO `tags` (`tagName`) VALUES('" . mysqli_real_escape_string($link, $_POST['tagName']) . "')");
  if (!$newTag) {
      echo "Something went wrong! :(";
      echo mysqli_error($link);
    }
} else {
  echo mysqli_num_rows($getTags);
  echo "Does exist.";
}

$sql = "INSERT INTO `definitions` (`word`, `name`, `definition`, `tagName`) VALUES('"
    . mysqli_real_escape_string($link, $_POST['word'])  . "','"
    . mysqli_real_escape_string($link, $_POST['name']) . "', '"
    . mysqli_real_escape_string($link, $_POST['definition']) . "', '"
    . mysqli_real_escape_string($link, $_POST['tagName']) . "')";

    if (!mysqli_query($link, $sql)) {
      echo "Something went wrong! :(";
      echo mysqli_error($link);
    }
    
// mysql_real_escape_string($_POST['name'])
 header("Location: http://" . $siteRoot);
}