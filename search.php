<?php
include('db.php');

$word = mysqli_real_escape_string($link, $_POST['word']);

$definitions = mysqli_query($link, "SELECT * FROM definitions WHERE word LIKE'%$word%' LIMIT 10");

while($defs = mysqli_fetch_array($definitions)) {
  echo "<div class='definitionBox'><h1>"
    . mysqli_real_escape_string($link, $defs['word']) . "</h1><a href='?tag=" . mysqli_real_escape_string($link, $defs['tagName']) . "'><h3>#" . mysqli_real_escape_string($link, $defs['tagName']) . "</h3></a><h2>". mysqli_real_escape_string($link, $defs['time']) . "</h2><p>" . mysqli_real_escape_string($link, $defs["definition"]) . "</p><h4>By <strong>" . mysqli_real_escape_string($link, $defs['name']) . "</strong></h4><a class='report' onclick='report(" . mysqli_real_escape_string($link, $defs['id']) . ")'>Report</a></div>";
}
?>
<script>
function report(onReport) {
    $(".container").append("<div class='reportCover' style='top: 0; bottom: 0; left: 0; right: 0; position: fixed;'><div class='reportModal'><h1>Thanks for reporting this definition.</h1><i class='fa fa-close'></i></div></div>");
    console.log("CLICKIED.");

    $(".reportModal i").click(function() {
        console.log("BROOO");
        $(".reportCover").hide(); 
      });
    $(".reportCover").show();
    $(".reportCover").css("background-color", "rgba(0,0,0,0.7)");
    }
</script>