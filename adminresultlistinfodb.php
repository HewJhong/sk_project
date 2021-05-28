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
$NoPlist = array();
$doneNoPlist = array();
$markahlist = array();
$muridlist = array();

echo "<div class='back-btn'><button class='btn btn-primary' onclick='resultpage();'>Balik</button></div>";
echo "<div class='text-center' style='margin-top: 20px;'><h2>Senarai Keputusan Murid</h2></div>";
echo "<div class='quiz-form-div'>";

$IdTopik = $_POST['id'];
$sql1 = mysqli_query($conn, "SELECT * FROM Topik WHERE (IdTopik = '$IdTopik')");
$row1 = mysqli_fetch_assoc($sql1);
$Topik = $row1['Topik'];
echo "<h4 class='text-center'>".$Topik."</h4>";
echo "<br>";
$sql2 = mysqli_query($conn, "SELECT * FROM pengguna WHERE (Peranan = 'murid')");
$muridcount = mysqli_num_rows($sql2);
$sql3 =  mysqli_query($conn, "SELECT * FROM perekodan WHERE (IdTopik = '$IdTopik')");
$undonemuridcount = mysqli_num_rows($sql3);
$donemuridcount = $muridcount - $undonemuridcount;

while ($row2 = mysqli_fetch_assoc($sql2)) {
  $NoP = $row2['NoP'];
  array_push($NoPlist, $NoP);
}
while ($row3 = mysqli_fetch_assoc($sql3)) {
  $doneNoP = $row3['NoP'];
  array_push($doneNoPlist, $doneNoP);
}
$missingNoPlist = array_diff($NoPlist, $doneNoPlist);

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
foreach ($doneNoPlist as $NoPvalue) {
  $sql4 = mysqli_query($conn, "SELECT * FROM pengguna WHERE (NoP = '$NoPvalue')");
  $row4 = mysqli_fetch_assoc($sql4);
  $NoTel = $row4['NoTel'];
  $sql5 = mysqli_query($conn, "SELECT * FROM telefon WHERE (NoTel = '$NoTel')");
  $row5 = mysqli_fetch_assoc($sql5);
  $Nama = $row5['Nama'];
  $sql6 = mysqli_query($conn, "SELECT * FROM perekodan WHERE (NoP = '$NoPvalue')");
  $row6 = mysqli_fetch_assoc($sql6);
  $markah = $row6['Mar'];
  $Gred = $row6['Gred'];
  $tarikh = $row6['Tar'];
  array_push($markahlist, $markah);
  array_push($muridlist, $Nama);
  echo "
    <tr class='item'>
    <td>".$counter."</td>
    <td>".$Nama."</td>
    <td>".$markah."</td>
    <td>".$Gred."</td>
    <td>".$tarikh."</td>
    <td><i style='margin-top: 5px; margin-bottom: 5px;' class='fas fa-check-circle'></i></td>
    </tr>
  ";
  $counter ++;
}
// Undone students
foreach ($missingNoPlist as $NoPvalue) {
  $sql4 = mysqli_query($conn, "SELECT * FROM pengguna WHERE (NoP = '$NoPvalue')");
  $row4 = mysqli_fetch_assoc($sql4);
  $NoTel = $row4['NoTel'];
  $sql5 = mysqli_query($conn, "SELECT * FROM telefon WHERE (NoTel = '$NoTel')");
  $row5 = mysqli_fetch_assoc($sql5);
  $Nama = $row5['Nama'];
  echo "
    <tr class='item'>
    <td>".$counter."</td>
    <td>".$Nama."</td>
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