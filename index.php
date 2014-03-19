<html>
    <head></head>
    <body>

    <?php
        echo "Hello World! <br />";
        require_once "utilities/DB_Connector.php";
        const TEST_QUERY = "SELECT message from test";

        $result = DB_Connector::getInstance()->executeSimpleQuery(TEST_QUERY);
        while($row = $result->fetch())
        {
            echo "$row[0] <br />";
        }

        echo "DBHOST: " . DB_HOST . "<br />";
        echo "DBNAME: " . DB_NAME . "<br />";
        echo "DBPASS: " . DB_PASS . "<br />";
        echo "DBUSER: " . DB_USER . "<br />";
    ?>

    </body>
</html>