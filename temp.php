<?php
session_start();



// Handle login request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
}

// Handle logout request
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple PHP Authentication</title>
</head>
<body>
<h1>Welcome</h1>
<?php if (!isset($_SESSION['username'])) : ?>
    <a href="login.php">Login</a> | <a href="register.php">Register</a>
<?php else : ?>
    <p>You are logged in as <?php echo $_SESSION['username']; ?>. <a href="index.php?logout=true">Logout</a></p>
<?php endif; ?>
</body>
</html>
