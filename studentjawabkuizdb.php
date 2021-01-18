<html>
<head>

</head>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "spkm";

session_start();

$soallist = array();
$nosoallist = array();
$soalskipper = 0;
$questionnum = 1;
$valuelist = ["A", "B", "C", "D"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connectionz
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$idtopik = $_SESSION['kuizidtopik'];

$sql1 = mysqli_query($conn, "SELECT * FROM topik WHERE (idtopik = '$idtopik')");
$row1 = mysqli_fetch_assoc($sql1);
$topik = $row1['topik'];
echo "<h3 class='text-center'>".$topik."</h3>";
$sql2 = mysqli_query($conn, "SELECT * FROM soalan WHERE (idtopik = '$idtopik')");
while ($row2 = mysqli_fetch_assoc($sql2)) {
    $nosoal = $row2['nosoal'];
    $soal = $row2['soal'];
    array_push($soallist, $soal);
    array_push($nosoallist, $nosoal);
}

$soallistcount = count($soallist) / 4;

for ($i=0; $i < $soallistcount; $i++) {
    $radioname = "pilihradio" . $questionnum ;  
    $soal = $soallist[$soalskipper];
    $nosoal = $nosoallist[$soalskipper];
    $valueindex = 0;
    echo "<div class='soal-form-div'>";
    echo "<h5 name='soalnum[]'>Soalan ".$questionnum."</h5>";
    echo "<div class='soalcontainer' id='".$nosoal."' style='padding-top: 10px; padding-bottom: 10px'><h4>".$soal."</h4></div>";
    $pilihsql = mysqli_query($conn, "SELECT pilih FROM soalan WHERE (nosoal = '$nosoal')");
    while ($pilihrow = mysqli_fetch_assoc($pilihsql)) {
        $value = $valuelist[$valueindex];
        $pilih = $pilihrow['pilih'];
        echo "<label class='radiocontainer'>";
        echo "<input type='radio' name='".$nosoal."' id='".$radioname."' value='".$value."'>";
        echo "<span class='checkmark'>".$pilih."</span>";
        echo "</label>";
        $valueindex += 1;
    }
    echo "</div>";
    $soalskipper += 4;
    $questionnum += 1;
}

echo "<div class='form-group'>
    <button id='submit-jawab-kuiz-btn' type='submit' name='jawab-submit-btn' class='jawab-kuiz-submit-btn btn btn-primary btn-block btn-lg'>Submit</button>
</div>
";
