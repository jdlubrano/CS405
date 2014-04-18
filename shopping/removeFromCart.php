<?php
/**
 * RemoveFromCart.php
 * User: Joel
 * Date: 4/17/14
 * Time: 11:21 PM
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
    $email = $_SESSION['current_customer_email'];

    const REMOVE_FROM_CART = "DELETE FROM Carts WHERE email = ? AND item_id = ?";

    $result = DB_Connector::getInstance()->executePreparedQuery(REMOVE_FROM_CART,
                                                                array($email, $itemId));

    if($result->rowCount())
    {
        die();
    }
    else
        die(print_r($result->errorInfo()));
?>