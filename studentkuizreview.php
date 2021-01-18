<html>
<head>
<script src='functions.js'></script>
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
$jawlist = array();
$spanclasslist = array();
$soalskipper = 0;
$questionnum = 1;
$valuelist = ["A", "B", "C", "D"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connectionz
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$idtopik = $_POST['id'];

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

$counter = 0;
$soallistcount = count($soallist) / 4;


for ($i=0; $i < $soallistcount; $i++) {
    $nosoal = $nosoallist[$soalskipper];
    $jawsql = mysqli_query($conn, "SELECT * FROM soalan WHERE (nosoal = '$nosoal') ORDER BY nosoal ASC");
    while ($jawsqlrow = mysqli_fetch_assoc($jawsql)){
        $jaw = $jawsqlrow['jaw'];
        array_push($jawlist, $jaw);
    }
    $soalskipper += 4;
}

$spanclasslist = array_keys($jawlist, 1);
$soalskipper = 0;


for ($i=0; $i < $soallistcount; $i++) {
    $index = $spanclasslist[$i];
    $radioname = "pilihradio" . $questionnum ;  
    $soal = $soallist[$soalskipper];
    $nosoal = $nosoallist[$soalskipper];
    echo "<div class='soal-form-div'>";
    echo "<h5 name='soalnum[]'>Soalan ".$questionnum."</h5>";
    echo "<div class='soalcontainer' id='".$nosoal."' style='padding-top: 10px; padding-bottom: 10px'><h4>".$soal."</h4></div>";
    $pilihsql = mysqli_query($conn, "SELECT pilih FROM soalan WHERE (nosoal = '$nosoal')");
    $valueindex = 0;
    while ($pilihrow = mysqli_fetch_assoc($pilihsql)) {
        $value = $valuelist[$valueindex];
        $pilih = $pilihrow['pilih'];
        echo "<label class='radiocontainer'>";
        echo "<a name='".$nosoal."' id='".$radioname."' value='".$value."'>";
        if ($counter === $index) {
            echo "<span class='checkmark bg-warning' id='".$valueindex."'>".$pilih."</span>";
        }
        else {
            echo "<span class='checkmark' id='".$valueindex."'>".$pilih."</span>";
        }
        echo "</label>";
        $valueindex += 1;
        $counter += 1;
    }
    echo "</div>";
    $soalskipper += 4;
    $questionnum += 1;
}

for ($i=0; $i < $soallistcount; $i++) {

    // echo '<script type="text/javascript" src="functions.js">',
    //  'markcorrect('.$index.')',
    //  '</script>';
}

echo "<div class='form-group'>
    <button id='balik-btn' type='submit' name='jawab-submit-btn' class='jawab-kuiz-submit-btn btn btn-primary btn-block btn-lg'>Balik</button>
</div>
";
