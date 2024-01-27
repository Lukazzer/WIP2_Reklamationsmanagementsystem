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

                    fillNameList();
                    ?>
                </div>
            </div>



        </div>
        <div class="container">


            <div class="refundDetails">
                <div class="cell">
                    <div class="product">
                        <img src="<?php echo $imagePath; ?>" alt="image" class="imagePreview">
                        <div class="productInfo">
                            <p>Retourenummer: 2323232344 </p>
                            <p>Menge: 4</p>
                            <p>Grund: Defektes Produkt</p>
                            <p>Zugewiesener Mitarbeiter: Hans M. </p>
                        </div>
                    </div>
                    <button class="button_right"> Wählen </button>
                </div>
                <?php


                foreach (getArrayProductInfo("") as $data) {

                    $retourenummer = $data['retourenummer'];
                    $menge = $data['menge'];
                    $grund = $data['grund'];
                    $zugewiesenerMitarbeiter = $data['Zugewiesener Mitarbeiter'];
                    $imagePath = $data['bildpfad'];


                    echo '<div class="cell">';
                    echo '<div class="product">';
                    echo '<img src="' . '../BestellungEinsehen/' . $imagePath . '" alt="image" class="imagePreview">';
                    echo '<div class="productInfo">';
                    echo '<p>Retourenummer: ' . $retourenummer . '</p>';
                    echo '<p>Menge: ' . $menge . '</p>';
                    echo '<p>Grund: ' . $grund . '</p>';
                    echo '<p>Zugewiesener Mitarbeiter: ' . $zugewiesenerMitarbeiter . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '<button class="button_right"> Wählen </button>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
        <?php
        //getArrayProductInfo();
        //echo "<pre>" . print_r(getArrayProductInfo(), true) . "</pre>";
        ?>

        <script>
            var employeeNameVar = "";

            function changeText(employeeName) {
                document.getElementById('selectedEmployee').innerText = "" + employeeName;
                employeeNameVar = employeeName;
            }

            function changeCells() {
                <?php


                /* foreach (getArrayProductInfo(employeeNameVar) as $data) {

                    $retourenummer = $data['retourenummer'];
                    $menge = $data['menge'];
                    $grund = $data['grund'];
                    $zugewiesenerMitarbeiter = $data['Zugewiesener Mitarbeiter'];
                    $imagePath = $data['bildpfad'];


                    echo '<div class="cell">';
                    echo '<div class="product">';
                    echo '<img src="' . '../BestellungEinsehen/' . $imagePath . '" alt="image" class="imagePreview">';
                    echo '<div class="productInfo">';
                    echo '<p>Retourenummer: ' . $retourenummer . '</p>';
                    echo '<p>Menge: ' . $menge . '</p>';
                    echo '<p>Grund: ' . $grund . '</p>';
                    echo '<p>Zugewiesener Mitarbeiter: ' . $zugewiesenerMitarbeiter . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '<button class="button_right"> Wählen </button>';
                    echo '</div>';
                } */
                ?>
            }
        </script>
</body>

</html>