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
$email = '';
$errors = array();


// if user clicks on the sign up button
if (isset($_POST['signup-btn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];
    // $sql = "INSERT INTO pengguna (username, email, password) VALUES ('hew', 'test@email.com', 'testpass')";
    //validation
    if (empty($username)) {
        $errors['username'] = "Username required";
    }
    if (empty($username)) {
        $errors['username'] = "Username required";
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
        // $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO pengguna (username, role, password) VALUES ('$username', 'murid', '$password')";
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
    
    //validation
    if (empty($username)) {
        $errors['username'] = "Username required";
    }
    if (empty($password)) {
        $errors['password'] = "Password required";
    }

    if (count($errors) === 0) {
        $result = mysqli_query($conn, "select * from pengguna where username ='$username' AND password = '$password'") 
        or die("Failed to query database" .mysql_error());
        $row = mysqli_fetch_array($result);
        $admin = "admin";
        $murid = "murid";
        if($row['username'] == $username && $row['password'] == $password) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];
            header("Location: main.php");
        }  else {
            $errors['loginfail'] = "Login Failed";
        }
    }
}

?>
</body>
</html>
