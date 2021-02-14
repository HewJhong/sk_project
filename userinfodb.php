<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "spkm";

session_start();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$nop = $_SESSION['nop'];
$date = date("d/m/Y");

echo '
<script type="text/javascript">
function checkTime(i) {
  if (i < 10) {
    i = "0" + i;
  }
  return i;
}

function startTime() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  // add a zero in front of numbers<10
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById("time").innerHTML = h + ":" + m + ":" + s;
  t = setTimeout(function() {
    startTime()
  }, 500);
}
startTime();    
</script>
';
echo "<div  class='quiz-form-div'>";

$sql1 = mysqli_query($conn, "SELECT * FROM pengguna WHERE (nop = '$nop')");
$row1 = mysqli_fetch_assoc($sql1);
$notel = $row1['notel'];
$sql2 = mysqli_query($conn, "SELECT * FROM telefon WHERE (notel = '$notel')");
$row2 = mysqli_fetch_assoc($sql2);
$nama = $row2['nama'];

echo "<img src='Profile Pic.jpg' alt='Avatar' style='display: block;width:200px;height:200px;margin-left: auto;margin-right: auto;'>";
echo "<br>";
echo "<h4 class='text-center' style:'text-align: center;'>Nama: ".$nama."</h4>";
echo "<h4 class='text-center' style:'text-align: center;'>Nombor Telefon: ".$notel."</h4>";
echo "<h4 class='text-center' style:'text-align: center;'>".$date."</h4>";
echo "<h4 class='text-center' id='time'></h4>";
echo "</div>";
?>