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
  $IdTopik = $row1['IdTopik'];
  array_push($idtopiklist, $IdTopik);
}
$idtopikarray = array_unique($idtopiklist);
if (count($idtopikarray) <= 0 ) {
  echo "<h3 class='text-center'>Tiada Soalan...<h3>";
}
foreach ($idtopikarray as $value) {
  $sql4 = mysqli_query($conn, "SELECT * FROM Topik WHERE (IdTopik = '$value')");
  $row4 = mysqli_fetch_assoc($sql4);
  $Topik = $row4['Topik'];
  $sql5 = mysqli_query($conn, "SELECT * FROM perekodan WHERE (IdTopik = '$value')");
  $perekodancount = mysqli_num_rows($sql5);
  $usersql = mysqli_query($conn, "SELECT * FROM pengguna WHERE (Peranan = 'murid')");
  $usercount = mysqli_num_rows($usersql);
  $tally = $usercount - $perekodancount;
  $usersubmitcount = $usercount - $tally;
  echo "<button class='collapsible btn'><h5>".$Topik."</h5><div class='text-right submitcount-btn'>".$usersubmitcount."/".$usercount." hantar</div></button>";
  echo "<div class='content' id='content'>";
  while ($row5 = mysqli_fetch_assoc($sql5)) {
    $NoP = $row5['NoP'];
    $Mar = $row5['Mar'];
    $Gred = $row5['Gred'];
    $Tar = $row5['Tar'];
    $sql2 = mysqli_query($conn, "SELECT * FROM pengguna WHERE (NoP = '$NoP')");
    $row2 = mysqli_fetch_assoc($sql2);
    $NoTel = $row2['NoTel'];
    $sql3 = mysqli_query($conn, "SELECT * FROM telefon WHERE (NoTel = '$NoTel')");
    $row3 = mysqli_fetch_assoc($sql3);
    $Nama = $row3['Nama'];
    echo "<button class='collapsible1 btn user-rekod-btn resultcontent' id='collapsible-cell'>".$Nama."</button>";
    echo "<div class='content' id='cell-content'>";
    echo "<h5>Markah: ".$Mar."  (".$Gred.")</h5><h5>Tarikh Siap: ".$Tar."</h5>";
    echo "</div>";
  }
  echo "<button class='btn btn-primary infolanjut-btn float-right' id='".$value."'>Info Lanjut</button>";
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
      var height = maincontent.scrollHeight + content.scrollHeight;
      console.log(maincontent);
      if (content.style.maxHeight){
        content.style.maxHeight = null;
      } else {
        content.style.maxHeight = content.scrollHeight + 'px';
      } 
      maincontent.style.maxHeight = height + 'px';
    });
  }
  </script>
  ";
  echo "</div>";
?>