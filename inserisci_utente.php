<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuovo Utente</title>
</head>
<body>
    <h1>Inserisci Nuovo Utente</h1>
    <form method="post" action="salva_utente.php">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>
        <label for="cognome">Cognome:</label>
        <input type="text" id="cognome" name="cognome" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="telefono">Telefono:</label>
        <input type="tel" id="telefono" name="telefono" required><br>
        <input type="submit" value="Salva">
    </form>
</body>
</html>