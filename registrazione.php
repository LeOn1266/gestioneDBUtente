<?php
$host = "localhost";
$username = "root";
$password = "";
$db_nome = "utenze";
$conn = new mysqli($host, $username, $password, $db_nome);
if ($conn->connect_errno) {
    echo "Impossibile connettersi al server: " . $conn->connect_error . "\n";
    exit;
}
// acquisizione dati dal form HTML 
$cognome = $_POST["cognome"];
$nome = $_POST["nome"];
$citta = $_POST["citta"];
$email = strtolower($_POST["email"]);
$indirizzo = $_POST["indirizzo"];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
// comando SQL 
$sql = "INSERT INTO utenti (Cognome, Nome, Indirizzo, Citta, Email, Password) ";
$sql .= "VALUES ('$cognome', '$nome', '$indirizzo', '$citta', '$email', '$password')";
if ($conn->query($sql)) {
    echo "Utente registrato correttamente \n";
    header("Refresh: 3; URL= index.html");
} else {
    echo "Errore nella registrazione: " . $conn->error . "\n";
}
$conn->close();
?>
