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
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.css">
</head>
<body>
  <div class="container">
  
    <div class="latestResults">
      <h1 id="latestDefinitions">Latest definitions</h1> 
        <?php 
        $latestResults = mysqli_query($link, "SELECT word, name, time, id FROM definitions ORDER BY time desc LIMIT 5");

   while ($row = mysqli_fetch_assoc($latestResults)) {
          echo '<div class="abovethefoldinfo" onclick="getMoreInfo(' . $row['id'] . ')"><h1>' . $row['word'] . '</h1><h3>By ' . $row["name"] . '</h3></div>';
        }

        if (!$latestResults) {
          echo mysqli_error($link);
        }
        ?>
      
    </div>

    <div class="informationBackground">
      <div class="moreInformationDialog">
      <i class="fa fa-close"></i>
        <div class="informationContainer">
        </div>
      </div>
    </div>
    <div id="tagresults">
      <?php
      if (!empty($tag)) {

    echo "<style>.searchbox { display: none;} nav {display: block !important;}</style>";
    ?>
      <h1 id="title">Showing all definitions in <span>#<?php echo $tag; ?></span></h1>
      <div class="results"><?php 
      $tagResults = mysqli_query($link, "SELECT * FROM definitions WHERE tagName = '$tag'");
      if (!$tagResults) {
          print mysqli_error();
        }
      while ($row = mysqli_fetch_assoc($tagResults)) {
        echo "<div class='definitionBox'><h1>" . mysqli_real_escape_string($link, $row["word"]) . "</h1><p>" . mysqli_real_escape_string($link, $row["definition"]) . "<p><h4>By " . mysqli_real_escape_string($link, $row["name"]) . "</h4><a class='report' onclick='report()'>Report</a></div>";
      }
    }
      ?></div>
      </div>
        <div class="searchbox">
        <h1>Search Code Dictionary definitions</h1>
        <form>
          <input type="search" class="mainsearch" onkeyup="getWords(this.value)" placeholder="_" autocomplete="off">
          <div class="results"></div>
        </form>
       </div>
       <nav> 
       <a href="/"><h1>Code Dictionary</h1></a>
      <a href="submit/">Submit Definition</a>
     
    </nav>
    <div class="tagInformationBackground"></div>
    <h1 class="tagSearchCall" onclick="searchTagsDialog()"><i class="fa fa-hashtag"></i> Search Tags</h1>
      <div class="tagInformation">

        <div class="tagModal searchbox">
        <i class="fa fa-close"></i>
        <h2>Search tags</h2>
          <input type="search" class="mainsearch" onkeyup="getTags(this.value)" placeholder="_" autocomplete="off">
          <div class="tagSearchResults">
          </div>
            
        </div>
      
    </div>
  </div>

  
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script>
  function searchTagsDialog() {
    console.log("searchTags");
    $("div.tagModal").show();
    $("div.tagInformationBackground").show();
    $("div.tagInformationBackground").css("background-color", "rgba(0,0,0,0.7)");

    $(".tagInformation i").click(function() {
      $("div.tagInformationBackground").hide();
      $("div.tagModal").hide();
    })
  } 

  function getTags(value) {
    $.post("tagSearch.php", {tagName: value}, function(data) {
      $(".tagSearchResults").html(data);
    })
  }
   function getWords(value) {
    $(".results").show();
    if ((value) == "") {
        $(".results").hide();
      } else {
        $.post("search.php", {word: value}, function(data) {
          $(".results").html(data);
        });
    }
  }

 function report() {
    $(".container").append("<div class='reportCover' style='top: 0; bottom: 0; left: 0; right: 0; position: fixed;'><div class='reportModal'><h1>Thanks for reporting this definition.</h1><i class='fa fa-close'></i></div></div>");
    console.log("CLICKIED.");

    $(".reportModal i").click(function() {
        console.log("BROOO");
        $(".reportModal").hide(); 
      });
    $(".reportCover").css("background-color", "rgba(0,0,0,0.7)");
    }

   function getMoreInfo(value) {
    $(document).ready(function() {
    $.post("definitionWords.php", {id: value}, function(data) {
      console.log("Information");
      
      $(".moreInformationDialog").click(function() {
        console.log("bleh");
        $("div.informationBackground").hide();
      });
      
      $("div.moreInformationDialog").show();
      $("div.moreInformationDialog").html(data);
      $("div.informationBackground").show();
      $(".informationBackground").css("background-color", "rgba(0,0,0,0.7)");
    });
  });
   }
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53354801-4', 'auto');
  ga('send', 'pageview');
    </script>
</body>
</html>
