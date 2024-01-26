<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="MitarbeiterRetoureListe.css">
    <link rel="stylesheet" href="../Design/design.css">

    <?php
    include '../Design/design.php';
    include '../Datenbankverbindung.php'

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
                <span>Mitarbeiter wählen g: <span id="selectedEmployee"></span></span>
                <div class="dropdown-content">
                    <?php

                     fillNameList();
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