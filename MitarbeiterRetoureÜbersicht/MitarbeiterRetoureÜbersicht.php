<?php

$db_handle = pg_connect("host=postgresql-database-server.postgres.database.azure.com dbname=reklamation_db user=coolman password=6L_.?6=8T8a~]cy");

// Prüft, ob Erstattungsdetails in den URL-Parametern vorhanden sind
if (isset($_GET['refund_id'])) {
    $refundID = $_GET['refund_id'];

    // Erstattungsdetails abrufen
    $query = "SELECT * FROM refunds WHERE refund_id = $1";
    $result = pg_query_params($db_handle, $query, array($refundID));

    if ($result && pg_num_rows($result) > 0) {
        // Abrufen der Erstattungsdetails
        $refundDetails = pg_fetch_assoc($result);

        if (isset($_POST['accept-button'])) {
          // Update status 'Accepted'
          $updateQuery = "UPDATE refunds SET status = 'Accepted' WHERE refund_id = $1";
          pg_query_params($db_handle, $updateQuery, array($refundID));

          exit;
      } elseif (isset($_POST['reject-button'])) {
          // Update status 'Rejected'
          $updateQuery = "UPDATE refunds SET status = 'Rejected' WHERE refund_id = $1";
          pg_query_params($db_handle, $updateQuery, array($refundID));

          exit;
      }
    } else {
        
        echo "Retourenummer ist nicht gefunden.";
        exit;
    }
} else {
    // (e.g., display an error message)
    echo "Retourenummer nicht vorhanden.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="MitarbeiterRetoureÜbersicht.css">
  <link rel="stylesheet" href="../Design/design.css">

  <?php
  include '../Design/design.php';
  ?>
  <title>Bearbeitung von Mitarbeitererstattungen</title>
</head>

<body>

  <?php

  $imagePath = '../BestellungEinsehen/aspirin.png';
  ?>
  <div class="container_body">
    <div class="container_header">
      Retourenummer: 12322
    </div>
    <div class="container">


      <div class="refundDetails">
        <div class="product">
          <img src="<?php echo $imagePath; ?>" alt="image" class="imagePreview">
          <div class="productInfo">
            <p>Name: Aspirin Protect 100mg</p>
            <p>Nummer: 12322232</p>
            <p>Menge: 2</p>
            <p>Grund: Defektes Produkt</p>
          </div>
        </div>
      </div>

      <div class="action-buttons">
        <button class="accept-button">Retoure annehmen und Betrag erstatten</button>
        <button class="reject-button">Retour ablehnen und Kunden kontaktieren</button>
      </div>
    </div>
  </div>
</body>

</html>