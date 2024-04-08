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
    <title>Landing Page</title>
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
            background-color: white;
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
    <?php include 'menu.php'?>
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
                            $vars = 'ShippingID=' . $row['ShippingID'] . '&Login=' . $row['Login'] . '&Name=' . $row['Name'] . '&Address=' . $row['Address'] . '&City=' . $row['City'] . '&State=' . $row['State'] . '&Zip=' . $row['Zip'];
                            echo "<td><a href='shippingUpdate.php?${vars}'>Update</a></td>";
                            echo "<td><a href='shippingDelete.php?${vars}'>Delete</a></td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                    echo "<a href='shipping.php'><button>Add New Shipping Address</button></a>"
                ?>
            </div>
        </div>
        <div id="billing">
            <div class="content">
                <h2>Billing Information</h2>
                <?php
                $query = "select * from p2billing where Login = '$login';";
                $res = $db -> query($query);
                if($res->num_rows == 0) {
                    echo "<h3>No information yet</h3>";
                } else {
                    echo "<table class='table'>";
                    echo "<tr><th>BillingID</th><th>Login</th><th>BillName</th><th>BillAddress</th><th>BillCity</th><th>BillState</th><th>BillZip</th><th>CardType</th><th>CardNumber</th><th>ExpDate</th><th>#</th><th>#</th></tr>";
                    while($row = $res->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>". $row['BillingID'] ."</td>";
                        echo "<td>". $row['Login'] ."</td>";
                        echo "<td>". $row['BillName'] ."</td>";
                        echo "<td>". $row['BillAddress'] ."</td>";
                        echo "<td>". $row['BillCity'] ."</td>";
                        echo "<td>". $row['BillState'] ."</td>";
                        echo "<td>". $row['BillZip'] ."</td>";
                        echo "<td>". $row['CardType'] ."</td>";
                        echo "<td>". $row['CardNumber'] ."</td>";
                        echo "<td>". $row['ExpDate'] ."</td>";
                        $vars = 'BillingID=' . $row['BillingID'] . '&Login=' . $row['Login'] . '&BillName=' . $row['BillName'] . '&BillAddress=' . $row['BillAddress'] . '&BillCity=' . $row['BillCity'] . '&BillState=' . $row['BillState'] . '&BillZip=' . $row['BillZip'] . '&CardType=' . $row['CardType'] . '&CardNumber=' . $row['CardNumber'] . '&ExpDate=' . $row['ExpDate'];
                        echo "<td><a href='billingUpdate.php?${vars}'>Update</a></td>";
                        echo "<td><a href='billingDelete.php?${vars}'>Delete</a></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                echo "<a href='billing.php'><button>Add New Billing Information</button></a>"
                ?>
            </div>
        </div>
    </div>
</body>
</html>
