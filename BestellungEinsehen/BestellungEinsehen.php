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
      $product = pg_fetch_assoc($result);
      $imagePath = './' . $product['img_path'];

      // Abfrage für Beschwerdegründe
      $queryComplaintReasons = "SELECT id, description FROM complaint_reason";
      $resultComplaintReasons = pg_query($db_handle, $queryComplaintReasons);

      $complaintReasons = array();
      while ($row = pg_fetch_assoc($resultComplaintReasons)) {
        $complaintReasons[] = $row;
      }
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

  <div class="container_body">
    <div class="container_header">
      Bestellung:
      <?php echo htmlspecialchars($orderNumber); ?>
    </div>
    <div class="container_previewImages">
      <div class="wrapper">
        <div class="imageLabel">
          <label for="topImageLabel">
            <?php echo htmlspecialchars($product['name']); ?>
          </label>
        </div>
        <div class="image">
          <img src="<?php echo htmlspecialchars($product['img_path']); ?>" alt="image" class="previewImage"> <!-- Hinzufügen von $imagePath? wegen ./ -->
          <div class="refundCounter">
            <label class="Label_left">
              <?php echo htmlspecialchars($product['quantity']) . 'x'; ?>
            </label>
            <select id="refundCount" name="refundCount" required>
              <?php
              for ($i = 0; $i <= $product['quantity']; $i++) {
                echo "<option value='$i'>" . $i . "x</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <div class="imageLabel">
          <label for="topImageLabel">Was zum Fick ist das</label>
        </div>
      </div>
    </div>

    <div class="container_reason">
      <label for="refundReason">Grund für die Erstattung: </label>
      <select id="refundReason" name="refundReason" required>
        <option value="" disabled selected>Wählen Sie einen Grund</option>
        <?php
        foreach ($complaintReasons as $reason) {
          echo "<option value='" . htmlspecialchars($reason['id']) . "'>" . htmlspecialchars($reason['description']) . "</option>";
        }
        ?>
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