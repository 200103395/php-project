<div id="menu">
    <div class="row">
        <div><a href="index.php">Landing Page</a></div>
        <?php
        include 'readSession.php';
        include 'openDbConn.php';
        if($logged === true) {
            $query = "select * from p2user where Login = '$login' limit 1;";
            $result = $db -> query($query);
            if($result->num_rows == 0) {
                session_destroy();
                header('Location: index.php');
                return;
            }
            $row = $result->fetch_assoc();
            $firstName = $row['FirstName'];
            $lastName = $row['LastName'];
            echo "<a href='account.php'><div>" . $firstName ."</div></a>";
            echo "<div>" . $lastName ."</div>";
            echo "<div><a href='logout.php'>Logout</a></div>";
            $logged = true;
        } else {
            echo "<div><a href='login.php'>Login</a></div>";
            echo "<div><a href='register.php'>Register</a></div>";
        }
        ?>
    </div>
</div>