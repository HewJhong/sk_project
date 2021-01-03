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
$sql1 = mysqli_query($conn, "select * from topik");
$soallist = array();

echo "<div class='quiz-form-div'>";

while ($row1 = mysqli_fetch_array($sql1)){
  $counter++;
  $soal = [];
  $soallist = [];
  $idtopik = $row1['idtopik'];
  $sql2 = mysqli_query($conn, "SELECT * FROM testsoal WHERE (idtopik = '$idtopik') ORDER BY LENGTH (idsoal) ASC, idsoal ASC");
  $nosoal = mysqli_num_rows($sql2);
  $nosoal = $nosoal / 4;
  if ($nosoal >= 1){
    echo "<button class='collapsible btn'>".$row1['topik']."</button>";
    echo "<div class='content'>";
  }
  while ($fetchsoal = mysqli_fetch_array($sql2)){
    $resultsoal = $fetchsoal['soal'];
    $resultidsoal = $fetchsoal['idsoal'];
    array_push($soallist, $resultsoal);
  }
  $soal = array_unique($soallist);
  $soalcount = count($soal);
  foreach ($soal as $value){
    $sql3 = mysqli_query($conn, "SELECT * FROM testsoal WHERE (soal = '$value')");
    $soalresult = mysqli_fetch_array($sql3);
    $nosoal = $soalresult['nosoal'];
    echo "<div class='row'>";
    echo "<h5 class='contenttext col-sm'>".$value."</h5>";
    echo "<a class='col-sm-1 btn btn-primary edit-soal-btn' id='".$nosoal."'>Ubah</a>";
    // echo "<a class='col-sm-1 btn btn-primary edit-soal-btn' id='".$nosoal."' data-toggle='modal' data-target='#edit-soal'>Ubah</a>";
    echo "<a title='Hapuskan' class='col-sm-1 btn btn-danger delete-soal-btn' id='".$nosoal."' data-toggle='modal' data-target='#confirmationmodal'>X</a>";
    echo "</div>";
      }
      echo "</div>";
    }
    echo "</div>";
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