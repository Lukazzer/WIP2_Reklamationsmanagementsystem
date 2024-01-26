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

    <?php
    $db_handle = pg_connect("host=postgresql-database-server.postgres.database.azure.com dbname=reklamation_db user=coolman password=6L_.?6=8T8a~]cy");

    function getRefundInfo($refundID, $db_handle) {
        $query = "SELECT * FROM refunds WHERE refund_id = $1";
        $result = pg_query_params($db_handle, $query, array($refundID));
    
        if ($result) {
            return pg_fetch_assoc($result);
        } else {
            return false;
        }
    }

    if (isset($_GET['refundID'])) {
        $refundID = $_GET['refundID'];
    
        // Informationen zur Erstattung erhalten
        $refundInfo = getRefundInfo($refundID, $db_handle);
    
        if ($refundInfo) {
            
            $encodedRefundInfo = json_encode($refundInfo);
            header("Location: https://reklamationsmaster.azurewebsites.net/MitarbeiterRetoureÜbersicht/MitarbeiterRetoureÜCbersicht.php?refundInfo=$encodedRefundInfo");
            exit;
        } else {
            echo "Retourenummer ist nicht gefunden.";
        }
    }

    ?>
    
</body>

</html>