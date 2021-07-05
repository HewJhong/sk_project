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

echo "
    <table style='width:100%'>
        <tr style='text-align:center;'>
            <th>No. Soalan</th>
            <th>Soalan</th>
            <th>Pilihan</th>
            <th>Jawapan</th>
            <th>Id Topik</th>
        </tr>
";

//Process form
if(isset($_FILES['file']['name'])){
if($_FILES['file']['name']){
    $handle = fopen($_FILES['file']['tmp_name'], "r");
    while($data = fgetcsv($handle)){
    $nosoal = mysqli_real_escape_string($conn, $data[0]);
    $soal = mysqli_real_escape_string($conn, $data[1]);
    $pilih = mysqli_real_escape_string($conn, $data[2]);
    $jaw = mysqli_real_escape_string($conn, $data[3]);
    $idtopik = mysqli_real_escape_string($conn, $data[4]);

    echo "
    <tr class=item>
        <td>$nosoal</td>
        <td>$soal</td>
        <td>$pilih</td>
        <td>$jaw</td>
        <td>$idtopik</td>
    </tr>
    ";
}
echo "</table>";
echo "
<br>
<div align='center'>
<button class='btn btn-primary' id='import-data-btn' type='submit'>Import</button>
</div>
";
fclose($handle);
}
}
//Close Connection
mysqli_close($conn);
?>