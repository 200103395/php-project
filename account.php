<?php
    include 'readSession.php';
    include 'openDbConn.php';
    if($logged === false) {
        header("Location: index.php");
        exit();
    }
    $query = "SELECT * FROM p2user where Login = '$login'";
    $res = $db -> query($query);
    if($res->num_rows == 0) {
        header("Location: index.php");
        exit();
    }
    $row = $res->fetch_assoc();
    $Login = $row['Login'];
    $FirstName = $row['FirstName'];
    $LastName = $row['LastName'];
    $Passwd = $row['Passwd'];
    $Email = $row['Email'];
    $News = $row['NewsLetter'];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title><?php echo $login; ?></title>
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
        .account {
            font-size: 24px;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .info {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }
        .label {
            flex: 1;
            font-weight: bold;
            padding-right: 10px;
        }
        .value {
            flex: 3;
        }
        .login {
            color: #333;
        }
        .email {
            color: blue;
        }
        .news {
            color: green;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .my-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .my-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php include 'menu.php';?>
<div class="account">
    <div class="info">
        <div class="label">Login:</div>
        <div class="value"><?php echo $login; ?></div>
    </div>
    <div class="info">
        <div class="label">First Name:</div>
        <div class="value"><?php echo $FirstName; ?></div>
    </div>
    <div class="info">
        <div class="label">Last Name:</div>
        <div class="value"><?php echo $LastName; ?></div>
    </div>
    <div class="info">
        <div class="label">Password:</div>
        <div class="value"><?php echo $Passwd; ?></div>
    </div>
    <div class="info">
        <div class="label">Email:</div>
        <div class="value"><?php echo $Email; ?></div>
    </div>
    <div class="info">
        <div class="label">News:</div>
        <div class="value"><?php echo $News; ?></div>
    </div>
</div>
<div class="button-container">
    <a href="accountChange.php"><button class="my-button">Change Account Information</button></a>
</div>
</body>
</html>
