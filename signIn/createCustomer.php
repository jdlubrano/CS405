<?php

require_once "../utilities/DB_Connector.php";
if(session_status() == PHP_SESSION_NONE)
    session_start();

function invalidCustomer($msg)
{
    $_SESSION['INVALID_CUSTOMER'] = $msg;
    header("HTTP/1.1 500 Internal Server Error");
    header("Location: register.php");
    die(0);
}

if(!isset($_POST['email']) || !isset($_POST['password'])
    || !isset($_POST['address']) || !isset($_POST['name']))
    invalidCustomer("Missing input.");

if(!(strlen($_POST['email']) > 0))
    invalidCustomer("Please provide an email.");


if(!strlen($_POST['password']))
    invalidCustomer("Password cannot be blank.");

require_once "../DAOs/CustomerDAO.php";

$customerDAO = new CustomerDAO();

$created = $customerDAO->createCustomer($_POST);

if($created)
{
    if(session_status() == PHP_SESSION_NONE)
        session_start();
    $_SESSION['current_customer_email'] = $_POST['email'];
    $_SESSION['current_customer_password'] = $_POST['password'];
    header("Location: ../index.php");
    die(0);

}else
{
    invalidCustomer("Failed to create user.");
}

?>