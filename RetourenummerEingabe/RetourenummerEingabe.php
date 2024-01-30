<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rückgabe der Bestellung</title>
    <link rel="stylesheet" href="RetourenummerEingabe.css">
    <link rel="stylesheet" href="../Design/design.css">

    <?php
    include '../Design/design.php';
    ?>
</head>

<body>
    <div class="container_body">
        <div class="container_header">
            Retoure als angekommen markieren:
        </div>
        <form method="post" id="form">
            <div class="container_content" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="text" id="refundID" name="refundID" placeholder="Retourenummer eingeben...">
                <button type="submit" name="ok-button" class="ok-button">OK</button>
            </div>
        </form>

    </div>

    <?php

    $db_handle = connectdb();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST["ok-button"])) {

            $refundID = $_POST["refundID"];
            $selectQuery = "SELECT COUNT(*) FROM complaint WHERE id = $1";

            $resultSelect = pg_query_params($db_handle, $selectQuery, array($refundID));

            $firstElment = pg_fetch_result($resultSelect, 0, 0);

            if ($resultSelect === false || $firstElment === "0") {

                echo '<script>alert("Retournummer nicht gefunden");</script>';
            } else {
                $updateQuery = "UPDATE complaint SET status_id = 2 WHERE id = $1";
                $resultUpdate = pg_query_params($db_handle, $updateQuery, array($refundID));
            }
        }
    }
    ?>

    <script>
        function resetTextField() {
            document.getElementById('refundID').value = '';
        }


    </script>

</body>

</html>