<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 4/18/14
 * Time: 8:29 PM
 */
    require_once '../helpers/displayOrders.php';
    require_once '../utilities/DB_Connector.php';
    require_once 'authenticateStaff.php';
?>
<html>
    <head>
        <?php include_once '../layout/headerTags.php'; ?>
    </head>
    <body>
        <?php
            include_once "../layout/navbar.php";
            include_once "../layout/sidebar.php";
            include_once "../layout/footer.php";
        ?>
        <h2>Pending Orders</h2>
        <?php
            const GET_PENDING_ORDER_IDS = "SELECT order_id FROM Orders WHERE status = 0";
            $result = DB_Connector::getInstance()->executeSimpleQuery(GET_PENDING_ORDER_IDS);
            $orderIds = $result->fetchAll(PDO::FETCH_COLUMN, 0);
            foreach($orderIds as $orderId)
            {
                displayOrderInTable($orderId, true);
                echo "<button class=shipOrderButton type=button order=$orderId>Ship Order</button>";
                echo "<hr />";
            }
        ?>
    </body>
</html>