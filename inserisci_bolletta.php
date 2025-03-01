<!DOCTYPE html>
<html>
<head>
    <title>Inserisci Bolletta</title>
    <link rel="stylesheet" href="inserisci_bolletta.css">
</head>
<body>
    <button onclick="location.href='index.html'" class="home-button">Torna alla Home</button>
    <h2>Inserisci Bolletta</h2>
    <form method="post" action="">
        <label for="data">Data:</label>
        <input type="date" id="data" name="data" required><br><br>
        <label for="consumo">Consumo:</label>
        <input type="text" id="consumo" name="consumo" required><br><br>
        <label for="importo">Importo:</label>
        <input type="text" id="importo" name="importo" required><br><br>
        <label for="codice_utente">Codice Utente:</label>
        <input type="text" id="codice_utente" name="codice_utente" required><br><br>
        <input type="submit" value="Inserisci Bolletta">
    </form>
    <?php
        $host = "localhost";
        $username = "root";
        $password = "";
        $db_nome = "utenze";
        $tab_nome = "utenti";

        // connessione al database lato server
        $conn = new mysqli($host, $username, $password, $db_nome);
        if ($conn->connect_errno){
            echo "Impossibile connettersi al server: " . $conn->connect_errno . "\n";
            exit;
        }

        // Se il form è stato inviato, inserisci i dati nel database
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = $_POST['data'];
            $consumo = $_POST['consumo'];
            $importo = $_POST['importo'];
            $codice_utente = $_POST['codice_utente'];

            $sql = "INSERT INTO bollette (Data, Consumo, Importo, codUtente) VALUES ('$data', '$consumo', '$importo', '$codice_utente')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Nuova bolletta inserita con successo</p>";
            } else {
                echo "Errore: " . $sql . "<br>" . $conn->error;
            }
        }
    ?>
</body>
</html>



