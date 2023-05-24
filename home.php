<hmtl>
    <head>
        <title>My first PHP website</title>
    </head>
    <?php
    session_start(); // Starts the session.
    if($_SESSION['user']){  // Check if the user log in.
    } else {
        header("location: index.php"); // Redirects if user is not logged in.
    }
    $user = $_SESSION['user']; //Assigns user value.
    ?>
    <body>
        <h2>Home Page</h2>
        <p>Hello <?php Print "$user"?>!</p> <!-- Displays user's nname -->
        <a href="logout.php">Click here to go logout</a><br/><br/>
        <form action="add.php" method="POST">
            Add more to list: <input type="text" name="details" /> <br/>
            Public post? <input type="checkbox" name="public[]" value="yes" /> <br/>
            <input type="submit" value="Add to list" />
        </form>
        <h2 align="center">My list</h2>
        <table border="1px" width="100%">
            <tr>
                <th>Id</th>
                <th>Details</th>
                <th>Post Time</th>
                <th>Edit Time</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Public Post</th>
            </tr>
            <?php
                $mysql = mysqli_connect("mariadb", "drupal", "drupal", "drupal") or die(mysqli_error());
                
                $query = mysqli_query($mysql, "Select * from list");
                while($row = mysqli_fetch_array($query)) {
                    print "<tr>";
                        print '<td align="center">' . $row['id'] . "</tr>";
                        print '<td align="center">' . $row['details'] . "</td>";
                        print '<td align="center">' . $row['date_posted'] . " - " . $row['time_posted'] . "</td>";
                        print '<td align="center">' . $row['date_edited'] . " - " . $row['time_edited'] . "</td>";
                        print '<td align="center"><a href="edit.php">edit</a> </td>';
                        print '<td align="center"><a href="delete.php">delete</a> </td>';
                        print '<td align="center">' . $row['public'] . "</td>";
                    print "</tr>";
                }
            ?>
        </table>
    </body>
</html>
