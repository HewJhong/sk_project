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
$sql1 = mysqli_query($conn, "SELECT * FROM soalan");
$idtopiklist = array();
$namalist = array();

echo "<div class='text-center' style='margin-top: 20px;'><h2>Keputusan Murid</h2></div>";
echo "<div class='rekod-list-div'>";

while ($row1 = mysqli_fetch_assoc($sql1)) {
  $idtopik = $row1['idtopik'];
  array_push($idtopiklist, $idtopik);
}
$idtopikarray = array_unique($idtopiklist);
if (count($idtopikarray) <= 0 ) {
  echo "<h3 class='text-center'>Tiada Soalan...<h3>";
}
foreach ($idtopikarray as $value) {
  $sql4 = mysqli_query($conn, "SELECT * FROM topik WHERE (idtopik = '$value')");
  $row4 = mysqli_fetch_assoc($sql4);
  $topik = $row4['topik'];
  $sql5 = mysqli_query($conn, "SELECT * FROM perekodan WHERE (idtopik = '$value')");
  $perekodancount = mysqli_num_rows($sql5);
  $usersql = mysqli_query($conn, "SELECT * FROM pengguna WHERE (peranan = 'murid')");
  $usercount = mysqli_num_rows($usersql);
  $tally = $usercount - $perekodancount;
  $usersubmitcount = $usercount - $tally;
  echo "<button class='collapsible btn'><h5>".$topik."</h5><div class='text-right submitcount-btn'>".$usersubmitcount."/".$usercount." hantar</div></button>";
  echo "<div class='content' id='content'>";
  while ($row5 = mysqli_fetch_assoc($sql5)) {
    $nop = $row5['nop'];
    $mar = $row5['mar'];
    $gred = $row5['gred'];
    $tar = $row5['tar'];
    $sql2 = mysqli_query($conn, "SELECT * FROM pengguna WHERE (nop = '$nop')");
    $row2 = mysqli_fetch_assoc($sql2);
    $notel = $row2['notel'];
    $sql3 = mysqli_query($conn, "SELECT * FROM telefon WHERE (notel = '$notel')");
    $row3 = mysqli_fetch_assoc($sql3);
    $nama = $row3['nama'];
    echo "<button class='collapsible1 btn user-rekod-btn resultcontent' id='collapsible-cell'>".$nama."</button>";
    echo "<div class='content' id='cell-content' style='margin-top: 5px;'>";
    echo "<h5>Markah: ".$mar."  (".$gred.")</h5><h5>Tarikh Siap: ".$tar."</h5>";
    echo "<button class='btn btn-primary infolanjut-btn float-right' id='".$value."'>Info Lanjut</button>";
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
  echo "</div>";
?>