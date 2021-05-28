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

$NoP = $_SESSION['NoP'];
$date = date("d/m/Y");

echo '
<script type="text/javascript">
var suffix = "AM";
function checkTime(i) {
  if (i < 10) {
    i = "0" + i;
  }
  return i;
}

function hrformat(x) {
  if (x > 12) {
    x = x - 12;
    suffix = "PM";
  } else {
    suffix = "AM";
  }
  return x;
}

function startTime() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  // add a zero in front of numbers<10
  m = checkTime(m);
  s = checkTime(s);
  // 12 hour format 
  h = hrformat(h);
  document.getElementById("time").innerHTML = h + ":" + m + ":" + s + " " + suffix;
  t = setTimeout(function() {
    startTime()
  }, 500);
}
startTime();    
</script>
';
echo "<div  class='quiz-form-div'>";

$sql1 = mysqli_query($conn, "SELECT * FROM pengguna WHERE (NoP = '$NoP')");
$row1 = mysqli_fetch_assoc($sql1);
$NoTel = $row1['NoTel'];
$sql2 = mysqli_query($conn, "SELECT * FROM telefon WHERE (NoTel = '$NoTel')");
$row2 = mysqli_fetch_assoc($sql2);
$Nama = $row2['Nama'];

echo "<img src='Profile Pic.jpg' alt='Avatar' style='display: block;width:200px;height:200px;margin-left: auto;margin-right: auto;'>";
echo "<br>";
echo "<h4 class='text-center' style:'text-align: center;'>Nama: ".$Nama."</h4>";
echo "<h4 class='text-center' style:'text-align: center;'>Nombor Telefon: ".$NoTel."</h4>";
echo "<h4 class='text-center' style:'text-align: center;'>".$date."</h4>";
echo "<h4 class='text-center' id='time'></h4>";
echo "</div>";
?>