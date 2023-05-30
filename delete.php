<?php
    session_start(); // Starts the session.
    if($_SESSION['user']){ // Check if the user is logged in.
    } else {
        header("location:index.php"); // Redirects if user is not logged in.
    }

    if($_SERVER['REQUEST_METHOD'] == "GET") {
        $mysql = mysqli_connect("mariadb", "drupal", "drupal", "drupal") or die(mysqli_error()); // Connect to database.
        $id = $_GET['id'];
        mysqli_query($mysql, "DELETE FROM list WHERE id='$id'");
        header("location:home.php");
    }
?>
