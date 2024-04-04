<?php include 'openDbConn.php';
session_start();
$expiration_time = 3600; // 1 HOUR

if (isset($_SESSION['login'])) {
    $username = $_SESSION['login'];
    echo "You are already logged in as $username. <a href='logout.php'>Logout</a>";
    exit;
}

function authenticate($login, $passwd, $db) {
    $query = "select * from P2User where login = '$login' limit 1;";
    $request = $db -> query($query);
    if($request->num_rows == 0) {
        return "Error: authentication error";
    }
    $row = $request->fetch_assoc();
    if($passwd == $row['Passwd']) {
        return true;
    } else {
        return false;
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $passwd = $_POST['passwd'];

    $valid = authenticate($login, $passwd, $db);
    if($valid === true) {
        $_SESSION['login'] = $login;
        session_set_cookie_params($expiration_time);
        header('Location: index.php');
        exit;
    } else {
        echo "Invalid username or password. Please try again.";
    }
    header("Location: index.php");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="form">
        <form action="login.php" method="post">
            <label for="login">Login: </label>
            <input type="text" id="login" name="login"><br><br>
            <label for="passwd">Password: </label>
            <input type="password" id="passwd" name="passwd"><br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
