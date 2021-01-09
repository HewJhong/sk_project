<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "spkm";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("Database error: " . $conn->connect_error);
}

/// For adminkuizlist.php edit button
if(isset($_POST["nosoal"])) {
    $piliharray = array();
    $jawarray = array();
    $checkbox = array();
    $array = array();
    $nosoal = $_POST['nosoal'];
    $pilihsql = mysqli_query($conn, "SELECT * FROM soalan WHERE (nosoal='$nosoal')");
    $soalsql = mysqli_query($conn, "SELECT * FROM soalan WHERE (nosoal='$nosoal')");
    $jawsql = mysqli_query($conn, "SELECT * FROM soalan WHERE (nosoal='$nosoal')");
    while ($pilihrow = mysqli_fetch_assoc($pilihsql)) {
        $pilih = $pilihrow['pilih'];
        array_push($piliharray, $pilih);
    }
    while ($jawrow = mysqli_fetch_assoc($jawsql)) {
        $jaw = $jawrow['jaw'];
        array_push($jawarray, $jaw);
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
    $soal = $row['soal'];
    $array = array("soal"=>$soal, "pilih1"=> $piliharray[0], "pilih2"=> $piliharray[1], "pilih3"=> $piliharray[2], "pilih4"=> $piliharray[3]);
    $array = array_merge($array, $checkbox);
    header('Content-Type: application/json');
    $jsonresult = json_encode($array);
    echo $jsonresult;
}
?> 
