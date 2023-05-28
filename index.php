<html>
    <head>
    <title>My First PHP Website</title>
    </head>
    <body>
        <?php
            echo "Hello World!";
        ?> </br> </br>
        <a href="login.php"> Click here to log in </a> <br/>
        <a href="register.php"> Click here to register </a> <br/>
    </body>
    <br />
    <h2 align="center">List</h2>
    <table width="100%" border="1px">
        <tr>
                <th>Id</th>
                <th>Details</th>
                <th>Post Time</th>
                <th>Edit Time</th>
        </tr>
        <?php
            $mysql = mysqli_connect("mariadb", "drupal", "drupal", "drupal") or die(mysqli_error()); // Connect to databse.
            $query = mysqli_query($mysql, "SELECT * FROM list WHERE public='yes'"); // SQL Query.
            while($row = mysqli_fetch_array($query)) {
                print "<tr>";
                    print '<td align="center">' . $row['id'] . "</td>";
                    print '<td align="center">' . $row['details'] . "</td>";
                    print '<td align="center">' . $row['date_posted'] . " " . $row['time_posted'] .  "</td>";
                    print '<td align="center">' . $row['date_edited'] . " " . $row['time_edited'] .  "</td>";
                print "</tr>";
            }
        ?>
    </table>
</html>
