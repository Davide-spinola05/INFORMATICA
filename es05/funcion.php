<?php
// Funzione per gestire il login dell'utente
// Parametri: $username (stringa), $password (stringa)
function login($username, $password) {
  
    // Controlla se username e password sono impostati
    if(! isset($username, $password)) 
      return array(false, "Inserire le proprie credenziali e premere il pulsante login.");
      
    // Controlla se username o password sono vuoti
    if(empty($username) || empty($password)) 
      return array(false, "Inserire le proprie credenziali e premere il pulsante login.");
    
    // Stabilire una connessione al database
    [$retval,$pdodb] = _pdodb_connection();
    if(!$retval) {
      return array(false, $pdodb); // Restituisci errore se la connessione fallisce
    } //TODO: solo per debug
  
    try {
      // Prepara la query SQL per selezionare i dati dell'utente
      $sql = "SELECT id, username, password FROM members WHERE username=:username LIMIT 1";
      $stmt = $pdodb->prepare($sql);
      $retval = $stmt->bindParam(':username', $username, PDO::PARAM_STR);
      $retval = $stmt->execute();
      $rowCount = $stmt->rowCount();
  
      // Controlla se l'utente esiste
      if($rowCount == 1) {
        // L'utente esiste, recupera i dati dell'utente
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $db_userid = $row['id'];
        $db_username = $row['username'];
        $db_password = $row['password'];
        
        // Verifica che la password fornita corrisponda a quella memorizzata
        if($db_password == $password) { 
          // Login riuscito
          $_SESSION['userid'] = $db_userid; 
          $_SESSION['username'] = $db_username;
          return array(true, "Login eseguito correttamente");
        } else {
          // Password errata
          $_SESSION['userid'] = null;
          return array(false, "Attenzione! Password sbagliata.");
        }
      } else {
        // L'utente non esiste
        $_SESSION['userid'] = null;
        return array(false, "Attenzione! L'utente inserito non esiste.");
      }  
      
    } catch (Exception $e) {
      // Gestisci le eccezioni e restituisci un messaggio di errore
      return array(false, "Attenzione! Errore: " . $e->getMessage());
    }
}
?>
