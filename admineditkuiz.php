<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "spkm";

// Sambungan dengan database
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("Database error: " . $conn->connect_error);
}

/// Papar antara muka untuk edit soalan kuiz
if(isset($_POST["NoSoal"])) {
    $piliharray = array();
    $jawarray = array();
    $checkbox = array();
    $array = array();
    $NoSoal = $_POST['NoSoal'];
    $pilihsql = mysqli_query($conn, "SELECT * FROM soalan WHERE (NoSoal='$NoSoal')");
    $soalsql = mysqli_query($conn, "SELECT * FROM soalan WHERE (NoSoal='$NoSoal')");
    $jawsql = mysqli_query($conn, "SELECT * FROM soalan WHERE (NoSoal='$NoSoal')");
    while ($pilihrow = mysqli_fetch_assoc($pilihsql)) {
        $Pilih = $pilihrow['Pilih'];
        array_push($piliharray, $Pilih);
    }
    while ($jawrow = mysqli_fetch_assoc($jawsql)) {
        $Jaw = $jawrow['Jaw'];
        array_push($jawarray, $Jaw);
    }
    if ($jawarray[0] == 1) {
        $checkbox = array("checkbox1"=> true, "checkbox2"=> false, "checkbox3"=> false, "checkbox4"=> false);
    }
    else if ($jawarray[1] == 1) {
        $checkbox = array("checkbox1"=> false, "checkbox2"=> true, "checkbox3"=> false, "checkbox4"=> false);
    }
    else if ($jawarray[2] == 1) {
        $checkbox = array("checkbox1"=> false, "checkbox2"=> false, "checkbox3"=> true, "checkbox4"=> false);
    }
    else if ($jawarray[3] == 1) {
        $checkbox = array("checkbox1"=> false, "checkbox2"=> false, "checkbox3"=> false, "checkbox4"=> true);
    }
    $row = mysqli_fetch_array($soalsql);
    $Soal = $row['Soal'];
    $array = array("Soal"=>$Soal, "pilih1"=> $piliharray[0], "pilih2"=> $piliharray[1], "pilih3"=> $piliharray[2], "pilih4"=> $piliharray[3]);
    $array = array_merge($array, $checkbox);
    header('Content-Type: application/json');
    $jsonresult = json_encode($array);
    echo $jsonresult;
}
?> 
