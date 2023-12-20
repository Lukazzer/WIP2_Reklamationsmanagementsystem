<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="MitarbeiterRetoureÜbersicht.css">
  <title>Bearbeitung von Mitarbeitererstattungen</title>
</head>

<body>

  <?php
  // Pfade anpassen
  $bildPfad = '../BestellungEinsehen/1.png';
  ?>

  <div class="container_Info">
    Retourenummer: 12322
  </div>
  <div class="container">


    <div class="refund-details">
      <div class="product">
        <img src="<?php echo $bildPfad; ?>" alt="Bild" class="vorschauBild">
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

</body>

</html>