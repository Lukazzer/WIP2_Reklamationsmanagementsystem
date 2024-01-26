<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="MitarbeiterRetoureListe.css">
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
            <div class="info">
                Eingesendete Retouren:

            </div>

            <div class="dropdown">
                <span>Mitarbeiter wählen: <span id="selectedEmployee"></span></span>
                <div class="dropdown-content">
                    <?php
                    
                    $host = "postgresql-database-server.postgres.database.azure.com";
                    $port = "5432";
                    $dbname = "reklamation_db";
                    $user = "coolman";
                    $password = "6L_.?6=8T8a~]cy";

                   
                    $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

                    
                    if (!$conn) {
                        die("Connection failed: " . pg_last_error());
                    }

                    
                    $query = "SELECT name FROM employee";
                    $result = pg_query($conn, $query);

                    
                    while ($row = pg_fetch_assoc($result)) {
                        echo '<a href="#" onclick="changeText(\'' . $row['name'] . '\');">' . $row['name'] . '</a>';
                    }

                    
                    pg_close($conn);
                    ?>
                </div>
            </div>



        </div>
        <div class="container">


            <div class="refundDetails">
                <div class="product">
                    <img src="<?php echo $imagePath; ?>" alt="image" class="imagePreview">
                    <div class="productInfo">
                        <p>Retourenummer: 23232323 </p>
                        <p>Menge: 4</p>
                        <p>Grund: Defektes Produkt</p>
                        <p>Zugewiesener Mitarbeiter: Hans M. </p>
                    </div>
                </div>


                <button class="button_right"> Wählen </button>


            </div>
        </div>

        <script>
            function changeText(employeeName) {
                document.getElementById('selectedEmployee').innerText = " " + employeeName;
            }
        </script>
</body>

</html>