<?php
include 'openDbConn.php';
include 'readSession.php';
include 'sanitizing.php';

$BillingID = $_GET["BillingID"];
$LoginGet = $_GET["Login"];
$BillName = $_GET["BillName"];
$BillAddress = $_GET["BillAddress"];
$BillCity = $_GET["BillCity"];
$BillState = $_GET["BillState"];
$BillZip = $_GET["BillZip"];
$CardType = $_GET["CardType"];
$CardNumber = $_GET["CardNumber"];
$ExpDate = $_GET["ExpDate"];
if( $login !== $LoginGet) {
    header("Location: index.php");
    exit();
}
$vars = 'BillingID=' . $BillingID . '&Login=' . $LoginGet . '&BillName=' . $BillName . '&BillAddress=' . $BillAddress . '&BillCity=' . $BillCity . '&BillState=' . $BillState . '&BillZip=' . $BillZip . '&CardType=' . $CardType . '&CardNumber=' . $CardNumber . '&ExpDate=' . $ExpDate;

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
if($_SERVER['REQUEST_METHOD'] == "POST") {
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
    $query = "update p2billing set BillingID = '$billingID', BillName='$name', BillAddress='$address', BillCity='$city', BillState='$state', BillZip='$zip', CardType='$cardType', CardNumber='$cardNumber', ExpDate='$expDate'
 where BillingID='$BillingID' and Login='$LoginGet' and BillName='$BillName' and BillAddress='$BillAddress' and BillCity='$BillCity' and BillState='$BillState' and BillZip='$BillZip' and CardType='$CardType' and CardNumber='$CardNumber' and ExpDate='$ExpDate'";
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
    <title>Update Billing Information</title>
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
<?php include 'menu.php';?>
<div class="form">
    <form action="billingUpdate.php?<?php echo $vars;?>" method="post">
        <label for="billingID">Billing ID: </label>
        <input type="text" id="billingID" name="billingID" maxlength="30" required value="<?php echo $BillingID;?>"><br>
        <label for="login">Login: </label>
        <input type="text" id="login" name="login" maxlength="30" readonly value="<?php echo $login;?>"><br>
        <label for="billName">Bill Name: </label>
        <input type="text" id="billName" name="billName" maxlength="50" required value="<?php echo $BillName;?>"><br>
        <label for="billAddress">Bill Address: </label>
        <input type="text" id="billAddress" name="billAddress" maxlength="30" required value="<?php echo $BillAddress;?>"><br>
        <label for="billCity">Bill City: </label>
        <input type="text" id="billCity" name="billCity" maxlength="30" required value="<?php echo $BillCity;?>"><br>
        <label for="billState">Bill State: </label>
        <input type="text" id="billState" name="billState" maxlength="20" required value="<?php echo $BillState;?>"><br>
        <label for="billZip">Bill Zip: </label>
        <input type="text" id="billZip" name="billZip" maxlength="10" required value="<?php echo $BillZip;?>"><br>
        <label for="cardType">Card Type: </label>
        <select name="cardType" id="cardType">
            <option value="Visa" <?php if($CardType == "Visa") echo "selected"; ?>>Visa</option>
            <option value="MasterCard" <?php if($CardType == "MasterCard") echo "selected"; ?>>MasterCard</option>
            <option value="Discover" <?php if($CardType == "Discover") echo "selected"; ?>>Discover</option>
            <option value="American Express" <?php if($CardType == "American Express") echo "selected"; ?>>American Express</option>
        </select><br>
        <label for="cardNumber">Card Number: </label>
        <input type="text" id="cardNumber" name="cardNumber" maxlength="16" required value="<?php echo $CardNumber;?>"><br>
        <label for="expDate">Exp Date: </label>
        <input type="text" id="expDate" name="expDate" maxlength="5" required value="<?php echo $ExpDate;?>"><br>
        <input type="submit" value="Update Billing Information">
    </form>
</div>
</body>
</html>
