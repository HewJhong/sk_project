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
    echo "<button class='collapsible'>".$row1['topik']."</button>";
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
    echo "<p>".$value."</p>";
  }
}

echo "</div>";
echo "</div>";

$conn->close();


?>