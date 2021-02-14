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

$soalprefix = "S";
$counter = 0;
$sql1 = mysqli_query($conn, "SELECT * FROM topik");
$soallist = array();
$gotsoal = array();

while ($row1 = mysqli_fetch_assoc($sql1)){
  $counter++;
  $soal = [];
  $soallist = [];
  $idtopik = $row1['idtopik'];
  $sql2 = mysqli_query($conn, "SELECT * FROM soalan WHERE (idtopik = '$idtopik') ORDER BY LENGTH (idsoal) ASC, idsoal ASC");
  $numsoal = mysqli_num_rows($sql2);
  $numsoal = $numsoal / 4;
  if ($numsoal >= 1){
    echo "<button class='collapsible btn'>".$row1['topik']."</button>";
    echo "<div class='content'>";
    array_push($gotsoal, "1");

    while ($fetchsoal = mysqli_fetch_array($sql2)){
      $resultsoal = $fetchsoal['soal'];
      $resultidsoal = $fetchsoal['idsoal'];
      array_push($soallist, $resultsoal);
    }
    $soal = array_unique($soallist);
    $soalcount = count($soal);
    echo "<div class='row'>";
    echo "<div class=col-sm-8></div>";
    echo "<a class='col-sm-4 btn btn-danger delete-kuiz-btn' id='".$idtopik."'>Hapuskan Kuiz</a>";
    echo "</div>";
    foreach ($soal as $value){
      $sql3 = mysqli_query($conn, "SELECT * FROM soalan WHERE (soal = '$value')");
      $soalresult = mysqli_fetch_array($sql3);
      $nosoal = $soalresult['nosoal'];
      echo "<div class='row'>";
      echo "<h5 class='contenttext col-sm'>".$value."</h5>";
      echo "<a class='col-sm-1 btn btn-primary edit-soal-btn' id='".$nosoal."'>Ubah</a>";
      // echo "<a class='col-sm-1 btn btn-primary edit-soal-btn' id='".$nosoal."' data-toggle='modal' data-target='#edit-soal'>Ubah</a>";
      echo "<a title='Hapuskan' class='col-sm-1 btn btn-danger delete-soal-btn' id='".$nosoal."' data-toggle='modal' data-target='#confirmationmodal'>X</a>";
      // echo "<a title='Hapuskan' class='col-sm-1 btn btn-danger delete-soal-btn' id='".$nosoal."'>X</a>";
      echo "</div>";
    }
  } 
  else {
    array_push($gotsoal, "0");
  }
    echo "</div>";
}

if (!in_array("1", $gotsoal)) {
  echo "<h3 class='text-center'>Tiada Soalan...<h3>";
}

  echo " 
  <script>
  var coll = document.getElementsByClassName('collapsible');
  var i;

  for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener('click', function() {
      this.classList.toggle('active');
      var content = this.nextElementSibling;
      if (content.style.maxHeight){
        content.style.maxHeight = null;
      } else {
        content.style.maxHeight = content.scrollHeight + 'px';
      } 
    });
  }
  </script>
  ";
$conn->close();

?>