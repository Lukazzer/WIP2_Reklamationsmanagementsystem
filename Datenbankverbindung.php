 <?php


    function connectdb()
    {



        $host = "postgresql-database-server.postgres.database.azure.com";
        $port = "5432";
        $dbname = "reklamation_db";
        $user = "coolman";
        $password = "6L_.?6=8T8a~]cy";


        $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");


        if (!$conn) {
            die("Connection failed: " . pg_last_error());
        }

        return $conn;
    }

    function fillNameList()
    {
        $conn = connectdb();

        $query = "SELECT name FROM employee";
        $result = pg_query($conn, $query);


        while ($row = pg_fetch_assoc($result)) {
            echo '<a href="#" onclick="changeText(\'' . $row['name'] . '\');">' . $row['name'] . '</a>';
        }
        pg_close($conn);
    }

    function getArrayProductInfo()
    {
        $conn = connectdb();

        $query = '
    SELECT
        c.id AS Retourenummer,
        cp.quantity AS Menge,
        cr.description AS Grund,
        e.name AS "Zugewiesener Mitarbeiter",
        p.img_path AS Bildpfad
    FROM
        complaint c
    JOIN
        complaint_customer_product ccp ON c.id = ccp.complaint_id
    JOIN
        customer_product cp ON ccp.customer_product_id = cp.id
    JOIN
        complaint_reason cr ON c.reason_id = cr.id
    LEFT JOIN
        employee e ON c.employee_id = e.id
    LEFT JOIN
        product p ON cp.product_id = p.id;
';

        $result = pg_query($conn, $query);


        if (!$result) {
            die("Abfrage fehlgeschlagen");
        }


        $resultArray = array();
        while ($row = pg_fetch_assoc($result)) {
            $resultArray[] = $row;
        }


        print_r($resultArray);

        echo "<pre>" . print_r($resultArray, true) . "</pre>";

        pg_close($conn);
    }


    ?>

 <!-- 
    
Retourenummer 
Menge
Grund
Zugewiesener Mitarbeiter
Bildpfad


-->