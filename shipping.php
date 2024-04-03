<?php
    include 'readSession.php';
    if(!$logged) {
        header('Location: index.php');
        exit();
    }
    include 'openDbConn.php';
    function validate($shippingID, $name, $address, $city, $state, $zip) {
        // TODO: VALIDATE
        return true;
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $shippingID = $_POST['shippingID'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $valid = validate($shippingID, $name, $address, $city, $state, $zip);
        if($valid !== true) {
            echo $valid;
            return;
        }
        $query = "insert into p2shipping(ShippingID, Login, Name, Address, City, State, Zip) values('$shippingID', '$login', '$name', '$address', '$city', '$state', '$zip');";
        $res = $db -> query($query);
        if(!$res) {
            echo "Error inserting values";
        } else {
            header("Location: index.php");
            exit();
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title id="title">Create Shipping Address</title>
</head>
<body>
    <div class="form">
        <form action="shipping.php" method="post">
            <label for="shippingID">Shipping ID: </label>
            <input type="text" id="shippingID" name="shippingID" maxlength="30" required><br>
            <label for="name">Name: </label>
            <input type="text" id="name" name="name" maxlength="50" required><br>
            <label for="address">Address: </label>
            <input type="text" id="address" name="address" maxlength="30" required><br>
            <label for="city">City: </label>
            <input type="text" id="city" name="city" maxlength="30" required><br>
            <label for="state">State: </label>
            <input type="text" id="state" name="state" maxlength="20" required><br>
            <label for="zip">Zip: </label>
            <input type="text" id="zip" name="zip" maxlength="10" required><br>
            <input type="submit" value="Create Shipping Address">
        </form>
    </div>
</body>
</html>
