<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rückgabe der Bestellung</title>
    <link rel="stylesheet" href="BestellnummerEingabe.css">

    <link rel="stylesheet" href="../Design/design.css">

    <?php
    include '../Design/design.php';
    ?>
</head>

<body>
    <div class="container_body">
        <div class="container_header">
            Retoure anfordern
        </div>
        <div class="container_orderNumber">
            <form method="post" action="">
                <input type="text" id="orderNumber" name="orderNumber" placeholder="Bestellnummer eingeben...">
                <button type="submit" name="orderNumberBtn">OK</button>
            </form>
        </div>
        <div class="container_faq">
            <details>
                <summary><strong>1. Wann darf ich einen Artikel zurücksenden?</strong></summary>
                <div>
                    Sie können einen Artikel zurücksenden, wenn er defekt oder beschädigt ist, nicht der bestellten
                    Beschreibung entspricht oder Sie mit dem Produkt unzufrieden sind.
                    Bitte beachten Sie die spezifischen Rückgabebedingungen in unseren Geschäftsbedingungen.
                    <br><br>
                </div>
            </details>

            <details>
                <summary><strong>2. Wie lange habe ich Zeit, um eine Rücksendung zu veranlassen?</strong></summary>
                <div>
                    Die Rücksendefrist variiert je nach Produkt und Gründe für die Rücksendung. In der Regel haben Sie
                    jedoch einen Monat ab dem Erhalt der Ware Zeit,
                    um eine Rücksendung zu initiieren. Überprüfen Sie bitte unsere Rückgaberichtlinien für genaue
                    Informationen.
                    <br><br>
                </div>
            </details>

            <details>
                <summary><strong>3. Welche Artikel sind von der Rücksendung ausgeschlossen?</strong></summary>
                <div>
                    Einige Artikel könnten von der Rücksendung ausgeschlossen sein, wie z.B. personalisierte Produkte
                    oder Waren,
                    die aus hygienischen Gründen nicht zurückgegeben werden können. Überprüfen Sie die
                    Produktbeschreibung und unsere Geschäftsbedingungen,
                    um zu erfahren, ob Ihr Artikel rücksendefähig ist.
                    <br><br>
                </div>
            </details>

            <details>
                <summary><strong>4. Wie starte ich den Rücksendeprozess?</strong></summary>
                <div>
                    Um eine Rücksendung zu starten, gebe Sie oben ihre Bestellnummer ein und wählen die betreffenden
                    Artikel aus und geben einen Grund an.
                    Alternativ können Sie unseren Kundendienst kontaktieren, um Unterstützung zu erhalten.
                    <br><br>
                </div>
            </details>

            <details>
                <summary><strong>5. Wie erfolgt die Rückerstattung nach einer Rücksendung?</strong></summary>
                <div>
                    Nachdem wir die zurückgesandte Ware erhalten und überprüft haben,
                    wird die Rückerstattung auf die ursprüngliche Zahlungsmethode oder als Gutschrift auf Ihr
                    Kundenkonto ausgestellt.
                    Die Bearbeitungszeit kann je nach Zahlungsmethode variieren. Weitere Details finden Sie in unseren
                    Rückerstattungsrichtlinien.

                </div>
            </details>
        </div>
    </div>

    <?php
    if (isset($_POST['orderNumberBtn'])) {
        $db_handle = connectdb();

        if ($db_handle) {
            // Hole die eingegebene Bestellnummer und bereinige sie von möglichen schädlichen Zeichen
            $orderNumber = pg_escape_string($db_handle, $_POST['orderNumber']);

            // Vorbereitete Anweisung zur Überprüfung der Bestellnummer
            $result = pg_prepare($db_handle, "my_query", 'SELECT * FROM customer_product WHERE id = $1');
            $result = pg_execute($db_handle, "my_query", array($orderNumber));

            if ($result) {
                if (pg_numrows($result) > 0) {
                    $checkComplaint = pg_prepare($db_handle, "query_complaint", 'SELECT * FROM complaint_customer_product WHERE customer_product_id = $1');
                    $checkComplaint = pg_execute($db_handle, "query_complaint", array($orderNumber));
        
                    if ($checkComplaint && pg_num_rows($checkComplaint) == 0) {
                        // Weiterleitung mit URL-Parameter, wenn die Bestellnummer noch nicht in complaint_customer_product existiert
                        $redirectUrl = "https://reklamationsmaster.azurewebsites.net/BestellungEinsehen/BestellungEinsehen.php?redirected=true&orderNumber=" . urlencode($orderNumber);
                        $script = "<script>window.location.href = '{$redirectUrl}';</script>";
                        echo $script;
                        exit;
                    }
                    else 
                    {
                        echo "<script>alert('Diese Bestellung wird zurzeit bearbeitet!');</script>";
                    }
                } else {
                    echo "<script>alert('Bestellnummer nicht gefunden.');</script>";
                }
            } else {
                echo "<script>alert('Fehler bei der Ausführung der Abfrage.');</script>";
            }

            pg_close($db_handle);
        } else {
            echo "<script>alert('Verbindung zur Datenbank fehlgeschlagen.');</script>";
        }
    }
    ?>
    
</body>

</html>