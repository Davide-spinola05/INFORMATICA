<?php
session_start();
$login_msg="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_ok = "davide";
    $password_ok = "d5";

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == $username_ok && $password == $password_ok) {
        $_SESSION['username'] = $username;
        header("Location: riservata.php");
        exit();
    } else {
        $login_msg="<p style='color:red;'>Credenziali errate. Riprova.</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="login.php" method="post">
        <label for="username">Nome Utente:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Accedi">
    </form>

    <?= $login_msg ?>

</body>
</html>
