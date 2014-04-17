<html>
    <?php
        include_once "layout/headerTags.php";
    ?>

    <body>

    <?php
        include_once "layout/navbar.php";
        include_once "layout/sidebar.php";
        echo "Hello World! <br />";
        require_once "utilities/DB_Connector.php";
        const TEST_QUERY = "SELECT message from test";

        $result = DB_Connector::getInstance()->executeSimpleQuery(TEST_QUERY);
        while($row = $result->fetch())
        {
            echo "$row[0] <br />";
        }

    ?>
    <?php include_once "layout/footer.php"; ?>
    </body>
</html>