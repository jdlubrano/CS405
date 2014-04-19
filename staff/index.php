<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 4/17/14
 * Time: 5:19 PM
 */
    require_once "authenticateStaff.php";
?>
<html>
    <head>
        <?php include_once "../layout/headerTags.php"; ?>
    </head>
    <body>
        <?php
            include_once "../layout/navbar.php";
            include_once "../layout/sidebar.php";
        ?>
        <h2>Staff Home Page</h2>
        <div style="display:inline-block; float:left; margin-right: 20px;">
            <h4>Staff Functions</h4>
            <ul>
                <li><a href="viewInventory.php">View Inventory</a></li>
                <li><a href="updateInventory.php">Update Inventory</a></li>
                <li><a href="viewPendingOrders.php">View/Ship Pending Orders</a></li>
            </ul>
        </div>
        <?php
            if(!class_exists("StaffDAO"))
                require "../DAOs/StaffDAO.php";
            $staffDAO = new StaffDAO();
            if($staffDAO->authenticateManager($_SESSION['current_staff_id'],
                                              $_SESSION['current_staff_password']))
            {
                echo '<div style="display:inline-block; float:left">
                            <h4>Manager Functions</h4>
                            <ul>
                                <li><a href="salesStatistics.php">Sales Statistics</a></li>
                                <li><a href="viewPromotionHistory.php">View Sales Promotions</a></li>
                                <li><a href="startPromotion.php">Start a Sales Promotion</a></li>
                                <li><a href="#">Add New Staff Member</a></li>
                                <li><a href="#">Remove Items from Inventory</a></li>
                                <li><a href="#">Add Items to Inventory</a></li>
                            </ul>
                        </div>';
            }
        ?>
        <?php
            include_once "../layout/footer.php";
        ?>
    </body>
</html>