<?php
include('db.php');

$word = mysqli_real_escape_string($link, $_POST['word']);

$definitions = mysqli_query($link, "SELECT * FROM definitions WHERE word LIKE'%$word%' LIMIT 10");

while($defs = mysqli_fetch_array($definitions)) {
  echo "<div><h1>"
    . mysqli_real_escape_string($link, $defs['word']) . "</h1><a href='?tag=" . mysqli_real_escape_string($link, $defs['tagName']) . "'><h3>#" . mysqli_real_escape_string($link, $defs['tagName']) . "</h3></a><h2>". mysqli_real_escape_string($link, $defs['time']) . "</h2><p>" . mysqli_real_escape_string($link, $defs["definition"]) . "</p><h4>By <strong>" . mysqli_real_escape_string($link, $defs['name']) . "</strong></h4><a class='report' onclick='report(" . mysqli_real_escape_string($link, $defs['id']) . ")'>Report</a></div>";
}
?>
<script>
function report(onReport) {
    $("body").append("<div class='reportModal'><h1>Thanks for reporting this definition.</h1><a>Close</a></div>");
    console.log("CLICKIED.");

    $.post("report.php", {id: onReport}, function(data) {
      $("body").append(data);
    });
    $("body").addClass('modal');
    
    $("a").click(function() {
      $("body").removeClass('modal');

    $(this).parent().remove();
    });
    }
</script>