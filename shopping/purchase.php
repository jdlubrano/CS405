<?php
/**
 * purchase.php
 * User: Joel
 * Date: 4/18/14
 * Time: 12:58 AM
 */
require_once "../utilities/DB_Connector.php";
require_once "../DAOs/CustomerDAO.php";
$customerDAO = new CustomerDAO();
session_start();
if(!isset($_SESSION['current_customer_email']) || !isset($_SESSION['current_customer_password'])
            || !$customerDAO->authenticateUser($_SESSION['current_customer_email'],
                                                $_SESSION['current_customer_password']))
{
    $_SESSION['NEEDS_TO_SIGN_IN'] = true;
    header("Location: ../signIn");
}

//Get an order id
const GET_ORDER_ID = "SELECT COUNT(DISTINCT order_id) + 1 as id FROM Orders";
$result = DB_Connector::getInstance()->executeSimpleQuery(GET_ORDER_ID);
$row = $result->fetch();
$orderId = $row['id'];

const CHECK_EMPTY_CART = "SELECT COUNT(*) FROM Carts WHERE email = ?";

$cntRes = DB_Connector::getInstance()->executePreparedQuery(CHECK_EMPTY_CART,
                                       array($_SESSION['current_customer_email']));
$cnt = $cntRes->fetchColumn(0);

if($cnt < 1)
{
    header('HTTP/1.1 200 OK');
    header("Location: viewCart.php");
    die(0);
}

//add order_id to orders with status of 0
const CREATE_NEW_ORDER = "INSERT INTO Orders VALUES (?, 0, NOW(), NULL)";
$result = DB_Connector::getInstance()->executePreparedQuery(CREATE_NEW_ORDER, array($orderId));

//Get items from cart
const GET_ITEMS_FROM_CART_BY_EMAIL = "SELECT * FROM Carts WHERE email = ?";
$result = DB_Connector::getInstance()->executePreparedQuery(GET_ITEMS_FROM_CART_BY_EMAIL,
                                                            array($_SESSION['current_customer_email']));

//store Items with order_id in item_orders
const INSERT_CART_ITEMS_INTO_ITEM_ORDERS = "INSERT INTO Item_orders(order_id, item_id) VALUES (?,?)";
const SUBTRACT_QUANTITY = "UPDATE Items SET quantity = (quantity-1) WHERE item_id = ?";
while($row = $result->fetch())
{
    $res1 = DB_Connector::getInstance()->executePreparedQuery(INSERT_CART_ITEMS_INTO_ITEM_ORDERS,
                                                      array($orderId, $row['item_id']));
    $res2 = DB_Connector::getInstance()->executePreparedQuery(SUBTRACT_QUANTITY,
                                                              array($row['item_id']));
}

//store email and order_id in customer_orders
const INSERT_ORDER_INTO_CUSTOMER_ORDERS = "INSERT INTO Customer_Orders VALUES (?,?)";
DB_Connector::getInstance()->executePreparedQuery(INSERT_ORDER_INTO_CUSTOMER_ORDERS,
                                                  array($_SESSION['current_customer_email'],
                                                        $orderId));

const EMPTY_CART = "DELETE FROM Carts WHERE email = ?";
DB_Connector::getInstance()->executePreparedQuery(EMPTY_CART,
                                                  array($_SESSION['current_customer_email']));

header("Location: purchaseConfirmation.php?order_id=$orderId");