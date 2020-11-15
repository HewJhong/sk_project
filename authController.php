<html>
<body>
<?php

session_start();

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "spkm";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("Database error: " . $conn->connect_error);
}

$username = '';
$notel = '';
$errors = array();


// if user clicks on the sign up button
if (isset($_POST['signup-btn'])) {
    $username = $_POST['username'];
    $notel = $_POST['notel'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];
    //validation
    if (empty($username)) {
        $errors['username'] = "Username required";
    }
    if (empty($notel)) {
        $errors['telefonnumber'] = "Telefon Number required";
    }
    if(preg_match("/^[0]{1}[1]{1}[0-9]{1}-[0-9]{7}$/", $notel) || preg_match("/^[0]{1}[1]{1}[0-9]{1}-[0-9]{8}$/", $notel)) {
    } else {
        $errors['telefonnumber'] = "Wrong Telefon Number format";
    }
    if (empty($password)) {
        $errors['password'] = "Password required";
    }
    if (empty($passwordConf)) {
        $errors['passwordConf'] = "Please confirm your password";
    }
    if ($password != $passwordConf) {
        $errors['password'] = 'The two password do not match!';
    }

    if (count($errors) === 0) {
        $sql = "INSERT INTO pengguna (username, notel, role, password) VALUES ('$username', '$notel', 'murid', '$password')";
        if ($conn->query($sql) === TRUE) {
            header("Location: login.php");
          } else {
            $errors['duplicate'] = "Your have already signed up or your username has been taken";
          }
          $conn->close();
    } 
}

// if user clicks on the login button
if (isset($_POST['login-btn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $notel = $_POST['username'];
    
    //validation
    if (empty($username)) {
        $errors['username'] = "Username required";
    }
    if (empty($password)) {
        $errors['password'] = "Password required";
    }

    if (count($errors) === 0) {
        $result = mysqli_query($conn, "select * from pengguna where (username ='$username' AND password = '$password') OR (notel ='$notel' AND password = '$password')") 
        or die("Failed to query database" .mysql_error());
        $row = mysqli_fetch_array($result);
        $admin = "admin";
        $murid = "murid";
        if(($row['notel'] == $notel  && $row['password'] == $password) ||  ($row['username'] == $username && $row['password'] == $password)) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['notel'] = $row['notel'];
            header("Location: main.php");
        }  else {
            $errors['loginfail'] = "Login Failed";
        }         
    }
}

?>
</body>
</html>
