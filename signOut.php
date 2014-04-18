<?php
/**
 * Signs out Customers and Staff.  Returns user to application home page.
 * Author: Joel Lubrano
 * Date: 4/17/14
 * Time: 4:28 PM
 */
session_start();
$_SESSION = array();
session_destroy();

header("Location: index.php");
die(0);

?>