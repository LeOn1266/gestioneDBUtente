<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Ricerca Bollette</title>
    <link rel="stylesheet" href="bolletteUtenze.css">
</head>
<body>
    <button onclick="location.href='index.html'" class="home-button">Torna alla Home</button>
    <h2>Ricerca Bollette</h2>
    <form method="POST" action="">
        <label for="data_inizio">Data Inizio:</label>
        <input type="date" id="data_inizio" name="data_inizio" required><br><br>

        <label for="data_fine">Data Fine:</label>
        <input type="date" id="data_fine" name="data_fine" required><br><br>

        <label for="cognome_utente">Cognome Utente:</label>
        <input type="text" id="cognome_utente" name="cognome_utente" required><br><br>

        <label for="id_utente">ID Utente:</label>
        <input type="text" id="id_utente" name="id_utente" required><br><br>

        <input type="submit" value="Ricerca Bollette">
    </form>

    <?php
    // Configurazione database
    $host = "localhost";
    $username = "root";
    $password = "";
    $db_nome = "utenze";
    $tab_nome_bollette = "bollette";
    $tab_nome_utenti = "utenti";
    
    // Connessione al database
    $conn = new mysqli($host, $username, $password, $db_nome);
    if ($conn->connect_errno) {
        echo "Impossibile connettersi al server: " . $conn->connect_errno . "\n";
        exit;
    }

    // Esegui la ricerca quando il form è inviato
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data_inizio = $_POST['data_inizio'];
        $data_fine = $_POST['data_fine'];
        $cognome_utente = $_POST['cognome_utente'];
        $id_utente = $_POST['id_utente'];

        // Query per cercare le bollette nell'intervallo di date, con cognome utente e id utente
        $sql = "SELECT bollette.Data, bollette.Consumo, bollette.Importo, utenti.Cognome
                FROM $tab_nome_bollette AS bollette
                JOIN $tab_nome_utenti AS utenti ON bollette.codUtente = utenti.Codice
                WHERE bollette.Data BETWEEN '$data_inizio' AND '$data_fine'
                AND utenti.Cognome = '$cognome_utente'
                AND utenti.Codice = '$id_utente'
                ORDER BY bollette.Data";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $totale_consumo = 0;
            $totale_importo = 0;
            echo "<div class='table-container'><table border='1'>
                    <tr>
                        <th>Data</th>
                        <th>Consumo</th>
                        <th>Importo</th>
                        <th>Cognome Utente</th>
                    </tr>";
            // Visualizza i risultati e calcola i totali
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["Data"] . "</td>
                        <td>" . $row["Consumo"] . "</td>
                        <td>" . $row["Importo"] . "</td>
                        <td>" . $row["Cognome"] . "</td>
                    </tr>";
                $totale_consumo += $row["Consumo"];
                $totale_importo += $row["Importo"];
            }
            echo "</table></div>";

            // Mostra il riepilogo
            echo "<h3>Riepilogo:</h3>";
            echo "Totale Consumo: " . $totale_consumo . " kWh<br>";
            echo "Totale Importo: € " . number_format($totale_importo, 2) . "<br>";
        } else {
            echo "Nessun risultato trovato per i criteri di ricerca.";
        }

        $result->free();
    }

    // Chiudi la connessione
    $conn->close();
    ?>
</body>
</html>
