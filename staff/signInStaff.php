<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 4/17/14
 * Time: 4:50 PM
 */

if(!class_exists("StaffDAO"))
    require_once "../DAOs/StaffDAO.php";

if(!isset($_POST['staffId']) || !isset($_POST['staffPassword']))
{
    http_response_code(500);
    die("Missing input.");
}

$id = $_POST['staffId'];
$password = $_POST['staffPassword'];
require_once "../DAOs/StaffDAO.php";
session_start();
$_SESSION['FAILED_LOGIN'] = false;

$staffDAO = new StaffDAO();

$authenticated = $staffDAO->authenticateStaff($id, $password);

if($authenticated)
{
    $_SESSION = array();
    $_SESSION['current_staff_id'] = $id;
    $_SESSION['current_staff_password'] = $password;
    header("Location: index.php");
    die();
}
else
{
    $_SESSION['FAILED_LOGIN'] = true;
    header("Location: signIn.php");
    die();
}
