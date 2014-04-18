<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 4/16/14
 * Time: 10:16 PM
 */
    $shoppingIndex = "/" . APPLICATION_ROOT . "/shopping";
?>
<div id="sidebar">
    <ul>
        <li><a href="<?php echo $shoppingIndex; ?>">All Items</a></li>
        <li><a href="#">Consoles</a></li>
        <li><a href="#">Games</a></li>
        <li><a href="#">Music</a></li>
        <li><a href="#">Accessories</a></li>
        <?php
            if(isset($_SESSION['current_staff_id']) && isset($_SESSION['current_staff_password']))
            {
                if(!class_exists("StaffDAO"))
                {
                    require(dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR .
                            "DAOs" . DIRECTORY_SEPARATOR . "StaffDAO.php");
                }
                $staffDAO = new StaffDAO();

                if($staffDAO->authenticateStaff($_SESSION['current_staff_id'], $_SESSION['current_staff_password']))
                {
                    $staffHomeURI = "/" . APPLICATION_ROOT . "/staff/";
                    echo "<li><a href=\"$staffHomeURI\">Staff Home</a></li>";
                }
            }

            if(isset($_SESSION['current_customer_email']) && isset($_SESSION['current_customer_password']))
            {
                if(!class_exists("CustomerDAO"))
                {
                    require(dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR .
                        "DAOs" . DIRECTORY_SEPARATOR . "CustomerDAO.php");
                }
                $customerDAO = new CustomerDAO();

                if($customerDAO->authenticateUser($_SESSION['current_customer_email'],
                                                  $_SESSION['current_customer_password']))
                {
                    echo "<li><a href=\"#\">VIPs Only</a></li>";
                }
            }
        ?>
    </ul>
</div>
