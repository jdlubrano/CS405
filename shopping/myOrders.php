<?php
/**
 * myOrders.php
 * User: Joel
 * Date: 4/18/14
 * Time: 1:52 AM
 */
?>
<html>
    <head>
        <?php
            include_once "../layout/headerTags.php";
        ?>
    </head>
    <body>
        <h2>My Orders</h2>
        <?php
            include_once "../layout/navbar.php";
            include_once "../layout/sidebar.php";
            include_once "../layout/footer.php";
            require_once "../helpers/displayOrders.php";
            require_once "../utilities/DB_Connector.php";
            require_once "../DAOs/CustomerDAO.php";
            $customerDAO = new CustomerDAO();
            if(!isset($_SESSION['current_customer_email']) || !isset($_SESSION['current_customer_password'])
                || !$customerDAO->authenticateUser($_SESSION['current_customer_email'],
                    $_SESSION['current_customer_password']))
            {
                $_SESSION['NEEDS_TO_SIGN_IN'] = true;
                header("Location: ../signIn");
            }

            // Get distinct order_ids from customer_orders by email
            const GET_DISTINCT_ORDER_IDS = "SELECT DISTINCT order_id FROM Customer_Orders WHERE email = ?";
            $result = DB_Connector::getInstance()->executePreparedQuery(GET_DISTINCT_ORDER_IDS,
                                                              array($_SESSION['current_customer_email']));
            $orderIds = $result->fetchAll(PDO::FETCH_COLUMN, 0);

            foreach($orderIds as $order)
                displayOrderInTables($order);
        ?>
    </body>
</html>



