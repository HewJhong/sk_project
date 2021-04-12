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

$counter = 1;
$donecounter = 0;
$noplist = array();
$donenoplist = array();
$markahlist = array();
$muridlist = array();

echo "<div class='back-btn'><button class='btn btn-primary' onclick='resultpage();'>Balik</button></div>";
echo "<div class='text-center' style='margin-top: 20px;'><h2>Senarai Keputusan Murid</h2></div>";
echo "<div class='quiz-form-div'>";

$idtopik = $_POST['id'];
$sql1 = mysqli_query($conn, "SELECT * FROM topik WHERE (idtopik = '$idtopik')");
$row1 = mysqli_fetch_assoc($sql1);
$topik = $row1['topik'];
echo "<h4 class='text-center'>".$topik."</h4>";
echo "<br>";
$sql2 = mysqli_query($conn, "SELECT * FROM pengguna WHERE (peranan = 'murid')");
$muridcount = mysqli_num_rows($sql2);
$sql3 =  mysqli_query($conn, "SELECT * FROM perekodan WHERE (idtopik = '$idtopik')");
$undonemuridcount = mysqli_num_rows($sql3);
$donemuridcount = $muridcount - $undonemuridcount;

while ($row2 = mysqli_fetch_assoc($sql2)) {
  $nop = $row2['nop'];
  array_push($noplist, $nop);
}
while ($row3 = mysqli_fetch_assoc($sql3)) {
  $donenop = $row3['nop'];
  array_push($donenoplist, $donenop);
}
$missingnoplist = array_diff($noplist, $donenoplist);

echo "<h5>Bilangan murid yang siap: ".$donemuridcount."/".$muridcount."</h5>";
echo "<br>";
echo "<table style='width: 100%' class='tablesort'>
<thead>
<tr class='text-center' style='height:40px;'>
  <th style='width:50px'>No.</th>
  <th style='width:150px'>Nama</th>
  <th>Markah</th>
  <th>Gred</th>
  <th>Tarikh</th>
  <th>Status</th>
</tr>
</thead>
";

echo "<tbody>";
// Done students
foreach ($donenoplist as $nopvalue) {
  $sql4 = mysqli_query($conn, "SELECT * FROM pengguna WHERE (nop = '$nopvalue')");
  $row4 = mysqli_fetch_assoc($sql4);
  $notel = $row4['notel'];
  $sql5 = mysqli_query($conn, "SELECT * FROM telefon WHERE (notel = '$notel')");
  $row5 = mysqli_fetch_assoc($sql5);
  $nama = $row5['nama'];
  $sql6 = mysqli_query($conn, "SELECT * FROM perekodan WHERE (nop = '$nopvalue')");
  $row6 = mysqli_fetch_assoc($sql6);
  $markah = $row6['mar'];
  $gred = $row6['gred'];
  $tarikh = $row6['tar'];
  array_push($markahlist, $markah);
  array_push($muridlist, $nama);
  echo "
    <tr class='item'>
    <td>".$counter."</td>
    <td>".$nama."</td>
    <td>".$markah."</td>
    <td>".$gred."</td>
    <td>".$tarikh."</td>
    <td><i style='margin-top: 5px; margin-bottom: 5px;' class='fas fa-check-circle'></i></td>
    </tr>
  ";
  $counter ++;
}
// Undone students
foreach ($missingnoplist as $nopvalue) {
  $sql4 = mysqli_query($conn, "SELECT * FROM pengguna WHERE (nop = '$nopvalue')");
  $row4 = mysqli_fetch_assoc($sql4);
  $notel = $row4['notel'];
  $sql5 = mysqli_query($conn, "SELECT * FROM telefon WHERE (notel = '$notel')");
  $row5 = mysqli_fetch_assoc($sql5);
  $nama = $row5['nama'];
  echo "
    <tr class='item'>
    <td>".$counter."</td>
    <td>".$nama."</td>
    <td> - </td>
    <td> - </td>
    <td> - </td>
    <td><i style='margin-top: 5px; margin-bottom: 5px;' class='fas fa-times-circle'></i></td>
    </tr>
  ";
  $counter ++;
}
echo "</tbody>";
echo "</table>";

//Conversion
$muriddata = json_encode($muridlist);
$markahdata = json_encode($markahlist);
print_r ($markahdata);
// Chart
echo "<canvas id='myChart'></canvas>";
echo "<script>
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: $muriddata,
        datasets: [{
            label: 'Markah',
            backgroundColor: 'rgb(0, 107, 247)',
            borderColor: 'rgb(79, 195,245)',
            data: $markahdata
        }]
    },

    // Configuration options go here
    options: {
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