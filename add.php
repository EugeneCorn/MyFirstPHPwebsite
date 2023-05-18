<?php
    session_start();
    if($_SESSION['user']){
    } else {
        header("location:index.php");
    }
    $mysql = mysqli_connect("mariadb", "drupal", "drupal", "drupal") or die(mysql_error());
    $details = mysqli_real_escape_string($mysql, $_POST['details']);
    
    $time = date("H:i:s"); //time
    $date = date("M d, Y"); //date

    Print "$time - $date - $details";
?>
