<?php
    include 'openDbConn.php';
    include 'readSession.php';

    $ShippingID = $_GET["ShippingID"];
    $LoginGet = $_GET["Login"];
    $Name = $_GET["Name"];
    $Address = $_GET["Address"];
    $City = $_GET["City"];
    $State = $_GET["State"];
    $Zip = $_GET["Zip"];
    if( $login !== $LoginGet) {
        header("Location: index.php");
        exit();
    }
    $query = "delete from p2shipping
    where ShippingID='$ShippingID' and Login='$LoginGet' and Name='$Name' and Address='$Address' and City='$City' and State='$State' and Zip='$Zip'";
    $result = $db -> query($query);

    header("Location: index.php");
