<?php
$siteRoot = "localhost";
include '../db.php';

$sql = "INSERT INTO `definitions` (`word`, `name`, `definition`, `type`) VALUES('"
    . $_POST['word']  . "','"
    . $_POST['name'] . "', '"
    . $_POST['definition'] . "', '"
    . $_POST['type'] . "')";

    if (!mysqli_query($link, $sql)) {
      echo "Something went wrong! :(";
      echo mysqli_error($link);
    }
    

header("Location: http://" . $siteRoot);
