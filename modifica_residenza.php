<!DOCTYPE html>
<html lang="it">
<head>
    <title>Modifica Residenza</title>
    <link rel="stylesheet" href="modifica_residenza.css">
</head>
<body>
    <h1>Modifica Residenza Utente</h1>
    <form method="post">
        <label for="utente_id">ID Utente:</label>
        <input type="text" id="utente_id" name="utente_id" required><br>
        <label for="nuovo_indirizzo">Nuovo Indirizzo:</label>
        <input type="text" id="nuovo_indirizzo" name="nuovo_indirizzo" required><br>
        <label for="nuova_citta">Nuova Città:</label>
        <input type="text" id="nuova_citta" name="nuova_citta" required><br>
        <input type="submit" value="Modifica">
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
    $utente_id = $_POST['utente_id'];
    $nuovo_indirizzo = $_POST['nuovo_indirizzo'];
    $nuova_citta = $_POST['nuova_citta'];

    // Ensure the column name matches the actual column name in the database
    $sql = "UPDATE utenti SET Indirizzo='$nuovo_indirizzo', Citta='$nuova_citta' WHERE Codice='$utente_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Residenza utente modificata con successo</p>";
    } else {
        echo "<p>Errore: " . $sql . "<br></p>" . $conn->error;
    }

    $conn->close();
}
?>