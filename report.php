<?php
include 'db.php';

$report = mysqli_query($link, "UPDATE definitions SET onReport = onReport + 1 WHERE id = " . $_POST["id"] . "");