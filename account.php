<?php
    include 'openDbConn.php';
    include 'readSession.php';
    if(!$logged) {
        header("Location: index.php");
        exit();
    }
    function validate($login, $firstName, $lastName, $passwd, $email, $news, $db) {
        //TODO: Validate account
        return true;
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
    if( $_SERVER["REQUEST_METHOD"] == "POST") {
        $login = $_POST["login"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $passwd = $_POST["passwd"];
        $email = $_POST["email"];
        $news = $_POST["newsLetter"];
        if($Login !== $login) {
            header("Location: index.php");
            exit();
        }

        $valid = validate($login, $firstName, $lastName, $passwd, $email, $news, $db);
        if( $valid !== true) {
            echo $valid;
            exit();
        }

        $query = "UPDATE P2User set FirstName='$firstName', LastName='$lastName', Passwd='$passwd', Email='$email', NewsLetter='$news' where Login='$login';";
        $result = $db -> query($query);
        if($result !== true) {
            echo "Error: registering account";
            exit();
        }
        header("Location: index.php");
    }


?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Account Settings</title>
</head>
<body>
<div class="form">
    <form action="account.php" method="post">
        <label for="login">Login: </label>
        <input type="text" id="login" name="login" readonly value="<?php echo $Login; ?>" maxlength="15"><br>
        <label for="firstName">First Name: </label>
        <input type="text" id="firstName" name="firstName" value="<?php echo $FirstName; ?>" maxlength="25"><br>
        <label for="lastName">Last Name: </label>
        <input type="text" id="lastName" name="lastName" value="<?php echo $LastName; ?>" maxlength="60"><br>
        <label for="passwd">Password: </label>
        <input type="password" id="passwd" name="passwd" value="<?php echo $Passwd; ?>" maxlength="60"><br>
        <label for="email">Email: </label>
        <input type="text" id="email" name="email" value="<?php echo $Email; ?>" maxlength="40"><br>
        <label for="newsLetter">News Letter: </label><br>
        <input type="radio" id="yes" name="newsLetter" value="yes" <?php if ($News == 'yes') echo 'checked'; ?> required>
        <label for="yes">Yes</label>
        <input type="radio" id="no" name="newsLetter" value="no"<?php if ($News == 'no') echo 'checked'; ?> >
        <label for="no">No</label><br>
        <input type="submit" value="Change Information">
    </form>
</div>
</body>
</html>
