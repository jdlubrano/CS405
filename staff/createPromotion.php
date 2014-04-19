<?php
/**
 * createPromotion.php
 * User: Joel
 * Date: 4/19/14
 * Time: 1:41 AM
 */
    require 'authenticateManager.php';
    if(!class_exists('DB_Connector'))
        require '../utilities/DB_Connector.php';

    if(session_status() == PHP_SESSION_NONE)
        session_start();

    if(!isset($_POST['items']) || !isset($_POST['discount']))
    {
        header("HTTP/1.1 500 Internal Server Error");
        die("Missing input");
    }

    if(count($_POST['items']) <= 0)
    {
        header("HTTP/1.1 500 Internal Server Error");
        die("No items selected.");
    }

    $items = $_POST['items'];
    $discount = $_POST['discount'];
    if(!is_numeric($discount) || $discount <= 0)
    {
        header("HTTP/1.1 500 Internal Server Error");
        die("Valid discounts must be numbers greater than zero.");
    }

    $discount = $discount/100;

    const GET_PROMO_ID = "SELECT COUNT(DISTINCT promotion_id) + 1 FROM Promotions";

    $result = DB_Connector::getInstance()->executeSimpleQuery(GET_PROMO_ID);
    $promoId = $result->fetchColumn(0);

    const INSERT_NEW_PROMO = "INSERT INTO Promotions VALUES (?, ?, NOW(), NULL, ?)";

    $result = DB_Connector::getInstance()->executePreparedQuery(INSERT_NEW_PROMO,
                                                      array($promoId, $discount,
                                                            $_SESSION['current_staff_id']));

    if(!$result->rowCount())
    {
        header("HTTP/1.1 500 Internal Server Error");
        $e = $result->errorInfo();
        die($e[2]);
    }

    $INSERT_INCLUDED_ENTRIES = "INSERT INTO Included VALUES (?,?)";
    $params = array($items[0], $promoId);

    for($i = 1; $i < count($items); $i++)
    {
        $INSERT_INCLUDED_ENTRIES .= ", (?,?)";
        $params[] = $items[$i];
        $params[] = $promoId;
    }

    $result = DB_Connector::getInstance()->executePreparedQuery($INSERT_INCLUDED_ENTRIES,
                                                                $params);
    if(!$result->rowCount())
    {
        header("HTTP/1.1 500 Internal Server Error");
        $e = $result->errorInfo();
        die($e[2]);
    }

    $ques = join(', ', array_fill(0, count($items), '?'));
    $discountEffect = 1 - $discount;
    $APPLY_PROMO = "UPDATE Items SET price = price * $discountEffect WHERE item_id IN( $ques )";
    $result = DB_Connector::getInstance()->executePreparedQuery($APPLY_PROMO, $items);
    if(!$result->rowCount())
    {
        header("HTTP/1.1 500 Internal Server Error");
        $e = $result->errorInfo();
        die($e[2]);

    }else
    {
        header("HTTP/1.1 200 OK");
        header("Location: viewPromotionHistory.php");
        die("Successfully created a promotion!");
    }

?>
