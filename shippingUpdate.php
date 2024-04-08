<?php
    include 'openDbConn.php';
    include 'readSession.php';
    include 'sanitizing.php';

    $ShippingID = $_GET["ShippingID"];
    $LoginGet = $_GET["Login"];
    $Name = $_GET["Name"];
    $Address = $_GET["Address"];
    $City = $_GET["City"];
    $State = $_GET["State"];
    $Zip = $_GET["Zip"];
    $vars = 'ShippingID=' . $ShippingID . '&Login=' . $LoginGet . '&Name=' . $Name . '&Address=' . $Address . '&City=' . $City . '&State=' . $State . '&Zip=' . $Zip;
    if( $login !== $LoginGet) {
        header("Location: index.php");
        exit();
    }
    function validate($shippingID, $name, $address, $city, $state, $zip) {
        if(noSpecials($shippingID, 30) === false) {
            return false;
        }
        if(noSpecials($name, 50) === false) {
            return false;
        }
        if(noSpecials($address, 30) === false) {
            return false;
        }
        if(noSpecials($city, 30) === false) {
            return false;
        }
        if(noSpecials($state, 20) === false) {
            return false;
        }
        if(numberOnly($zip, 10) === false) {
            return false;
        }
        return true;
    }
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $shippingID = $_POST['shippingID'];
        $loginPost = $_POST['login'];
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
        $query = "update p2shipping set ShippingID = '$shippingID', Name='$name', Address='$address', City='$city', State='$state', Zip='$zip'
where ShippingID='$ShippingID' and Login='$LoginGet' and Name='$Name' and Address='$Address' and City='$City' and State='$State' and Zip='$Zip'";
        $result = $db -> query($query);
        header("Location: index.php");
        exit();
    }

    ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Shipping Address</title>
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
    </style>
</head>
<body>
<?php include 'menu.php';?>
    <div class="form">
        <form action="shippingUpdate.php?<?php echo $vars;?>" method="post">
            <label for="shippingID">Shipping ID: </label>
            <input type="text" id="shippingID" name="shippingID" maxlength="30" required value="<?php echo $ShippingID;?>"><br>
            <label for="login">Login: </label>
            <input type="text" id="login" name="login" maxlength="30" readonly value="<?php echo $login;?>"><br>
            <label for="name">Name: </label>
            <input type="text" id="name" name="name" maxlength="50" required value="<?php echo $Name;?>"><br>
            <label for="address">Address: </label>
            <input type="text" id="address" name="address" maxlength="30" required value="<?php echo $Address;?>"><br>
            <label for="city">City: </label>
            <input type="text" id="city" name="city" maxlength="30" required value="<?php echo $City;?>"><br>
            <label for="state">State: </label>
            <input type="text" id="state" name="state" maxlength="20" required value="<?php echo $State;?>"><br>
            <label for="zip">Zip: </label>
            <input type="text" id="zip" name="zip" maxlength="10" required value="<?php echo $Zip;?>"><br>
            <input type="submit" value="Update Shipping Address">
        </form>
    </div>
</body>
</html>
