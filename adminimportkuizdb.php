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

$getlastidsoal = mysqli_query($conn, "SELECT * FROM soalan ORDER BY LENGTH (IdSoal) DESC, IdSoal DESC LIMIT 1");
$existingidsoal = mysqli_fetch_array($getlastidsoal);
$stridsoal = ltrim($existingidsoal['IdSoal'], $soalprefix);
$intsoal = (int)$stridsoal;
$intsoal++;
$int1 = sprintf('%03d',$intsoal);
$int2 = sprintf('%03d',$intsoal+1);
$int3 = sprintf('%03d',$intsoal+2);
$int4 = sprintf('%03d',$intsoal+3);
$idsoal1 = $soalprefix.$int1;
$idsoal2 = $soalprefix.$int2;
$idsoal3 = $soalprefix.$int3;
$idsoal4 = $soalprefix.$int4;
$getlastnosoal = mysqli_query($conn, "SELECT * FROM soalan ORDER BY NoSoal DESC LIMIT 1");
$existingnosoal = mysqli_fetch_array($getlastnosoal);
$intnosoal = (int)$existingnosoal['NoSoal'];
$intnosoal++;


//Process form
if(isset($_FILES['file']['name'])){
	if($_FILES['file']['name']){
		$handle = fopen($_FILES['file']['tmp_name'], "r");
		while($data = fgetcsv($handle)){
			$counter ++;
			$datanosoal = mysqli_real_escape_string($conn, $data[0]);
			$soal = mysqli_real_escape_string($conn, $data[1]);
			$pilih = mysqli_real_escape_string($conn, $data[2]);
			$jaw = mysqli_real_escape_string($conn, $data[3]);
			$idtopik = mysqli_real_escape_string($conn, $data[4]);

			if ($counter == 1){
				$idsoal = $idsoal1;
			} else if ($counter == 2){
				$idsoal = $idsoal2;
			} else if ($counter == 3){
				$idsoal = $idsoal3;
			} else if ($counter == 4){
				$idsoal = $idsoal4;
			}


			$sql1 = mysqli_query($conn, "INSERT INTO soalan(IdSoal, NoSoal, Soal, Pilih, Jaw, IdTopik, ) 
			VALUES('$idsoal', '$intnosoal', '$soal', '$pilih','0','$idtopik')");

			if ($counter == 4) {
				$counter = 0;
				$intnosoal ++;
				$intsoal = $intsoal + 4;
				$int1 = sprintf('%03d',$intsoal);
				$int2 = sprintf('%03d',$intsoal+1);
				$int3 = sprintf('%03d',$intsoal+2);
				$int4 = sprintf('%03d',$intsoal+3);
				$idsoal1 = $soalprefix.$int1;
				$idsoal2 = $soalprefix.$int2;
				$idsoal3 = $soalprefix.$int3;
				$idsoal4 = $soalprefix.$int4;
			}
		
	}
	fclose($handle);
	}
}
echo "Import Successfully";
//Close Connection
mysqli_close($conn);
?>