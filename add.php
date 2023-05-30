<?php
    session_start();
    if($_SESSION['user']){
    } else {
        header("location:index.php");
    }

    $mysql = mysqli_connect("mariadb", "drupal", "drupal", "drupal") or die(mysqli_error());

    if($_SERVER['REQUEST_METHOD'] == "POST"){
    $details = mysqli_real_escape_string($mysql, $_POST['details']);
    $time = date("H:i:s"); // Time.
    $date = date("M d, Y"); // Date.
    $desicion = "no";
    $date_edited = $date;
    $time_edited = $time;

    foreach($_POST['public'] as $each_check) { // Gets the data from the chekbox.
        if($each_check != null){    // Checks if checkbox is checked.
            $desicion= "yes";       // Sets the value.
        }
    }

    mysqli_query($mysql, "INSERT INTO list(details, date_posted, time_posted, date_edited, time_edited, public) VALUES ('$details','$date','$time', '$date_edited', '$time_edited', '$desicion')"); // SQL query.
    header("location:home.php");
    } else {
        header("location:home.php"); // Redirects back to home.
    }
?>
