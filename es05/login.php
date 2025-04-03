<?php
// Includi il file delle funzioni che contiene la funzione di login
include 'functions.php';

// Chiama la funzione di login con email e password, catturando i valori di ritorno
[$retval, $errmsg] = login($email, $passw);

// Prepara l'HTML del messaggio di errore se c'è un errore
$html = "<p class='error'>$from_msg</p>";
$html .= $html_form;
?>

<?php
// HTML del modulo di login
$html_form = <<FORM
<form action="$_SERVER[PHP_SELF]" method="post">
  <label for="email"> </label><input type="text" name="email" placeholder="Email" required/><br />
  <label for="password"> </label><input type="password" name="password" placeholder="Password" required/><br />
  <input type="submit" value="Login" /><input type="reset" value="Cancel" />
</form>
FORM;

// Prepara l'HTML di output, inclusi messaggi di errore e link
$html_out = "<p class='error' $errmsg</p>";
$html_out .= $html_form;
$html_out .= "Non hai un account? <a href='register.php'>Registrati adesso</a>";
$html_out .= "Hai dimenticato la password? <a href='pwd_reset.php'>Resetta la password</a>";
$html_out .= "<a href='index.php'>Torna alla Home Page</a>";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>
  <h2>Pagina di login</h2>
  <?=$html_out?>
</body>
</html>
