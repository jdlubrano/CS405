<?php
/**
 * stopPromotion.php
 * User: Joel
 * Date: 4/19/14
 * Time: 3:56 AM
 */

    require 'authenticateManager.php';
    if(!class_exists("DB_Connector"))
        require '../utilities/DB_Connector.php';

    if(!isset($_GET['promotion_id']) || !is_numeric($_GET['promotion_id']))
    {
        header("HTTP/1.1 500 Internal Server Error");
        die("Missing promotion_id.");
    }

    const RESET_PRICES = "UPDATE Items I, Included Inc, Promotions P
                          SET I.price = (I.price / (1-P.discount))
                          WHERE I.item_id = Inc.item_id AND P.promotion_id = Inc.promotion_id
                          AND P.promotion_id = ?";

    $result = DB_Connector::getInstance()->executePreparedQuery(RESET_PRICES,
                                                                array($_GET['promotion_id']));

    if(!$result->rowCount())
    {
        header("HTTP/1.1 500 Internal Server Error");
        $e = $result->errorInfo();
        die($e[2]);
    }

    const END_PROMOTION = "UPDATE Promotions SET end_date = NOW() WHERE promotion_id = ?";

    $result = DB_Connector::getInstance()->executePreparedQuery(END_PROMOTION,
                                                                array($_GET['promotion_id']));

    if(!$result->rowCount())
    {
        header("HTTP/1.1 500 Internal Server Error");
        $e = $result->errorInfo();
        die($e[2]);
    }

    header("HTTP/1.1 200 OK");
    die("Successfully stopped promotion.");

?>
