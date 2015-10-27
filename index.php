<!--  <?php
  include 'db.php';

  $check = mysqli_query($link, "SELECT word FROM defintiions");
  echo $check;
  if (isset($_GET['wd'])) {
    echo 'Isset'; 

    $thisWord = $_GET['wd'];

    if ($_GET['wd'] = mysqli_fetch_array($check)) {
      echo 'Now thats a name I havent heard in a long time';
    }
  } if(!isset($_GET['wd'])) {

  }
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CodeDictionary - Submit your definitions.</title>
  <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

  <div class="container">
    <div id="searchbox">
    <h1>Search tech definitions now: </h1>
    <form>
      <input type="search" id="mainsearch" onkeyup="getWords(this.value)" placeholder="_" autocomplete="off">
      <div id="results"></div>
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
      $("#results").html(data);
    });
  }
  </script>
</body>
</html>
