<?php
/**
 * addNewItem.php
 * User: Joel
 * Date: 4/19/14
 * Time: 12:59 PM
 */

require_once "authenticateManager.php";

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
            if(isset($_SESSION['INVALID_ITEM']))
            {
                $msg = $_SESSION['INVALID_ITEM'];
                echo "<div class=alert>$msg</div><br />";
                unset($_SESSION['INVALID_ITEM']);
            }
        ?>
        <h2>Add New Item to Inventory</h2>
        <form method="post" action="createItem.php">
            <label for="itemName">Name of Item: </label>
            <input id="itemName" type="text" name="name" /><br/>
            <label for="itemDescription">Item Description</label>
            <span class="aside">(max 200 characters)</span><br/>
            <textarea id="itemDescription" rows="5" cols="30" name="desc"></textarea><br />
            <label for="price">Price: </label>
            <input type="text" id="price" name="price" /><br/>
            <label for="quantity">Quantity: </label>
            <input type="number" id="quantity" name="quantity" /><br />
            <button type="submit">Add Item to Inventory</button>
        </form>
    </body>
</html>