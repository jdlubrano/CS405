<?php
/**
 * createItem.php
 * User: Joel
 * Date: 4/19/14
 * Time: 1:11 PM
 */

function itemInvalid($msg)
{
    $_SESSION['INVALID_ITEM'] = $msg;
    header("HTTP/1.1 301 Permanently Moved");
    header("Location: addNewItem.php");
    die(0);
}
require_once 'authenticateManager.php';

if(!(isset($_POST['name']) && isset($_POST['desc']) && isset($_POST['price'])
    && isset($_POST['quantity'])))
    itemInvalid("Missing input for new item.");

$name = $_POST['name'];
$desc = $_POST['desc'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];

if(!strlen($name) > 0)
    itemInvalid("Item must have a name");
if(!strlen($desc) > 0)
    itemInvalid("Item must have a description");
if(!(is_numeric($price) && is_numeric($quantity)))
    itemInvalid("Price and quantity must be numeric");

$quantity = intval($quantity);

const CREATE_ITEM = "INSERT INTO Items(name, description, price, quantity) VALUES (?,?,?,?)";

if(!class_exists('DB_Connector'))
    require '../utilities/DB_Connector.php';

$result = DB_Connector::getInstance()->executePreparedQuery(CREATE_ITEM,
                                       array($name, $desc, $price, $quantity));

if(!$result->rowCount())
{
    $e = $result->errorInfo();
    itemInvalid("Failed to create item: " . $e[2]);

}else
{
    header("HTTP/1.1 200 OK");
    header("Location: viewInventory.php");
    die(0);
}

