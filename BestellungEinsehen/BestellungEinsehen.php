<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="BestellungEinsehen.css">
  <title>Formular für Erstattungsanträge</title>
</head>

<body>

  <?php
  // Pfade anpassen
  $bildPfad = './1.png';
  ?>
  <div class="container_Info">
    Bestellung: 1919191
  </div>
  <div class="container_vorschauBilder">
    <div class="wrapper">
      <div class="labelBild">
        <label for="bildLabelOben">Aspirin Protect 100mg</label>
      </div>
      <div class="bild">
        <img src="<?php echo $bildPfad; ?>" alt="Bild" class="vorschauBild">
        <div class="anzahlRetour">
          <label class="Label_left">3x</label>
          <select id="refundCount" name="refundCount" required>
            <option value="" enabled selected>0x</option>
            <option value="defective">1x</option>
            <option value="wrongItem">2x</option>
            <option value="changedMind">3x</option>


          </select>
        </div>
      </div>

      <div class="labelBild">
        <label for="bildLabelOben">12322232</label>
      </div>
    </div>
  </div>

  <div class="container_grund">
    <label for="refundReason">Grund für die Erstattung: </label>
    <select id="refundReason" name="refundReason" required>
      <option value="" disabled selected>Wählen Sie einen Grund</option>
      <option value="defective">Defektes Produkt</option>
      <option value="wrongItem">Falsches Produkt erhalten</option>
      <option value="changedMind">Meinung geändert</option>
      <option value="changedMind">Sonstige </option>

    </select>
  </div>

  <div class="container_beschreibung">
    <label for="refundReason">Beschreibung der Probleme:</label>
    <textarea id="text" name="text" cols="35" rows="4"></textarea>
    <button id="einreichen">Rücksendung einreichen</button>

  </div>







</body>

</html>

</div>