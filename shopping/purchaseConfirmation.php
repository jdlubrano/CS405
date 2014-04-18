<?php
/**
 * purchaseConfirmation.php
 * User: Joel
 * Date: 4/18/14
 * Time: 1:33 AM
 */

require_once "../utilities/DB_Connector.php";
?>
<html>
    <head>
        <?php
            include_once "../layout/headerTags.php"
        ?>
    </head>
    <body>
        <?php
            include_once "../layout/navbar.php";
            include_once "../layout/sidebar.php";
            include_once "../layout/footer.php";


            if(!isset($_GET['order_id']))
                die("No order_id given.");

            const CHECK_FOR_ORDER = "SELECT * FROM Orders WHERE order_id = ?";

            $result = DB_Connector::getInstance()->executePreparedQuery(CHECK_FOR_ORDER, array($_GET['order_id']));

            if(!$result->rowCount())
                die("<p>Your order could not be found in the database.</p>");
        ?>
        <p>
            Your order has been submitted to RetroniX.  For your reference, your order id
            is <?php echo $_GET['order_id']; ?>.
        </p>
    </body>
</html>

