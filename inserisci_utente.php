<!DOCTYPE html>
<html lang="it">
<head>
    <title>Nuovo Utente</title>
    <link rel="stylesheet" href="inserisci_utente.css">
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
    <button onclick="location.href='index.html'" class="home-button">Torna alla Home</button>
</body>
</html>
<?php
$localhost = "localhost";
$root = "root";
$password = "";
$dbname = "utenze";

$conn = new mysqli($localhost, $root, $password, $dbname);

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
        echo "<p>Nuovo utente inserito con successo</p>";
    } else {
        echo "Errore: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
