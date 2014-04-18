<?php
/**
 * viewCart.php
 * User: Joel
 * Date: 4/17/14
 * Time: 10:18 PM
 */

?>

<html>
    <head>
        <?php include_once "../layout/headerTags.php"; ?>
    </head>
    <body>
        <?php
            include_once "../layout/navbar.php";
            include_once "../layout/sidebar.php";
            include_once "../layout/footer.php";
            require_once "displayItems.php";
        ?>
        <h2>View Cart</h2>
        <?php
            if(!class_exists("CustomerDAO"))
                require_once "../DAOs/CustomerDAO.php";

            $customerDAO = new CustomerDAO();

            if(!isset($_SESSION['current_customer_email']) ||
                !isset($_SESSION['current_customer_password']) ||
                !$customerDAO->authenticateUser($_SESSION['current_customer_email'],
                    $_SESSION['current_customer_password']))
            {
                $_SESSION['NEEDS_TO_SIGN_IN'] = true;
                header("Location: ../signIn");
                die(0);
            }
            $returnURI = $returnURI = $_SERVER['SERVER_NAME'] .":". $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
            displayItemsInCart($_SESSION['current_customer_email'], $returnURI);
        ?>
        <form method="post" action="purchase.php">
            <button type="submit">Purchase Items in Cart</button>
        </form>
    </body>
</html>