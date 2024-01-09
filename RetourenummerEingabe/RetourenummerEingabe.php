<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rückgabe der Bestellung</title>
    <link rel="stylesheet" href="RetourenummerEingabe.css">
    <link rel="stylesheet" href="../Design/design.css">

    <?php
    include '../Design/design.php';
    ?>
</head>

<body>
    <div class="container_body">
        <div class="container_header">
            Retoure einsehen
        </div>
        <div class="container_content">
            <input type="text" id="refundID" placeholder="Retourenummer eingeben...">
            <button onclick="getRetoureInfo()">OK</button>
        </div>
    </div>
</body>

</html>