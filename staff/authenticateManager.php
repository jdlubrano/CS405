<?php
/**
 * authenticateManager.php
 * User: Joel
 * Date: 4/19/14
 * Time: 12:14 AM
 */
    require_once '../DAOs/StaffDAO.php';
    $staffDAO = new StaffDAO();

    if (session_status() == PHP_SESSION_NONE)
        session_start();

    if(!isset($_SESSION['current_staff_id']) || !isset($_SESSION['current_staff_password'])
        || !$staffDAO->authenticateManager($_SESSION['current_staff_id'],
            $_SESSION['current_staff_password']))
    {
        $_SESSION['NEEDS_TO_BE_MANAGER'] = true;
        header("Location: signIn.php");
        die();
    }
?>