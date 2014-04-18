<?php
/**
 * addToCart.php
 * User: Joel
 * Date: 4/17/14
 * Time: 10:07 PM
 */

    require_once "../utilities/DB_Connector.php";
    session_start();
    if(!isset($_SESSION['current_customer_email']))
    {
        $_SESSION['NEEDS_TO_SIGN_IN'] = true;
        header("Location: ../signIn");
        die(0);
    }

    $itemId = $_GET['item_id'];
    $return = $_GET['return'];

    const ADD_ITEM_TO_CART = "INSERT INTO carts VALUES(?,?)";

    $result = DB_Connector::getInstance()->executePreparedQuery(ADD_ITEM_TO_CART,
                                                                array($_SESSION['current_customer_email'],
                                                                $itemId));
    if($result->rowCount())
        die();
    else
        die(print_r($result->errorInfo()));
?>