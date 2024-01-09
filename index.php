<?php
$db_handle = pg_connect("host=postgresql-database-server.postgres.database.azure.com dbname=reklamation_db user=coolman password=6L_.?6=8T8a~]cy");
if ($db_handle) {
    // Daten abgreifen
    $query = "SELECT * FROM product";
    $result = pg_exec($db_handle, $query);

    // Nur wenn erfolgreich
    if ($result) {
        echo "result";

        // Jede Row durchgehen und die Spalte "name" printen
        for ($row = 0; $row < pg_numrows($result); $row++) {
            $data = pg_result($result, $row, 'name');
            echo $data . "<br>";
        }
    }

    pg_close($db_handle);

    // Weiterleitung zurück zur ursprünglichen Seite
    $script = "<script>window.location.href = 'https://reklamationsmaster.azurewebsites.net/BestellnummerEingabe/BestellnummerEingabe.php';</script>";
    echo $script;
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Willkommen</title>
</head>

<body>
    <header>
        <h1>Willkommen</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Startseite</a></li>
        </ul>
    </nav>

    <main>
        <p>Dies ist eine einfache PHP-Website. Willkommen!</p>
    </main>

    <footer>
        <p>&copy;
            <?php echo date("Y"); ?> Meine Text-Website. Alle Rechte vorbehalten.
        </p>
    </footer>
</body>

</html>