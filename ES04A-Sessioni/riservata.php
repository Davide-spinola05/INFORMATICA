
<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }
    ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <h1>Benvenuto, <?php echo $_SESSION['username']; ?>!</h1>
    <p><a href="logout.php">Logout</a></p>
    <title>Area Riservata</title>
</head>
</html>
