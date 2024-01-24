<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="RetoureBestätigen.css">
  <link rel="stylesheet" href="../Design/design.css">

  <?php
  include '../Design/design.php';

  $db_handle = pg_connect("host=postgresql-database-server.postgres.database.azure.com dbname=reklamation_db user=coolman password=6L_.?6=8T8a~]cy");
  
  if (isset($_GET['orderNumber'])) {
    $orderNumber = $_GET['orderNumber'];
    $reasonId = $_GET['refundReason'];

    $queryValidate = "SELECT * FROM customer_product WHERE id = $1";
    $resultValidate = pg_prepare($db_handle, "query_validate", $queryValidate);
    $resultValidate = pg_execute($db_handle, "query_validate", array($orderNumber));
    $isValidOrderNumber = pg_num_rows($resultValidate) > 0;

    if ($isValidOrderNumber) {
      // Random Mitarbeiter
      $queryEmployee = "SELECT id FROM employee ORDER BY RANDOM() LIMIT 1";
      $resultEmployee = pg_query($db_handle, $queryEmployee);
      $employee = pg_fetch_assoc($resultEmployee);
      $employeeId = $employee['id'];

      $customerProductId = pg_fetch_result($resultValidate, 0, 'id');

      $paymentIdQuery = "SELECT payment_id FROM customer_product WHERE id = $1";
      $resultPaymentId = pg_prepare($db_handle, "query_payment_id", $paymentIdQuery);
      $resultPaymentId = pg_execute($db_handle, "query_payment_id", array($orderNumber));
      $paymentIdRow = pg_fetch_assoc($resultPaymentId);
      $paymentRefund = $paymentIdRow['payment_id'];

      $timestamp = date('Y-m-d H:i:s');

      $queryInsertComplaint = "INSERT INTO complaint (customer_product_id, employee_id, reason_id, status_id, priority_id, timestamp, payment_refund) VALUES ($1, $2, $3, 1, 1, $4, $5)";
      $resultInsertComplaint = pg_prepare($db_handle, "query_insert_complaint", $queryInsertComplaint);
      $resultInsertComplaint = pg_execute($db_handle, "query_insert_complaint", array($customerProductId, $employeeId, $reasonId, $timestamp, $paymentRefund));
    } else {
      exit;
    }
  } else {
    exit;
  }

  pg_close($db_handle);
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

      <p>Ihnen wurde an die in der Bestellung hinterlegten E-Mail Adresse ein Rücsendeeticket mit weiteren Anweisungen
        geschickt. Sie haben jetzt bis zum 15.12.2023 Zeit, das Paket an uns zurückzuschicken. Danach verfällt die
        Retoure automatisch.</p>

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