<?php
session_start();

$mysql = mysqli_connect("mariadb", "drupal", "drupal", "drupal") or die(mysqli_error());

$username = mysqli_real_escape_string($mysql, $_POST['username']);
$password = mysqli_real_escape_string($mysql, $_POST['password']);
$bool = true;

$query = mysqli_query($mysql, "SELECT * FROM users WHERE username='$username'"); // Query the users table .

$exists = mysqli_num_rows($query); //Checks if username exists.
$table_users = "";
$table_password = "";
if ($exists > 0) {
    while($row= mysqli_fetch_assoc($query)) { // Display all rows from query.
        $table_users = $row['username'];
        $table_password = $row['password'];
    }
    if($username == $table_users) { // Checks if there are any matching fields.
        if($password == $table_password){
            $_SESSION['user'] = $username;
            header("location: home.php");
        }
    } else {
        Print '<script>alert("Incorrect password!");</script>'; // Promts the user.
        Print '<script>window.location.assign("login.php");</script>'; // Redirects to login.php
    }
} else {
    Print '<script>alert("Incorrect username!");</script>'; // Promts the user.
    Print '<script>window.location.assign("login.php");</script>'; // Redirects to login.php
}
?>
