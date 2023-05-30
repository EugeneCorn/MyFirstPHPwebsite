<html>
    <head>
        <title>My First PHP Site </title>
    </head>
    <body>
        <h2>Registration Page</h2>
        <a href="index.php"> Click here to go back </a><br/><br/>
        <form action="register.php" method="POST">
            Enter Username: <input type="text"
            name="username" required="required" /> <br/>
            Enter Password: <input type="password"
            name="password" required="required" /> <br/>
            <input type="submit" value="Register" />
        </form>
    </body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
                            //  host        user      password  database
        $mysql = mysqli_connect("mariadb", "drupal", "drupal", "drupal") or die(mysqli_error()); // Connection to a database server.
        $username = mysqli_real_escape_string($mysql, $_POST['username']);
        $password = mysqli_real_escape_string($mysql, $_POST['password']);
        $bool = true;

        $query = mysqli_query($mysql, "SELECT * FROM users"); // Query the users table.
        while($row = mysqli_fetch_array($query)) // display all rows from query.
        {
            $table_users == $row['username'];   // The first username row
                                                // is passed on to $table_users,
                                                // and so on until he query is finished.
            if($usernmae == $table_users) {     // Checks if there are any matching fields.
                $bool = false;
                print '<script>alert("Username has been taken!");</script>';        // Promts the user.
                print '<script>window.location.assign("register.php");</script>';   // Redirects to register.php.
            }
        }

    if($bool) // Checks if bool is true.
    {
        mysqli_query($mysql, "INSERT INTO users (username, password) VALUES ('$username', '$password')");
        print '<script>alert("Successfully Registered!");</script>'; // Promts the user.
        print '<script>window.location.assign("register.php");</script>'; // Redirects to register.php.
    }
}
?>
