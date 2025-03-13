<!DOCTYPE html>
<html lang="it">
<head>
    <title>Report Consumi per Città</title>
    <link rel="stylesheet" href="report_consumi.css">
</head>
<body>
    <button onclick="location.href='index.html'" class="home-button">Torna alla Home</button>
    <h2>Report Consumi per Città</h2>
    <form method="POST" action="">
        <label for="data_inizio">Data Inizio:</label>
        <input type="date" id="data_inizio" name="data_inizio" required><br><br>
        
        <label for="data_fine">Data Fine:</label>
        <input type="date" id="data_fine" name="data_fine" required><br><br>
        
        <input type="submit" value="Genera Report">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $host = "localhost";
        $username = "root";
        $password = "";
        $db_nome = "utenze";
        
        // Connessione al database
        $conn = new mysqli($host, $username, $password, $db_nome);
        if ($conn->connect_errno) {
            echo "Impossibile connettersi al server: " . $conn->connect_errno . "\n";
            exit;
        }

        $data_inizio = $_POST['data_inizio'];
        $data_fine = $_POST['data_fine'];

        // Query per ottenere i consumi per città
        $sql = "SELECT utenti.Citta, SUM(bollette.Consumo) AS TotaleConsumo
                FROM bollette
                JOIN utenti ON bollette.codUtente = utenti.Codice
                WHERE bollette.Data BETWEEN '$data_inizio' AND '$data_fine'
                GROUP BY utenti.Citta";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h3>Report Consumi per Citta' dal $data_inizio al $data_fine:</h3>";
            echo "<table border='1'>
                    <tr>
                        <th>Citta'</th>
                        <th>Totale Consumo (kWh)</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["Citta"] . "</td>
                        <td>" . $row["TotaleConsumo"] . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "Nessun risultato trovato per il periodo selezionato.";
        }

        $result->free();
        $conn->close();
    }
    ?>
</body>
</html>
