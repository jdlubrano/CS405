<?php
/**
 * Shopping Index page.  Displays all items for sale.
 * User: Joel
 * Date: 4/17/14
 * Time: 8:59 PM
 */
?>
<html>
    <head>
        <?php include_once("../layout/headerTags.php"); ?>
    </head>
    <body>
        <?php
            include_once("../layout/navbar.php");
            include_once("../layout/sidebar.php");
            require_once("displayItems.php");
        ?>
        <h2>All Items</h2>
            <?php
                if(!class_exists("ItemsDAO"))
                    require_once "../DAOs/ItemsDAO.php";
                $itemsDAO = new ItemsDAO();
                $result = $itemsDAO->getAllItemsForSale();
                $returnURI = $_SERVER['SERVER_NAME'] .":". $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
                displayItemsWithAddToCart($result, $returnURI);
            ?>
        <?php include_once("../layout/footer.php"); ?>
    </body>
</html>

