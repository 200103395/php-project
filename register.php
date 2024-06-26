<?php include 'openDbConn.php';
    include 'sanitizing.php';
    function validate($login, $firstName, $lastName, $passwd, $email, $news, $db) {
        $sql = "select count(*) as count from p2user where Login = '$login'";
        $res = $db -> query($sql);
        $row = $res->fetch_assoc();
        if($row['count'] > 0) {
            return false;
        }
        if(noSpecials($login, 15) === false) {
            return false;
        }
        if(noSpecials($firstName, 25) === false) {
            return false;
        }
        if(noSpecials($lastName, 60) === false) {
            return false;
        }
        if(noSpecials($passwd, 60) === false) {
            return false;
        }
        if(noSpecials($email, 40) === false) {
            return false;
        }
        if($news !== "no" && $news !== "yes") {
            return false;
        }
        return true;
    }


    if( $_SERVER["REQUEST_METHOD"] == "POST") {
        $login = $_POST["login"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $passwd = $_POST["passwd"];
        $email = $_POST["email"];
        $news = $_POST["newsLetter"];

        $valid = validate($login, $firstName, $lastName, $passwd, $email, $news, $db);
        if( $valid !== true) {
            echo $valid;
            exit();
        }

        $query = "INSERT INTO P2User (Login, FirstName, LastName, Passwd, Email, NewsLetter) values ('$login', '$firstName', '$lastName', '$passwd', '$email', '$news');";
        $result = $db -> query($query);
        if($result !== true) {
            echo "Error: registering account";
            exit();
        }
    }
    header("Location: index.php");
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Register</title>
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
    <form action="register.php" method="post">
        <label for="login">Login: </label>
        <input type="text" id="login" name="login" maxlength="15"><br>
        <label for="firstName">First Name: </label>
        <input type="text" id="firstName" name="firstName" maxlength="25"><br>
        <label for="lastName">Last Name: </label>
        <input type="text" id="lastName" name="lastName" maxlength="60"><br>
        <label for="passwd">Password: </label>
        <input type="password" id="passwd" name="passwd" maxlength="60"><br>
        <label for="email">Email: </label>
        <input type="text" id="email" name="email" maxlength="40"><br>
        <label for="newsLetter">News Letter: </label><br>
        <input type="radio" id="yes" name="newsLetter" value="yes" required>
        <label for="yes">Yes</label>
        <input type="radio" id="no" name="newsLetter" value="no">
        <label for="no">No</label><br>
        <input type="submit" value="Register">
    </form>
</div>
</body>
</html>
