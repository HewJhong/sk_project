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

$NoP = $_SESSION['NoP'];

$sql1 = mysqli_query($conn, "SELECT * FROM perekodan WHERE (NoP = '$NoP')");
$idtopiklist = array();

while ($row1 = mysqli_fetch_assoc($sql1)) {
    $IdTopik = $row1['IdTopik'];
    array_push($idtopiklist, $IdTopik);
}
$idtopikarray = array_unique($idtopiklist);
if (count($idtopikarray) == 0){
  echo "<h3 class='text-center'>Tiada Keputusan untuk dipaparkan...<h3>";
}
foreach ($idtopikarray as $value) {
    $sql2 = mysqli_query($conn, "SELECT * FROM Topik WHERE (IdTopik = '$value')");
    $row2 = mysqli_fetch_assoc($sql2);
    $Topik = $row2['Topik'];
    $sql3 = mysqli_query($conn, "SELECT * FROM perekodan WHERE (IdTopik = '$value' AND NoP = '$NoP')");
    $row3 = mysqli_fetch_assoc($sql3);
    $Mar = $row3['Mar'];
    $Gred = $row3['Gred'];
    $Tar = $row3['Tar'];
    echo "<button class='collapsible btn'>".$Topik."</button>";
        echo "<div class='content' id='content'>";
        echo "<div class = 'row'>";
            echo "<div class = 'col-md-3'>";
                echo "<h4 class='collapsible-content'> Markah: ".$Mar."</h4>";
            echo "</div>";
            echo "<div class = 'col-md-3'>";
                echo "<h4 class='collapsible-content'> Gred: ".$Gred."</h4>";
            echo "</div>";
            echo "<div class = 'col-md-4'>";
                echo "<h4 class='collapsible-content'> Tarikh: ".$Tar."</h4>";
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

