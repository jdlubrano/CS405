<?php
/**
 * createStaff.php
 * User: Joel
 * Date: 4/19/14
 * Time: 1:40 PM
 */

require_once 'authenticateManager.php';

function invalidStaff($msg)
{
    $_SESSION['INVALID_STAFF'] = $msg;
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: addNewStaff.php");
    die(0);
}

if(!(isset($_POST['name']) && $_POST['password']))
{
    invalidStaff("Missing input");
}

$name = $_POST['name'];
$password = $_POST['password'];

if(!strlen($name) > 0)
    invalidStaff("Name cannot be blank");
if(!strlen($password) > 0)
    invalidStaff("Password cannot be blank");

if(isset($_POST['manager']) && $_POST['manager'] == 1)
    $manager = true;
else
    $manager = false;

if(!class_exists("StaffDAO"))
    require "../DAOs/StaffDAO.php";

$staffDAO = new StaffDAO();

$result = $staffDAO->createStaff($name, $password, $manager);

if($result->rowCount())
{
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: viewStaff.php");
    die(0);

}else
{
    $e = $result->errorInfo();
    invalidStaff("Failed to create staff: " . $e[2]);
}