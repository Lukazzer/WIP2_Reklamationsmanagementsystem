<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="BestellungEinsehen.css">
  <title>Formular für Erstattungsanträge</title>
</head>

<body>

  <div class="container">
    <h1>Antragsformular für Rückerstattung</h1>
    <h2>Bestellung #12345</h2>

    <form class="refund-form">
      <div class="product-box">
        <label for="productName1">Produktname:</label>
        <input type="text" id="productName1" name="productName1" required>

        <label for="productNumber1">Produktnummer:</label>
        <input type="text" id="productNumber1" name="productNumber1" required>

        <label for="productQuantity1">Produktmenge:</label>
        <input type="number" id="productQuantity1" name="productQuantity1" required>
      </div>

      <!-- Zusätzliche Produktboxen können nach Bedarf hinzugefügt werden -->

      <label for="refundReason">Grund für die Erstattung:</label>
      <select id="refundReason" name="refundReason" required>
        <option value="" disabled selected>Wählen Sie einen Grund</option>
        <option value="defective">Defektes Produkt</option>
        <option value="wrongItem">Falsches Produkt erhalten</option>
        <option value="changedMind">Habe meine Meinung geändert</option>
        <!-- Bei Bedarf weitere Gründe hinzufügen -->
      </select>

      <div class="confirmation">
        <button type="button" id="returnButton" onclick="goBack()">Zurück zur vorherigen Seite</button>
        <button type="submit">Rücksendeantrag einreichen</button>
      </div>
    </form>

  </div>
  <script src="./js/2.js></script>
</body>

</html>