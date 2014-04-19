<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 4/18/14
 * Time: 9:09 PM
 */
    if(!class_exists('DB_Connector'))
        require '../utilities/DB_Connector.php';
    if(!class_exists('StaffDAO'))
        require '../DAOs/StaffDAO.php';

    if(!isset($_GET['order_id']))
    {
        header("HTTP/1.1 500 Internal Server Error");
        die("No order id provided.");
    }

    session_start();
    $staffDAO = new StaffDAO();

    if(!isset($_SESSION['current_staff_id']) || !isset($_SESSION['current_staff_password'])
        || !$staffDAO->authenticateStaff($_SESSION['current_staff_id'],
            $_SESSION['current_staff_password']))
    {
        header("HTTP/1.1 500 Internal Server Error");
        die("Unable to authenticate current staff member.");
    }

    const SHIP_ORDER = "UPDATE Orders SET status = ?, shipping_date = NOW() WHERE order_id = ?";

    $result = DB_Connector::getInstance()->executePreparedQuery(SHIP_ORDER,
                                                                array($_SESSION['current_staff_id'],
                                                                      $_GET['order_id']));
    if(!$result->rowCount())
    {
        header("HTTP/1.1 500 Internal Server Error");
        die("Failed to ship order.");

    }else
    {
        header("HTTP/1.1 200 OK");
        die("Order shipped successfully.");
    }
?>