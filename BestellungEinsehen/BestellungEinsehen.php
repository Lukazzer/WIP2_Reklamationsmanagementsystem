<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="BestellungEinsehen.css">
  <link rel="stylesheet" href="../Design/design.css">

  <?php
  include '../Design/design.php';
  ?>
  <title>Formular für Erstattungsanträge</title>

  <?php
  if (isset($_GET['redirected']) && $_GET['redirected'] == 'true' && isset($_GET['orderNumber'])) {
    // Die Seite wurde vom Skript weitergeleitet
    $orderNumber = $_GET['orderNumber'];

    $db_handle = pg_connect("host=postgresql-database-server.postgres.database.azure.com dbname=reklamation_db user=coolman password=6L_.?6=8T8a~]cy");
    $orderNumber = $_GET['orderNumber']; // Die Bestellnummer aus der URL
  
    // Vorbereiten und Ausführen der SQL-Abfrage
    $query = "SELECT p.id, p.name, p.img_path, cp.quantity FROM product p INNER JOIN customer_product cp ON p.id = cp.product_id WHERE cp.id = $1";
    $result = pg_prepare($db_handle, "my_query", $query);
    $result = pg_execute($db_handle, "my_query", array($orderNumber));

    if ($result) {
      $row = pg_fetch_assoc($result);
    } else {
      // Weiterleitung zurück zur ursprünglichen Seite
      pg_close($db_handle);
      $script = "<script>window.location.href = 'https://reklamationsmaster.azurewebsites.net/index.php';</script>";
      echo $script;
      exit;
    }

    pg_close($db_handle);
  } else {
    // Weiterleitung zurück zur ursprünglichen Seite
    $script = "<script>window.location.href = 'https://reklamationsmaster.azurewebsites.net/index.php';</script>";
    echo $script;
    exit;
  }
  ?>
</head>

<body>

  <?php
  $imagePath = './aspirin.png';
  ?>
  <div class="container_body">
    <div class="container_header">
      Bestellung:
      <?php echo htmlspecialchars($orderNumber); ?>
    </div>
    <div class="container_previewImages">
      <div class="wrapper">
        <div class="imageLabel">
          <label for="topImageLabel">
            <?php echo htmlspecialchars($row['name']); ?>
          </label>
        </div>
        <div class="image">
          <img src="<?php echo htmlspecialchars($row['img_path']); ?>" alt="image" class="previewImage">
          <div class="refundCounter">
            <label class="Label_left">
              <?php echo htmlspecialchars($row['quantity']) . 'x'; ?>
            </label>
            <select id="refundCount" name="refundCount" required>
              <?php
              for ($i = 0; $i <= $row['quantity']; $i++) {
                echo "<option value='$i'>" . $i . "x</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <div class="imageLabel">
          <label for="topImageLabel">12322232</label>
        </div>
      </div>
    </div>

    <div class="container_reason">
      <label for="refundReason">Grund für die Erstattung: </label>
      <select id="refundReason" name="refundReason" required>
        <option value="" disabled selected>Wählen Sie einen Grund</option>
        <option value="defective">Defektes Produkt</option>
        <option value="wrongItem">Falsches Produkt erhalten</option>
        <option value="changedMind">Meinung geändert</option>
        <option value="changedMind">Sonstige </option>
      </select>
    </div>

    <div class="container_description">
      <label for="refundReason">Beschreibung der Probleme:</label>
      <textarea id="text" name="text" cols="35" rows="4"></textarea>
      <button id="submit">Rücksendung einreichen</button>
    </div>
  </div>
</body>

</html>