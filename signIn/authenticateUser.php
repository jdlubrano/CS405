<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 4/16/14
 * Time: 11:30 PM
 */

if(!isset($_POST['customerEmail']) || !isset($_POST['customerPassword']))
{
    http_response_code(500);
    die("Missing input.");
}

$email = $_POST['customerEmail'];
$password = $_POST['customerPassword'];
require_once "../DAOs/CustomerDAO.php";
$loc = '';
session_start();
$_SESSION['FAILED_LOGIN'] = false;

$customerDAO = new CustomerDAO();

$authenticated = $customerDAO->authenticateUser($email, $password);

if($authenticated)
{
    $_SESSION['current_customer_email'] = $email;
    $_SESSION['current_customer_password'] = $password;
    header("Location: ../index.php");
    die();
}
else
{
    $_SESSION['FAILED_LOGIN'] = true;
    header("Location: index.php");
    die();
}


