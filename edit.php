<html>
    <head>
        <title>My first PHP Wesite</title>
    </head>
    <?php
    session_start();    // Starts the session.
    if($_SESSION['user']){ // Checks if the user is logged in.
    } else {
        header("location: index.php"); // Redirects if user is not logged in.
    }
    $user = $_SESSION['user']; // Assigns user value.
    ?>
    <body>
        <h2>Home Page</h2>
        <p>Hello <?php Print "$user"?>!</p> <!-- Display's user name. -->
        <a href="logout.php">Click here to go logout</a><br/><br/>
        <a href="home.php">Return to home page</a>
        <h2 align="center">Currently Selected</h2>
        <table border="1px" width="100%">
            <tr>
                <th>Id</th>
                <th>Details</th>
                <th>Post Time</th>
                <th>Edit Time</th>
                <th>Public Post</th>
            </tr>
            <?php
                if(!empty($_GET['id'])) {
                    $id = $_GET['id'];
                    $_SESSION['id'] = $id;
                    $id_exists = true;
                    
                    $mysql = mysqli_connect("mariadb", "drupal", "drupal", "drupal") or die(mysqli_error()); // Connect to MySQL server.
                    $query = mysqli_query($mysql, "SELECT * FROM list WHERE id='$id'"); // SQL Query.
                    $count = mysqli_num_rows($query);
                    if($count > 0) {
                        while($row = mysqli_fetch_array($query)) {
                            print "<tr>";
                                print '<td align="center">' . $row['id'] . "</td>";
                                print '<td align="center">' . $row['details'] . "</td>";
                                print '<td align="center">' . $row['date_posted'] . " - " . $row['time_posted'] . "</td>";
                                print '<td align="center">' . $row['date_edited'] . " _ " . $row['time_edited'] . "</td>";
                                print '<td align="center">' . $row['public'] . "</td>";
                            print "</tr>";
                        }
                    } else {
                        $id_exists = false;
                    }
                }
            ?>
        </table>
        <br/>
        <?php
        if($id_exists) {
            print '
            <form action="edit.php" method="post">
                Enter new detail: <input type="text" name="details"/><br/>
                public post? <input type="checkbox" name="public[]" value="yes"/><br/>
                <input type="submit" value="Update List"/>
            </form>
            ';
        } else {
            Print '<h2 align="center">There is no data to be edited.</h2>';
        }
        ?>
    </body>
</html>

<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $mysql = mysqli_connect("mariadb", "drupal", "drupal", "drupal") or die(mysqli_error()); // Connect to MySQL server.
        $details = mysqli_real_escape_string($mysql, $_POST['details']);
        $public = "no";
        $id = $_SESSION['id'];
        $time = date("H:i:s"); // Time.
        $date = date("M d, Y"); // Date.

        foreach($_POST['public'] as $list) {
            if($list != null) {
                $public = "yes";
            }
        }

        mysqli_query($mysql, "UPDATE list SET details='$details', public='$public', date_edited='$date', time_edited='$time' WHERE id='$id'");
        header("location:home.php");
    }
?>
