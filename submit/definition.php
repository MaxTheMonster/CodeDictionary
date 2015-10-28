<?php
$siteRoot = "localhost/codeDictionary/";
include '../db.php';

echo $_POST['tagName'];

$getTags = mysqli_query($link, "SELECT tagName FROM tags WHERE tagName = '" . $_POST['tagName'] . "'");

if (mysqli_num_rows($getTags) == 0) {
  echo 'Does not exist.';
  $newTag = mysqli_query($link, "INSERT INTO `tags` (`tagName`) VALUES('" . $_POST['tagName'] . "')");
  if (!$newTag) {
      echo "Something went wrong! :(";
      echo mysqli_error($link);
    }
} else {
  echo mysqli_num_rows($getTags);
  echo "Does exist.";
}

$sql = "INSERT INTO `definitions` (`word`, `name`, `definition`, `tagName`) VALUES('"
    . $_POST['word']  . "','"
    . $_POST['name'] . "', '"
    . $_POST['definition'] . "', '"
    . $_POST['tagName'] . "')";

    if (!mysqli_query($link, $sql)) {
      echo "Something went wrong! :(";
      echo mysqli_error($link);
    }
    
// mysql_real_escape_string($_POST['name'])
header("Location: http://" . $siteRoot);
