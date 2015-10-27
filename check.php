<?php

include 'db.php';

$num = rand(1, 10000);
if ($_POST["one"] == "") {
  echo "Well done!";
}