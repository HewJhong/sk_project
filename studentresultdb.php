<?php 

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "spkm";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$nop = $_SESSION['nop'];

$sql1 = mysqli_query($conn, "SELECT * FROM perekodan WHERE (nop = '$nop')");
$idtopiklist = array();

while ($row1 = mysqli_fetch_assoc($sql1)) {
    $idtopik = $row1['idtopik'];
    array_push($idtopiklist, $idtopik);
}
$idtopikarray = array_unique($idtopiklist);
foreach ($idtopikarray as $value) {
    $sql2 = mysqli_query($conn, "SELECT * FROM topik WHERE (idtopik = '$value')");
    $row2 = mysqli_fetch_assoc($sql2);
    $topik = $row2['topik'];
    $sql3 = mysqli_query($conn, "SELECT * FROM perekodan WHERE (idtopik = '$value' AND nop = '$nop')");
    $row3 = mysqli_fetch_assoc($sql3);
    $mar = $row3['mar'];
    $gred = $row3['gred'];
    $tar = $row3['tar'];
    echo "<button class='collapsible btn'>".$topik."</button>";
        echo "<div class='content' id='content'>";
        echo "<div class = 'row'>";
            echo "<div class = 'col-md-3'>";
                echo "<h4 class='collapsible-content'> Markah: ".$mar."</h4>";
            echo "</div>";
            echo "<div class = 'col-md-3'>";
                echo "<h4 class='collapsible-content'> Gred: ".$gred."</h4>";
            echo "</div>";
            echo "<div class = 'col-md-4'>";
                echo "<h4 class='collapsible-content'> Tarikh: ".$tar."</h4>";
            echo "</div>";
            echo "<div style = 'margin: auto;' class = 'col-md-2 text-right'>";
                echo "<a style='color: black;' class='btn btn-primary review-kuiz-btn' id='".$value."'>Review</a>";
            echo "</div>";
        echo "</div>";
    echo "</div>";
}

echo " 
  <script>
  var coll = document.getElementsByClassName('collapsible');
  var i;

  for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener('click', function() {
      this.classList.toggle('active');
      var content = this.nextElementSibling;
      var btn = jQuery(content).children('button');
      var cell = jQuery(content).children('#cell-content');
      var cellcount = cell.length;
      var btncount = btn.length;
      if (content.style.maxHeight){
        content.style.maxHeight = null;
        for (i=0; i<btncount; i++) {
          btn[i].classList.remove('active');
          cell[i].style.maxHeight = null;
        }
      } else {
        content.style.maxHeight = content.scrollHeight + 'px';
      } 
    });
  }
  </script>
  ";

