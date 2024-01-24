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

  if (isset($_GET['orderNumber']) && isset($_GET['refundReason'])) {
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
      $timestampPlus14Days = date('d.m.Y', strtotime($timestamp . ' + 14 days'));

      $queryInsertComplaint = "INSERT INTO complaint (customer_id, employee_id, reason_id, status_id, priority_id, timestamp, payment_refund) VALUES ($1, $2, $3, 1, 1, $4, $5) RETURNING id";
      $resultInsertComplaint = pg_query_params($db_handle, $queryInsertComplaint, array($customerProductId, $employeeId, $reasonId, $timestamp, $paymentRefund));

      if ($resultInsertComplaint) {
        $complaint = pg_fetch_assoc($resultInsertComplaint);
        $complaintId = $complaint['id'];

        $queryInsertComplaintCustomerProduct = "INSERT INTO complaint_customer_product (customer_product_id, complaint_id) VALUES ($1, $2)";
        $resultInsertComplaintCustomerProduct = pg_query_params($db_handle, $queryInsertComplaintCustomerProduct, array($customerProductId, $complaintId));

      } else {
        echo pg_last_error($db_handle);
      }

      // Kundennamen abrufen
      $queryCustomer = "SELECT c.name FROM customer c JOIN customer_product cp ON c.id = cp.customer_id WHERE cp.id = $1";
      $resultCustomer = pg_prepare($db_handle, "query_customer", $queryCustomer);
      $resultCustomer = pg_execute($db_handle, "query_customer", array($orderNumber));
      $customer = pg_fetch_assoc($resultCustomer);
      $customerName = $customer['name'];

      // Produktnamen und -menge abrufen
      $queryProduct = "SELECT p.name, cp.quantity FROM product p JOIN customer_product cp ON p.id = cp.product_id WHERE cp.id = $1";
      $resultProduct = pg_prepare($db_handle, "query_product", $queryProduct);
      $resultProduct = pg_execute($db_handle, "query_product", array($orderNumber));
      $product = pg_fetch_assoc($resultProduct);
      $productName = $product['name'];
      $productQuantity = $product['quantity'];

      // Grund für die Erstattung abrufen
      $queryReason = "SELECT description FROM complaint_reason WHERE id = $1";
      $resultReason = pg_prepare($db_handle, "query_reason", $queryReason);
      $resultReason = pg_execute($db_handle, "query_reason", array($reasonId));
      $reason = pg_fetch_assoc($resultReason);
      $refundReason = $reason['description'];

      if (isset($_POST['sendEmail'])) {
        $to = 'empfaenger@example.com';
        $subject = 'Ihr Rücksendeticket';
        $message = 'Anweisung';
        $headers = 'From: absender@example.com';

        if (mail($to, $subject, $message, $headers)) {
          echo 'E-Mail wurde gesendet.';
        } else {
          echo 'E-Mail konnte nicht gesendet werden.';
        }
      }
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
      Retoure bestätigt:
      <?php echo htmlspecialchars($complaintId); ?>
    </div>
    <div class="container_content">

      <p>Liebe
        <?php echo htmlspecialchars($customerName); ?>,
      </p>
      <p>Ihre Anfrage der Retoure für Bestellung #
        <?php echo htmlspecialchars($orderNumber); ?> wird bestätigt. Hier sind die Details zu Ihrem Antrag:
      </p>
      <div class="refund-details">
        <strong>Produktname:</strong>
        <?php echo htmlspecialchars($productName); ?><br>
        <strong>Produktmenge:</strong>
        <?php echo htmlspecialchars($productQuantity); ?><br>
        <strong>Grund für die Erstattung:</strong>
        <?php echo htmlspecialchars($refundReason); ?>
      </div>

      <p>Ihnen wurde an die in der Bestellung hinterlegten E-Mail Adresse ein Rücsendeeticket mit weiteren Anweisungen
        geschickt. Sie haben jetzt bis zum
        <?php echo htmlspecialchars($timestampPlus14Days); ?> Zeit, das Paket an uns zurückzuschicken. Danach verfällt
        die
        Retoure automatisch.
      </p>

      <p>Danke, dass Sie sich für unseren Service entschieden haben!</p>

      <form method="post" action="">
        <!-- <button id="retoureButton">Retoure bearbeiten</button> -->
        <div class="buttons">
          <button type="submit" id="downloadButton" name="sendEmail">Rücksendeetickett und Anweisungen
            herunterladen</button>
        </div>
      </form>
    </div>
  </div>
  </div>

</body>

</html>