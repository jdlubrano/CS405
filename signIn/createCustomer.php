<?php

require_once "../utilities/DB_Connector.php";

if(!isset($_POST['email']) || !isset($_POST['password'])
    || !isset($_POST['address']) || !isset($_POST['name']))
{
    http_response_code(500);
    die("Missing Input");
}

require_once "../DAOs/CustomerDAO.php";

$customerDAO = new CustomerDAO();

$created = $customerDAO->createCustomer($_POST);

if($created)
    echo "Created new customer.";
else
    echo "Failed to create customer.";

?>