<?php
include('db.php');

$word = mysqli_real_escape_string($_POST['word']);

$definitions = mysqli_query($link, "SELECT * FROM definitions WHERE word LIKE'%$word%' LIMIT 10");

while($defs = mysqli_fetch_array($definitions)) {
  echo "<div><h1>"
    . mysqli_real_escape_string($defs['word']) . "</h1><a href='?tag=" . mysqli_real_escape_string($defs['tagName']) . "'><h3>#" . mysqli_real_escape_string($defs["tagName"]) . "</h3></a><h2>". mysqli_real_escape_string($defs['time']) . "</h2><p>" . mysqli_real_escape_string($defs["definition"]) . "</p><h4>By <strong>" . mysqli_real_escape_string($defs['name']) . "</strong></h4><a class='report' onclick='report()'>Report</a></div>";
}
?>
<script>
 function report() {
    $("body").append("<div class='reportModal'><h1>Thanks for reporting this definition.</h1><a>Close</a></div>");
    console.log("CLICKIED.");

    $("body").addClass('modal');

    $("a").click(function() {
      $("body").removeClass('modal');

    $(this).parent().remove();
    });
  }
</script>