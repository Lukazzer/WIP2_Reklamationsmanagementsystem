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
            <input type="text" id="orderNumber" placeholder="Bestellnummer eingeben...">
            <button onclick="getRetoureInfo()">OK</button>
        </div>
        <div class="container_faq">
            <details>
                <summary><strong>1. Wann darf ich einen Artikel zurücksenden?</strong></summary>
                <div>
                    Sie können einen Artikel zurücksenden, wenn er defekt oder beschädigt ist, nicht der bestellten Beschreibung entspricht oder Sie mit dem Produkt unzufrieden sind.
                    Bitte beachten Sie die spezifischen Rückgabebedingungen in unseren Geschäftsbedingungen.
                    <br><br>
                </div>
            </details>

            <details>
                <summary><strong>2. Wie lange habe ich Zeit, um eine Rücksendung zu veranlassen?</strong></summary>
                <div>
                    Die Rücksendefrist variiert je nach Produkt und Gründe für die Rücksendung. In der Regel haben Sie jedoch einen Monat ab dem Erhalt der Ware Zeit,
                    um eine Rücksendung zu initiieren. Überprüfen Sie bitte unsere Rückgaberichtlinien für genaue Informationen.
                    <br><br>
                </div>
            </details>

            <details>
                <summary><strong>3. Welche Artikel sind von der Rücksendung ausgeschlossen?</strong></summary>
                <div>
                    Einige Artikel könnten von der Rücksendung ausgeschlossen sein, wie z.B. personalisierte Produkte oder Waren,
                    die aus hygienischen Gründen nicht zurückgegeben werden können. Überprüfen Sie die Produktbeschreibung und unsere Geschäftsbedingungen,
                    um zu erfahren, ob Ihr Artikel rücksendefähig ist.
                    <br><br>
                </div>
            </details>

            <details>
                <summary><strong>4. Wie starte ich den Rücksendeprozess?</strong></summary>
                <div>
                    Um eine Rücksendung zu starten, gebe Sie oben ihre Bestellnummer ein und wählen die betreffenden Artikel aus und geben einen Grund an.
                    Alternativ können Sie unseren Kundendienst kontaktieren, um Unterstützung zu erhalten.
                    <br><br>
                </div>
            </details>

            <details>
                <summary><strong>5. Wie erfolgt die Rückerstattung nach einer Rücksendung?</strong></summary>
                <div>
                    Nachdem wir die zurückgesandte Ware erhalten und überprüft haben,
                    wird die Rückerstattung auf die ursprüngliche Zahlungsmethode oder als Gutschrift auf Ihr Kundenkonto ausgestellt.
                    Die Bearbeitungszeit kann je nach Zahlungsmethode variieren. Weitere Details finden Sie in unseren Rückerstattungsrichtlinien.
                    
                </div>
            </details>
        </div>
    </div>
</body>

</html>