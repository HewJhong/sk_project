<?php

session_start();
$fontSize = $_SESSION['fontSize'];
echo $fontSize;

if (isset($_POST['fontChangeAdd'])) {
    $fontSize = $_SESSION['fontSize'];
    $fontSize += 1;
    $_SESSION['fontSize'] = $fontSize;
    echo $fontSize;
    echo "Success";
}

if (isset($_POST['fontChangeMinus'])) {
    $fontSize = $_SESSION['fontSize'];
    $fontSize = $fontSize - 1;
    $_SESSION['fontSize'] = $fontSize;
    echo $fontSize;
    echo "Success";
}



?>