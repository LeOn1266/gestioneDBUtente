<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuovo Utente</title>
</head>
<body>
    <h1>Inserisci Nuovo Utente</h1>
    <form method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>
        <label for="cognome">Cognome:</label>
        <input type="text" id="cognome" name="cognome" required><br>
        <label for="indirizzo">Indirizzo:</label>
        <input type="text" id="indirizzo" name="indirizzo" required><br>
        <label for="citta">Città:</label>
        <input type="text" id="citta" name="citta" required><br>
        <input type="submit" value="Salva">
    </form>
</body>
</html>
<?php
$localhost = "localhost";
$root = "root";
$password = "";
$dbname = "utenze";

// Create connection
$conn = new mysqli($localhost, $root, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $indirizzo = $_POST['indirizzo'];
    $citta = $_POST['citta'];

    $sql = "INSERT INTO utenti (Nome, Cognome, Indirizzo, Citta) VALUES ('$nome', '$cognome', '$indirizzo', '$citta')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuovo utente inserito con successo";
    } else {
        echo "Errore: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
