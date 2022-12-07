<?php
    session_start();

    if(!isset($_SESSION["login"])) {
        header("Location: index.php");
        exit;
    }

    require 'connect.php';

    $id_game = $_GET['id_game'];
    $id_user = $_SESSION['id'];
    
    $insert = mysqli_query($conn, "INSERT INTO details VALUES ('','$id_user','$id_game')");
    header("Location: mygames.php");
    exit;
?>