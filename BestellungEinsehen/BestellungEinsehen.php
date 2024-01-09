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
    // Do Stuff
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
      Bestellung: 1919191
    </div>
    <div class="container_previewImages">
      <div class="wrapper">
        <div class="imageLabel">
          <label for="topImageLabel">Aspirin Protect 100mg</label>
        </div>
        <div class="image">
          <img src="<?php echo $imagePath; ?>" alt="image" class="previewImage">
          <div class="refundCounter">
            <label class="Label_left">3x</label>
            <select id="refundCount" name="refundCount" required>
              <option value="" enabled selected>0x</option>
              <option value="defective">1x</option>
              <option value="wrongItem">2x</option>
              <option value="changedMind">3x</option>


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

</div>