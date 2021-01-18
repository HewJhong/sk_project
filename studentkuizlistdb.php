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

$sql1 = mysqli_query($conn, "SELECT * FROM topik");
$nosoallist = array();
$gotsoal = array();
$nop = $_SESSION['nop'];

while ($row1 = mysqli_fetch_assoc($sql1)) {
    $nosoallist = [];
    $idtopik = $row1['idtopik'];
    $sql3 = mysqli_query($conn, "SELECT topik FROM topik WHERE (idtopik = '$idtopik')");
    $row3 = mysqli_fetch_assoc($sql3);
    $sql2 = mysqli_query($conn, "SELECT * FROM soalan WHERE (idtopik = '$idtopik')");
    $sql3 = mysqli_query($conn, "SELECT * FROM perekodan WHERE (idtopik = '$idtopik' AND nop = '$nop')");
    $rekodnum = mysqli_num_rows($sql3);
    while ($row2 = mysqli_fetch_assoc($sql2)) {
        $nosoal = $row2['nosoal'];
        array_push($nosoallist, $nosoal);
    }
    $nosoalarray = array_unique($nosoallist);
    $numsoal = count($nosoalarray);
    if ($rekodnum > 0) {
      $numsoal = 0;
    }
    if ($numsoal >= 1) {
        array_push($gotsoal, "1");
        echo "<button class='collapsible btn'>".$row3['topik']."</button>";
            echo "<div class='content'>";
                echo "<div class='row'>";
                    echo "<h4 class='col-sm collapsible-content'> Bilangan Soalan dalam kuiz ini: ".$numsoal."</h4>";
                    echo "<a style='color: black;' class='col-sm-3 btn btn-primary edit-soal-btn' id='".$idtopik."'>Jawab Kuiz</a>";
                echo "</div>";
            echo "</div>";
    }
    else {
        array_push($gotsoal, "0");
    }
}

if(!in_array("1", $gotsoal)) {
    echo"<h3 class='text-center'>Tiada soalan...</h3>";
}

echo " 
    <script>
    var coll = document.getElementsByClassName('collapsible');
    var i;

    for (i = 0; i < coll.length; i++) {
      coll[i].addEventListener('click', function() {
        this.classList.toggle('active');
        var content = this.nextElementSibling;
        if (content.style.maxHeight){
          content.style.maxHeight = null;
        } else {
          content.style.maxHeight = content.scrollHeight + 'px';
        } 
      });
    }
    </script>
    ";
