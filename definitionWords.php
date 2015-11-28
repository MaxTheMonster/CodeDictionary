<?php
include 'db.php';

$extraDefinitionInfo = mysqli_query($link, "SELECT tagName, definition, word, name, time, id FROM definitions WHERE id = " . $_POST["id"] . "");

while ($row = mysqli_fetch_assoc($extraDefinitionInfo)) {
  echo "<div class='definitionBox'><h1>"
    . mysqli_real_escape_string($link, $row['word']) . "</h1><a href='?tag=" . mysqli_real_escape_string($link, $row['tagName']) . "'><h3>#" . mysqli_real_escape_string($link, $row['tagName']) . "</h3></a><h2>". mysqli_real_escape_string($link, $row['time']) . "</h2><p>" . mysqli_real_escape_string($link, $row["definition"]) . "</p><h4>By <strong>" . mysqli_real_escape_string($link, $row['name']) . "</strong></h4><a class='report' onclick='report(" . mysqli_real_escape_string($link, $row['id']) . ")'>Report</a></div>";
}
if (!$extraDefinitionInfo) {
  echo mysqli_error();
}

