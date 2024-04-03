<?php
    include 'openDbConn.php';
    include 'readSession.php';
    session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            padding: 0;
            margin: 0;
            background-color: cornsilk;
        }
        #menu {
            background-color: darkgray;
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }
        .row {
            display: flex;
            justify-content: center;
        }
        .row div {
            padding: 5px 10px;
            margin: 0 10px;
            font-size: 24px;
        }
        .container {
            width: 100%;
            box-sizing: border-box;
            display: flex;
            justify-content: space-between;
        }
        #shipping, #billing {
            width: 45%;
            background-color: coral;
        }
        .content {
            text-align: center;
            border: 1px solid #ccc;
            padding: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
            color: #333;
        }
        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .table tr:hover {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div id="menu">
        <div class="row">
        <?php
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
                echo "<div>" . $firstName ."</div>";
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
    <div class="container">
        <div id="shipping">
            <div class="content">
                <h2>Shipping Addresses</h2>
                <?php
                    $query = "select * from p2shipping where Login = '$login';";
                    $res = $db -> query($query);
                    if($res->num_rows == 0) {
                        echo "<h3>No addresses yet</h3>";
                    } else {
                        echo "<table class='table'>";
                        echo "<tr><th>ShippingID</th><th>Login</th><th>Name</th><th>Address</th><th>City</th><th>State</th><th>Zip</th><th>#</th><th>#</th></tr>";
                        while($row = $res->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>". $row['ShippingID'] ."</td>";
                            echo "<td>". $row['Login'] ."</td>";
                            echo "<td>". $row['Name'] ."</td>";
                            echo "<td>". $row['Address'] ."</td>";
                            echo "<td>". $row['City'] ."</td>";
                            echo "<td>". $row['State'] ."</td>";
                            echo "<td>". $row['Zip'] ."</td>";
                            echo "<td><a href=''>Update</a></td>";
                            echo "<td><a href=''>Delete</a></td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        // TODO: SHOW TABLE
                        // TODO: FOR EACH ROW SHOW UPDATE/DELETE BUTTONS
                    }
                    echo "<a href='shipping.php'><button>Add New Shipping Address</button></a>"
                ?>
            </div>
        </div>
        <div id="billing">
            <div class="content">
                <h2>Billing Information</h2>
            </div>
        </div>
    </div>
</body>
</html>
