<?php
/**
 * displayOrders.php
 * User: Joel
 * Date: 4/18/14
 * Time: 2:09 AM
 */

if(!class_exists('DB_Connector'))
    require_once "../utilities/DB_Connector.php";

const GET_ORDER_BY_ID = "SELECT O.order_id as order_id, status,
                        DATE_FORMAT(order_date, '%M %d %Y') as order_date,
                        DATE_FORMAT(shipping_date, '%M %d %Y') as shipping_date,
                        C.name as name, C.address as address
                        FROM Orders O, Customers C, Customer_Orders CO
                        WHERE O.order_id = ? AND C.email = CO.email
                        AND O.order_id = CO.order_id";

const GET_ITEMS_IN_ORDER_BY_ID = "SELECT * FROM Item_orders IO, Items I
                                  WHERE IO.item_id = I.item_id AND IO.order_id = ?";

function displayOrderInTable($orderId, $SEE_CUSTOMER_INFO)
{
    $orderResult = DB_Connector::getInstance()->executePreparedQuery(GET_ORDER_BY_ID,
                                                                    array($orderId));
    $itemResult = DB_Connector::getInstance()->executePreparedQuery(GET_ITEMS_IN_ORDER_BY_ID,
                                                                    array($orderId));
    $order = $orderResult->fetch();
    $status = ($order['status'] == 0 ? "Not Shipped" : "Shipped");
    //$orderDate = date_format($order['order_date'], '%M %d %Y');
    //$shipDate = ($order['shipping_date'] ? "N/A" : date_format($order['shipping_date'], '%M %d %Y'));
    $orderDate = $order['order_date'];
    $shipDate = $order['shipping_date'];
    echo "<table>
            <thead>";
    if($SEE_CUSTOMER_INFO)
    {
        $custName = $order['name'];
        $custAddr = $order['address'];
        echo "<tr>
                <th>Customer: $custName</th>
                <th>Address: $custAddr</th>
              </tr>";
    }
    echo "      <tr>
                    <th>Order ID: $orderId</th>
                    <th>Status: $status</th>
                    <th>Order Date: $orderDate</th>
                    <th>Date Shipped: $shipDate</th>
                </tr>
                <tr>
                    <th>Item ID</th>
                    <th>Item Name</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>";
    while($item = $itemResult->fetch())
    {
        $item_id = $item['item_id'];
        $name = $item['name'];
        $price = $item['price'];
        echo "<tr>
                <td>$item_id</td>
                <td>$name</td>";
                printf('<td>%01.2f</td>', $price);
        echo "</tr>";
    }
    echo "</tbody>
    </table>";
}