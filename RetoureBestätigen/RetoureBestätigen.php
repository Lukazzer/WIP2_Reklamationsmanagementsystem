<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="RetoureBestätigen.css">
  <link rel="stylesheet" href="../Design/design.css">

  <?php
  include '../Design/design.php';
  ?>
  <title>Bestätigung des Erstattungsantrags</title>
</head>

<body>
  <div class="container_body">
    <div class="container_header">
      Retoure bestätigt: 12322
    </div>
    <div class="container_content">

      <p>Liebe [Kundenname],</p>

      <p>Ihre Anfrage der Retoure für Bestellung #12345 wird bestätigt. Hier sind die Details zu Ihrem Antrag:</p>

      <div class="refund-details">
        <strong>Produktname:</strong> [Produktname]<br>
        <strong>Product Number:</strong> [Produktnummer]<br>
        <strong>Produktmenge:</strong> [Produktmenge]<br>
        <strong>Grund für die Erstattung:</strong> [Grund]
      </div>

      <p>Ihnen wurde an die in der Bestellung hinterlegten E-Mail Adresse ein Rücsendeeticket mit weiteren Anweisungen geschickt. Sie haben jetzt bis zum 15.12.2023 Zeit, das Paket an uns zurückzuschicken. Danach verfällt die Retoure automatisch.</p>

      <p>Danke, dass Sie sich für unseren Service entschieden haben!</p>

      <div class="buttons">
        <button id="retoureButton">Retoure bearbeiten</button>
        <button id="downloadButton">Rücksendeetickett und Anweisungen herunterladen</button>
      </div>
    </div>
  </div>
  </div>

</body>

</html>