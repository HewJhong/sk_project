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

$IdTopik = $_POST['id'];

$sql1 = mysqli_query($conn, "SELECT * FROM Topik WHERE (IdTopik = '$IdTopik')");
$row1 = mysqli_fetch_assoc($sql1);
$Topik = $row1['Topik'];
echo "<h3 class='text-center'>".$Topik."</h3>";
$sql2 = mysqli_query($conn, "SELECT * FROM soalan WHERE (IdTopik = '$IdTopik')");
while ($row2 = mysqli_fetch_assoc($sql2)) {
    $NoSoal = $row2['NoSoal'];
    $Soal = $row2['Soal'];
    array_push($soallist, $Soal);
    array_push($nosoallist, $NoSoal);
}

$counter = 0;
$soallistcount = count($soallist) / 4;


for ($i=0; $i < $soallistcount; $i++) {
    $NoSoal = $nosoallist[$soalskipper];
    $jawsql = mysqli_query($conn, "SELECT * FROM soalan WHERE (NoSoal = '$NoSoal') ORDER BY NoSoal ASC");
    while ($jawsqlrow = mysqli_fetch_assoc($jawsql)){
        $Jaw = $jawsqlrow['Jaw'];
        array_push($jawlist, $Jaw);
    }
    $soalskipper += 4;
}

$spanclasslist = array_keys($jawlist, 1);
$soalskipper = 0;


for ($i=0; $i < $soallistcount; $i++) {
    $index = $spanclasslist[$i];
    $radioname = "pilihradio" . $questionnum ;  
    $Soal = $soallist[$soalskipper];
    $NoSoal = $nosoallist[$soalskipper];
    echo "<div class='Soal-form-div'>";
    echo "<h5 name='soalnum[]'>Soalan ".$questionnum."</h5>";
    echo "<div class='soalcontainer' id='".$NoSoal."' style='padding-top: 10px; padding-bottom: 10px'><h4>".$Soal."</h4></div>";
    $pilihsql = mysqli_query($conn, "SELECT Pilih FROM soalan WHERE (NoSoal = '$NoSoal')");
    $valueindex = 0;
    while ($pilihrow = mysqli_fetch_assoc($pilihsql)) {
        $value = $valuelist[$valueindex];
        $Pilih = $pilihrow['Pilih'];
        echo "<label class='radiocontainer'>";
        echo "<a name='".$NoSoal."' id='".$radioname."' value='".$value."'>";
        if ($counter === $index) {
            echo "<span class='checkmark bg-warning' id='".$valueindex."'>".$Pilih."</span>";
        }
        else {
            echo "<span class='checkmark' id='".$valueindex."'>".$Pilih."</span>";
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
    <button id='balik-btn' type='submit' name='jawab-submit-btn' class='balik-btn btn btn-primary btn-block btn-lg'>Balik</button>
</div>
";
