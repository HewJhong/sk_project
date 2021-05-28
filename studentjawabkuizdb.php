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

$IdTopik = $_SESSION["kuizidtopik"];

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

$soallistcount = count($soallist) / 4;

for ($i=0; $i < $soallistcount; $i++) {
    $radioname = "pilihradio" . $questionnum ;  
    $Soal = $soallist[$soalskipper];
    $NoSoal = $nosoallist[$soalskipper];
    $valueindex = 0;
    echo "<div class='Soal-form-div'>";
    echo "<h5 name='soalnum[]'>Soalan ".$questionnum."</h5>";
    echo "<div class='soalcontainer' id='".$NoSoal."' style='padding-top: 10px; padding-bottom: 10px'><h4>".$Soal."</h4></div>";
    $pilihsql = mysqli_query($conn, "SELECT Pilih FROM soalan WHERE (NoSoal = '$NoSoal')");
    while ($pilihrow = mysqli_fetch_assoc($pilihsql)) {
        $value = $valuelist[$valueindex];
        $Pilih = $pilihrow['Pilih'];
        echo "<label class='radiocontainer'>";
        echo "<input type='radio' name='".$NoSoal."' id='".$radioname."' value='".$value."'>";
        echo "<span class='checkmark'>".$Pilih."</span>";
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
