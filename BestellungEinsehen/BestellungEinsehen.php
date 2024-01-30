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
    $db_handle = connectdb();

    // Überprüfen, ob ein Eintrag in 'complaint' für die gegebene 'orderNumber' existiert
    $queryCheckComplaint = "SELECT * FROM complaint_customer_product WHERE customer_product_id = $1";
    $resultCheckComplaint = pg_prepare($db_handle, "query_check_complaint", $queryCheckComplaint);
    $resultCheckComplaint = pg_execute($db_handle, "query_check_complaint", array($orderNumber));
    if (pg_num_rows($resultCheckComplaint) > 0) {
      // Eintrag existiert, zurück
      pg_close($db_handle);
      echo "<script>window.location.href = 'https://reklamationsmaster.azurewebsites.net/index.php';</script>";
      exit;
    }

    if (isset($_POST['submit'])) {
      $orderNumber = $_GET['orderNumber'];
      $refundReason = $_POST['refundReason'];

      $redirectUrl = "https://reklamationsmaster.azurewebsites.net/RetoureBestätigen/RetoureBestätigen.php?redirected=true&orderNumber=" . urlencode($orderNumber) . "&refundReason=" . urlencode($refundReason);
      $script = "<script>window.location.href = '{$redirectUrl}';</script>";
      echo $script;
      exit; // Beenden des Skripts nach der Weiterleitung
    }

    $orderNumber = $_GET['orderNumber'];

    // Vorbereiten und Ausführen der SQL-Abfrage
    $query = "SELECT p.id, p.name, p.img_path, cp.quantity FROM product p INNER JOIN customer_product cp ON p.id = cp.product_id WHERE cp.id = $1";
    $result = pg_prepare($db_handle, "my_query", $query);
    $result = pg_execute($db_handle, "my_query", array($orderNumber));

    if ($result) {
      $product = pg_fetch_assoc($result);
      $imagePath = '../img/' . $product['img_path'];
      $productId = $product['id'];

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
          <img src="<?php echo htmlspecialchars($product['img_path']); ?>" alt="image" class="previewImage">
          <!-- Hinzufügen von $imagePath? wegen ./ -->
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
          <label for="topImageLabel">Produktnummer: <?php echo htmlspecialchars($productId); ?></label>
        </div>
      </div>
    </div>
    <form method="post">
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
        <button type="submit" id="submit" name="submit">Rücksendung einreichen</button>
    </form>
  </div>
  </div>
</body>

</html>