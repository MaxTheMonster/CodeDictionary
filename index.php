<?php
include 'db.php';

if (!empty($_GET)) {
  $tag = mysqli_real_escape_string($link, $_GET['tag']);
} 

?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CodeDictionary - Submit your definitions.</title>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <meta name=viewport content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="favicon.png">
</head>
<body>

  <div class="container">
    <div class="latestResults">
      <h1>Latest definitions.</h1> 
        <?php 
        $latestResults = mysqli_query($link, "SELECT word, name, time, id FROM definitions ORDER BY time desc LIMIT 5");

        while ($row = mysqli_fetch_assoc($latestResults)) {
          echo '<div onclick="getMoreInfo(' . $row['id'] . ')"><h1>' . $row['word'] . '</h1><h3>By ' . $row["name"] . '</h3></div>';
        }

        if (!$latestResults) {
          echo mysqli_error($link);
        }
        ?>
      <div class="moreInformationDialog">
        
      </div>
    </div>
    <div id="tagresults">
      <?php
      if (!empty($tag)) {

    echo "<style>#searchbox { display: none;} nav {display: block !important;}</style>";
    ?>
      <h1 id="title">Showing all definitions in <span>#<?php echo $tag; ?></span></h1>
      <div class="results"><?php 
      $tagResults = mysqli_query($link, "SELECT * FROM definitions WHERE tagName = '$tag'");
      if (!$tagResults) {
          print mysqli_error();
        }
      while ($row = mysqli_fetch_assoc($tagResults)) {
        echo "<div class='list'><h1>" . mysqli_real_escape_string($link, $row["word"]) . "</h1><p>" . mysqli_real_escape_string($link, $row["definition"]) . "<p><h4>By " . mysqli_real_escape_string($link, $row["name"]) . "</h4><a class='report' onclick='report()'>Report</a></div>";
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
    $("a").click(function() {
      $("body").removeClass('modal');

    $(this).parent().remove();
    });
    }

   function getMoreInfo(value) {
    $.post("definitionWords.php", {id: value}, function(data) {
      console.log("Information");
      $("div.moreInformationDialog").html(data);
    });
   }
    </script>
</body>
</html>
