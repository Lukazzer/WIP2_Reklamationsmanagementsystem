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


    ?>