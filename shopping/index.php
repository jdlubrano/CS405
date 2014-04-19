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
            <?php
                if(!isset($keyword))
                    echo "<h2>All Items</h2>";
                else
                    echo "<h2>Items related to \"$keyword\"</h2>";
                if(!isset($result))
                {
                    if(!class_exists("ItemsDAO"))
                        require_once "../DAOs/ItemsDAO.php";
                    $itemsDAO = new ItemsDAO();
                    $result = $itemsDAO->getAllItemsForSale();
                }
                $returnURI = $_SERVER['SERVER_NAME'] .":". $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
                if(isset($_SESSION['current_customer_email']))
                    displayItems($result, $returnURI, ADD_TO_CART);
                elseif(isset($_SESSION['current_staff_id']) && isset($UPDATE_FLAG))
                    displayItems($result, $returnURI, UPDATE_INVENTORY);
                else
                    displayItems($result, $returnURI, VIEW_ONLY);
            ?>
        <?php include_once("../layout/footer.php"); ?>
    </body>
</html>

