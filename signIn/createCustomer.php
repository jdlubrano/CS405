<?php

require_once "../utilities/DB_Connector.php";

if(!isset($_POST['email']) || !isset($_POST['password'])
    || !isset($_POST['address']) || !isset($_POST['name']))
{
    http_response_code(500);
    die("Missing Input.");
}

require_once "../DAOs/CustomerDAO.php";

$customerDAO = new CustomerDAO();

$created = $customerDAO->createCustomer($_POST);

if($created)
{
    session_start();
    $_SESSION['current_customer_email'] = $_POST['email'];
    $_SESSION['current_customer_password'] = $_POST['password'];
    header("Location: ../index.php");
    die(0);

}else
{
    die("Failed to create user.");
}

?>