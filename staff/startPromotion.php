<?php
/**
 * startPromotion.php
 * User: Joel
 * Date: 4/19/14
 * Time: 1:22 AM
 */
    require 'authenticateManager.php';
?>
<html>
    <head>
        <?php include_once '../layout/headerTags.php'; ?>
    </head>
    <body>
        <?php
            include_once '../layout/navbar.php';
            include_once '../layout/sidebar.php';
            include_once '../layout/footer.php';
        ?>
        <h2>Start a New Promotion</h2>
        <p>
            If you want an item to be included in this promotion,
            check its corresponding box.
        </p>
        <form method="post" action="createPromotion.php">
            <?php
                if(!class_exists("ItemsDAO"))
                    require '../DAOs/ItemsDAO.php';
                $itemsDAO = new ItemsDAO();
                $result = $itemsDAO->getAllItemsForSale();
                while($item = $result->fetch())
                {
                    $itemId = $item['item_id'];
                    $name = $item['name'];
                    echo "<input id=chk$itemId type=checkbox name=items[] value=$itemId>";
                    echo "<label for=chk$itemId>$name</label><br />";
                }
            ?>
            <label for="promotionDiscountInput">Discount Rate (10 = 10% discount): </label>
            <input type="number" id="promotionDiscountInput" name="discount" /><br />
            <button id="startPromoBtn"type="button">Start Promotion</button>
        </form>
    </body>
</html>