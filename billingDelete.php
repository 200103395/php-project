<?php
    include 'openDbConn.php';
    include 'readSession.php';

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
    $query = "delete from p2billing
        where BillingID='$BillingID' and Login='$LoginGet' and BillName='$BillName' and BillAddress='$BillAddress' and BillCity='$BillCity' and BillState='$BillState' and BillZip='$BillZip' and CardType='$CardType' and CardNumber='$CardNumber' and ExpDate='$ExpDate'";
    $result = $db -> query($query);

    header("Location: index.php");
