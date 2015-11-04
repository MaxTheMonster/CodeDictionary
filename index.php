<?php
include 'db.php';
if (!empty(mysqli_real_escape_string($_GET['tag']))) {
  $tag = mysqli_real_escape_string($_GET['tag']);
}

?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CodeDictionary - Submit your definitions.</title>
  <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
  <div class="container">
  <div id="tagresults">
    <?php
    if (!empty($tag)) {

  echo "<style>#searchbox { display: none;} nav {display: block !important;}</style>";?>
    <h1 id="title">Showing all definitions in <span>#<?php echo $tag; ?></span></h1>
    <div class="results"><?php 
    $tagResults = mysqli_query($link, "SELECT * FROM definitions WHERE tagName = '$tag'");
    if (!$tagResults) {
        print mysqli_error();
      }
    while ($row = mysqli_fetch_assoc($tagResults)) {
      echo "<div class='list'><h1>" . mysqli_real_escape_string($row["word"]) . "</h1><p>" . mysqli_real_escape_string($row["definition"]) . "<p><h4>By " . mysqli_real_escape_string($row["name"]) . "</h4><a class='report' onclick='report()'>Report</a></div>";
    }
  }
    ?></div>
  </div>
    <div id="searchbox">
    <h1>Search tech definitions now: </h1>
    <form>
      <input type="search" id="mainsearch" onkeyup="getWords(this.value)" placeholder="_" autocomplete="off">
      <div class="results"></div>
    </form>
   </div>
   <nav>
  <a href="submit/">Submit Definition</a>
</nav>
  </div>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script>
  function getWords(value) {
    $.post("search.php", {word: value}, function(data) {
      $(".results").html(data);
    });
  }
  function report() {
    $("body").append("<div class='reportModal'><h1>Thanks for reporting this definition.</h1><a>Close</a></div>");
    console.log("CLICKIED.");

    $("body").addClass('modal');

    $(".reportModal a").click(function() {
      $(this).parent().remove();
      $("body").removeClass('modal');
    });
  }
  </script>
</body>
</html>
