<?php
/**
 * displayItems.php
 * User: Joel
 * Date: 4/17/14
 * Time: 10:27 PM
 */


const GET_COUNT_OF_ITEM_IN_CART = "SELECT COUNT(*) as cnt FROM Carts WHERE item_id = ? AND email = ?";

function getCountOfItemInCart($itemId, $email)
{
    require_once "../utilities/DB_Connector.php";
    $result = DB_Connector::getInstance()->executePreparedQuery(GET_COUNT_OF_ITEM_IN_CART,
                                                      array($itemId, $email));
    $row = $result->fetch();
    return $row['cnt'];
}

/**
 * @param $PDOStatement PDOStatement
 */
function displayItems($PDOStatement, $returnURI, $USE_FLAG)
{
    echo "<table>
            <thead>
                <tr>
                   <th>Name</th>
                   <th>Description</th>
                   <th>Price</th>
                   <th>Number in Stock</th>
                </tr>
            </thead>
            <tbody>";
            if(!class_exists("ItemsDAO"))
                require_once "../DAOs/ItemsDAO.php";
            while($row = $PDOStatement->fetch())
            {
                $name = $row['name'];
                $description = $row['description'];
                $price = $row['price'];
                $quantity = $row['quantity'];
                // Subtract items in customer's cart.
                if(isset($_SESSION['current_customer_email']) && $USE_FLAG == ADD_TO_CART)
                    $quantity -= getCountOfItemInCart($row['item_id'], $_SESSION['current_customer_email']);
                $addToCartStr = "addToCart.php?item_id=" . $row["item_id"];
                $addToCartStr .= "&return=$returnURI";
                echo "<tr>";
                echo "<td>$name</td>";
                echo "<td>$description</td>";
                printf("<td>%01.2f</td>", $price);
                if(isset($_SESSION['current_staff_id']) && $USE_FLAG == UPDATE_INVENTORY)
                {
                    $itemId = $row['item_id'];
                    echo "<td><input type=text id=quantityInput$itemId name=quantity$itemId value=$quantity /></td>";
                    echo "<td><button class=updateInvButton type=button id=updateInvButton$itemId item=$itemId>Update Inventory</button></td>";

                }else
                    echo "<td style=text-align:center;>$quantity</td>";
                if(isset($_SESSION['current_customer_email']) && $quantity > 0 && $USE_FLAG == ADD_TO_CART)
                    echo "<td><a class=\"addToCartLink\" href=\"#\" url=\"$addToCartStr\">Add to Cart</a></td>";
                echo "</tr>";
            }
    echo "</tbody>
    </table>";
}

function displayItemsInCart($email, $returnURI)
{
    require_once "../utilities/DB_Connector.php";
    $GET_ITEMS_IN_CART = "SELECT * FROM Carts C, Items I WHERE I.item_id = C.item_id AND C.email = ?";
    $result = DB_Connector::getInstance()->executePreparedQuery($GET_ITEMS_IN_CART, array($email));
    echo "<table>
            <thead>
                <tr>
                   <th>Name</th>
                   <th>Description</th>
                   <th>Price</th>
                </tr>
            </thead>
            <tbody>";
    while($row = $result->fetch())
    {
        $name = $row['name'];
        $description = $row['description'];
        $price = $row['price'];
        $removeFromCartStr = "removeFromCart.php?item_id=" . $row["item_id"];
        $removeFromCartStr .= "&return=$returnURI";
        echo "<tr>";
        echo "<td>$name</td>";
        echo "<td>$description</td>";
        echo "<td>$price</td>";
        echo "<td><a class=\"removeFromCartLink\" href=\"#\" url=\"$removeFromCartStr\">Remove from Cart</a></td>";
        echo "</tr>";
    }
    echo "</tbody>
    </table>";
}
?>