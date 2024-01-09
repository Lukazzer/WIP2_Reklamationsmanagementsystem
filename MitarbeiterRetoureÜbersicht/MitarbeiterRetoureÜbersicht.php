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