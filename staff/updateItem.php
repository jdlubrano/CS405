<?php
/**
 * updateItem.php
 * User: Joel
 * Date: 4/18/14
 * Time: 6:55 PM
 */

    if(!isset($_GET['item_id']) || !isset($_GET['quantity']))
    {
        header("HTTP/1.1 500 Internal Server Error");
        die("Missing input.");

    }elseif(!is_numeric($_GET['quantity']))
    {
        header("HTTP/1.1 500 Internal Server Error");
        die("Quantity must be an integer!");
    }

    if(!class_exists("ItemsDAO"))
        require "../DAOs/ItemsDAO.php";

    $itemsDAO = new ItemsDAO();
    $result = $itemsDAO->updateQuantity($_GET['item_id'], $_GET['quantity']);
    $err = $result->errorInfo();
    if($err[2] != '')
    {
        header("HTTP/1.1 500 Internal Server Error");
        die($err[2]);

    }else
    {
        header("HTTP/1.1 200 OK");
        die("Successfully updated quantity!");
    }