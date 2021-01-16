<?php 
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

$rekodprefix = "R";
$sql1 = mysqli_query($conn, "SELECT * FROM perekodan");
$idtopiklist = array();
$namalist = array();

while ($row1 = mysqli_fetch_assoc($sql1)) {
  $idtopik = $row1['idtopik'];
  array_push($idtopiklist, $idtopik);
}
$idtopikarray = array_unique($idtopiklist);
foreach ($idtopikarray as $value) {
  $sql4 = mysqli_query($conn, "SELECT * FROM topik WHERE (idtopik = '$value')");
  $row4 = mysqli_fetch_assoc($sql4);
  $topik = $row4['topik'];
  echo "<button class='collapsible btn'>".$topik."</button>";
  echo "<div class='content' id='content'>";
  $sql5 = mysqli_query($conn, "SELECT * FROM perekodan WHERE (idtopik = '$value')");
  while ($row5 = mysqli_fetch_assoc($sql5)) {
    $nop = $row5['nop'];
    $mar = $row5['mar'];
    $gred = $row5['gred'];
    $sql2 = mysqli_query($conn, "SELECT * FROM pengguna WHERE (nop = '$nop')");
    $row2 = mysqli_fetch_assoc($sql2);
    $notel = $row2['notel'];
    $sql3 = mysqli_query($conn, "SELECT * FROM telefon WHERE (notel = '$notel')");
    $row3 = mysqli_fetch_assoc($sql3);
    $nama = $row3['nama'];
    echo "<button class='collapsible1 btn user-rekod-btn' id='collapsible-cell'>".$nama."</button>";
    echo "<div class='content' id='cell-content'>";
    echo "<h3>".$mar."</h3>";
    echo "</div>";
  }
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
        console.log(btn);
        console.log(cellcount);
      } 
    });
  }
  </script>
  ";
echo "
  <script>
  var coll2 = document.getElementsByClassName('collapsible1');
  var a;

  for (a = 0; a < coll2.length; a++) {
    coll2[a].addEventListener('click', function() {
      this.classList.toggle('active');
      var content = this.nextElementSibling;
      var maincontent = this.closest('#content');
      height = maincontent.scrollHeight + content.scrollHeight;
      if (content.style.maxHeight){
        content.style.maxHeight = null;
      } else {
        content.style.maxHeight = content.scrollHeight + 'px';
      } 
      maincontent.style.maxHeight = height;
    });
  }
  </script>
  ";
?>