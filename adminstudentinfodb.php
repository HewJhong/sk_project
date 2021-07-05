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

$totalmarkah = 0;
$markahlist = array();
$topiklist = array();
$counter = 1;
$donecounter = 0;

echo "<div class='back-btn'><button class='btn btn-primary' onclick='studentlistpage();'>Balik</button></div>";
echo "<div class='text-center' style='margin-top: 20px;'><h2>Info Murid</h2></div>";
echo "<div  class='quiz-form-div'>";
echo "";

$idtopiklist = array();
$doneidtopiklist = array();

$NoP = $_POST['id'];
echo "<div><h5>Nombor Pengguna: ".$NoP."</h5></div>";
$sql1 = mysqli_query($conn, "SELECT * FROM pengguna WHERE (NoP = '$NoP')");
$row1 = mysqli_fetch_assoc($sql1);
$NoTel = $row1['NoTel'];
$sql2 = mysqli_query($conn, "SELECT * FROM telefon WHERE (NoTel = '$NoTel')");
$row2 = mysqli_fetch_assoc($sql2);
$Nama = $row2['Nama']; 
echo "<div><h5>Nama: ".$Nama."</h5></div>";
$sql3 = mysqli_query($conn, "SELECT * FROM soalan");
while ($row3 = mysqli_fetch_assoc($sql3)) {
    $IdTopik = $row3['IdTopik'];
    array_push($idtopiklist, $IdTopik);
}
$idtopikarray = array_unique($idtopiklist);
$sql4 = mysqli_query($conn, "SELECT * FROM perekodan WHERE (NoP = '$NoP')");
while ($row4 = mysqli_fetch_assoc($sql4)) {
    $IdTopik = $row4['IdTopik'];
    array_push($doneidtopiklist, $IdTopik);
}
$doneidtopikarray = array_unique($doneidtopiklist);
$missingidtopikarray = array_diff($idtopikarray, $doneidtopikarray);
echo "<br>";
echo "<div><h5>Kerja Rumah: </h5></div>";
echo "<table style='width: 100%' class='tablesort'>
<thead>
<tr class='text-center' style='height:40px;'>
  <th style='width:50px'>No.</th>
  <th style='width:150px'>Topik</th>
  <th>Markah</th>
  <th>Gred</th>
  <th>Tarikh</th>
  <th>Status</th>
</tr>
</thead>
";
echo "<tbody>";
foreach ($doneidtopikarray as $value) {
  $sql5 = mysqli_query($conn, "SELECT * FROM perekodan WHERE (IdTopik = '$value')");
  $row5 = mysqli_fetch_assoc($sql5);
  $markah = $row5['Mar'];
  $tarikh =$row5['Tar'];
  $totalmarkah += $markah;
  array_push($markahlist, $markah);
  $Gred = $row5['Gred'];
  $sql6 = mysqli_query($conn, "SELECT * FROM Topik WHERE (IdTopik = '$value')");
  $row6 = mysqli_fetch_assoc($sql6);
  $Topik = $row6['Topik'];
  array_push($topiklist, $Topik);
  echo "<tr class='item'>";
  echo "<td>".$counter."</td>";
  echo "<td>".$Topik."</td>";
  echo "<td>".$markah."</td>";
  echo "<td>".$Gred."</td>";
  echo "<td>".$tarikh."</td>";
  echo "<td><i style='margin-top: 5px; margin-bottom: 5px;' class='fas fa-check-circle'></i></td>";
  echo "</tr>";
  echo "<tr class='spacer'></tr>";
  $counter ++;
  $donecounter ++;
}
$topikdata = json_encode($topiklist);
$markahdata = json_encode($markahlist);
foreach ($missingidtopikarray as $value) {
  $sql7 = mysqli_query($conn, "SELECT * FROM Topik WHERE (IdTopik = '$value')");
  $row7 = mysqli_fetch_assoc($sql7);
  $Topik = $row7['Topik'];
  echo "<tr class='item'>";
  echo "<td>".$counter."</td>";
  echo "<td>".$Topik."</td>";
  echo "<td>N/A</td>";
  echo "<td>N/A</td>";
  echo "<td>N/A</td>";
  echo "<td><i style='margin-top: 5px; margin-bottom: 5px;' class='fas fa-times-circle'></i></td>";
  echo "</tr>";
  echo "<tr class='spacer'></tr>";
  $counter ++;
}
echo "</tbody>";
echo "</table>";

echo "<div>";
echo "<br>";
if ($totalmarkah <= 0) {
  $avgmar = "-";
} else {
  $avgmar = $totalmarkah / $donecounter;
  $avgmar = number_format((float)$avgmar, 2, '.', '');
}
echo "<h5>Purata Markah: ".$avgmar."</h5>";
echo "</div>";
echo "<br>";
echo "<canvas id='myChart' height='100'></canvas>";
echo "<script>
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: $topikdata,
        datasets: [{
            label: 'Markah',
            backgroundColor: 'rgb(0, 107, 247)',
            borderColor: 'rgb(79, 195,245)',
            data: $markahdata
        }]
    },

    // Configuration options go here
    options: {
      responsive: true,
      scales: {
        yAxes: [{
            ticks: {
                suggestedMin: 0,
                suggestedMax: 100
            }
        }]
      }
    }
});
</script>
";
echo "</div>"; 
?>