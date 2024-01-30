<?php

$db_handle = pg_connect("host=postgresql-database-server.postgres.database.azure.com dbname=reklamation_db user=coolman password=6L_.?6=8T8a~]cy");

// Prüft, ob Erstattungsdetails in den URL-Parametern vorhanden sind
if (isset($_GET['complaint_id'])) {
  $refundID = $_GET['complaint_id'];

  // Erstattungsdetails abrufen
  $query = "SELECT * FROM complaint WHERE id = $1";
  $result = pg_query_params($db_handle, $query, array($refundID));

  if ($result && pg_num_rows($result) > 0) {
    // Abrufen der Erstattungsdetails
    $refundDetails = pg_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['accept-button'])) {
        // Update status 'Accepted'
        $updateQuery = "UPDATE complaint SET status_id = 5 WHERE id = $1";
        pg_query_params($db_handle, $updateQuery, array($refundID));
        header("Location: ../MitarbeiterRetoureListe/MitarbeiterRetoureListe.php");
        exit;
      } elseif (isset($_POST['reject-button'])) {
        // Update status 'Rejected'
        $updateQuery = "UPDATE complaint SET status_id = 4 WHERE id = $1";
        pg_query_params($db_handle, $updateQuery, array($refundID));

        header("Location: ../MitarbeiterRetoureListe/MitarbeiterRetoureListe.php");
        exit;
      }
    }
  } else {
    echo '<script>alert("Retournummer invalide.");</script>';
    exit;
  }
} else {
  // (e.g., display an error message)
  echo '<script>alert("Retournummer invalide.");</script>';
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
      Retourenummer: <?php echo  $_GET['complaint_id'] ?>
    </div>
    <div class="container">

      <form method="post">
        <div class="refundDetails">

          <?php

          foreach (getProductInfoFromComplaintID($_GET['complaint_id']) as $data) {

            $retourenummer = $data['retourenummer'];
            $produktnummer = $data['produktnummer'];
            $produktname = $data['produktname'];
            $menge = $data['menge'];
            $grund = $data['grund'];
            $zugewiesenerMitarbeiter = $data['Zugewiesener Mitarbeiter'];
            $imagePath = $data['bildpfad'];


            echo '<div class="cell">';
            echo '<div class="product">';
            echo '<img src="' . '../img/' . $imagePath . '" alt="image" class="imagePreview" style="max-height: 134px;" >';
            echo '<div class="productInfo">';
            echo '<p>Produktnummer:            ' . $produktnummer . '</p>';
            echo '<p>Produktnanme:             ' . $produktname . '</p>';
            echo '<p>Menge:                    ' . $menge . '</p>';
            echo '<p>Grund:                    ' . $grund . '</p>';
            echo '<p>Zugewiesener Mitarbeiter: ' . $zugewiesenerMitarbeiter . '</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
          }





          ?>
        </div>

        <div class="action-buttons">
          <button type="submit" name="accept-button" class="accept-button">Retoure annehmen und Betrag erstatten</button>
          <button type="submit" name="reject-button" class="reject-button">Retour ablehnen und Kunden kontaktieren</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>