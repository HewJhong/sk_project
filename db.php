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

$nop = $_POST['nop'];
$peranan = $_POST['peranan'];

if(mysqli_query($conn, "INSERT INTO pengguna (nop, peranan) VALUES ('$nop', '$peranan')")) {
  echo "Successfully inserted";
} else {
  echo "Insertion failed";
}

