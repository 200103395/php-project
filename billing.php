<?php
include 'readSession.php';
if(!$logged) {
    header('Location: index.php');
    exit();
}
include 'openDbConn.php';
include 'sanitizing.php';
function validate($billingID, $name, $address, $city, $state, $zip, $cardType, $cardNumber, $expDate) {
    if(noSpecials($billingID, 30) === false) {
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
    if($cardType !== "Visa" && $cardType !== "MasterCard" && $cardType !== "Discover" && $cardType !== "American Express") {
        return false;
    }
    if(numberOnly($cardNumber, 16) === false) {
        return false;
    }
    if(isValidDate($expDate) === false) {
        return false;
    }
    return true;
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $billingID = $_POST['billingID'];
    $name = $_POST['billName'];
    $address = $_POST['billAddress'];
    $city = $_POST['billCity'];
    $state = $_POST['billState'];
    $zip = $_POST['billZip'];
    $cardType = $_POST['cardType'];
    $cardNumber = $_POST['cardNumber'];
    $expDate = $_POST['expDate'];
    $valid = validate($billingID, $name, $address, $city, $state, $zip, $cardType, $cardNumber, $expDate);
    if($valid !== true) {
        echo $valid;
        return;
    }
    $query = "insert into p2billing(BillingID, Login, BillName, BillAddress, BillCity, BillState, BillZip, CardType, CardNumber, ExpDate) values('$billingID', '$login', '$name', '$address', '$city', '$state', '$zip', '$cardType', '$cardNumber', '$expDate');";
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
    <title id="title">Create Billing Information</title>
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
        }</style>
</head>
<body>
<div class="form">
    <?php include 'menu.php'?>
    <form action="billing.php" method="post">
        <label for="billingID">Billing ID: </label>
        <input type="text" id="billingID" name="billingID" maxlength="30" required><br>
        <label for="billName">Bill Name: </label>
        <input type="text" id="billName" name="billName" maxlength="50" required><br>
        <label for="billAddress">Bill Address: </label>
        <input type="text" id="billAddress" name="billAddress" maxlength="30" required><br>
        <label for="billCity">Bill City: </label>
        <input type="text" id="billCity" name="billCity" maxlength="30" required><br>
        <label for="billState">Bill State: </label>
        <input type="text" id="billState" name="billState" maxlength="20" required><br>
        <label for="billZip">Bill Zip: </label>
        <input type="text" id="billZip" name="billZip" maxlength="10" required><br>
        <label for="cardType">Card Type: </label>
        <select name="cardType" id="cardType">
            <option value="Visa">Visa</option>
            <option value="MasterCard">MasterCard</option>
            <option value="Discover">Discover</option>
            <option value="American Express">American Express</option>
        </select><br>
        <label for="cardNumber">Card Number: </label>
        <input type="text" id="cardNumber" name="cardNumber" maxlength="16" required><br>
        <label for="expDate">Exp Date: </label>
        <input type="text" id="expDate" name="expDate" maxlength="5" required><br>
        <input type="submit" value="Create Billing Information">
    </form>
</div>
</body>
</html>
