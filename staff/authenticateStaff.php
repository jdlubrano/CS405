<?php
/**
 * authenticateStaff.php
 * User: Joel
 * Date: 4/18/14
 * Time: 9:38 PM
 */

    require_once '../DAOs/StaffDAO.php';
    $staffDAO = new StaffDAO();

    if (session_status() == PHP_SESSION_NONE)
        session_start();

    if(!isset($_SESSION['current_staff_id']) || !isset($_SESSION['current_staff_password'])
        || !$staffDAO->authenticateStaff($_SESSION['current_staff_id'],
            $_SESSION['current_staff_password']))
    {
        $_SESSION['NEEDS_TO_SIGN_IN'] = true;
        header("Location: signIn.php");
        die();
    }
?>