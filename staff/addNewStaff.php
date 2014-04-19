<?php
/**
 * addNewStaff.php
 * User: Joel
 * Date: 4/19/14
 * Time: 1:36 PM
 */

require_once "authenticateManager.php";

?>

<html>
    <head>
        <?php include_once '../layout/headerTags.php'; ?>
    </head>
    <body>
        <?php
            include_once '../layout/navbar.php';
            include_once '../layout/sidebar.php';
            include_once '../layout/footer.php';
            if(isset($_SESSION['INVALID_STAFF']))
            {
                $msg = $_SESSION['INVALID_STAFF'];
                echo "<div class=alert>$msg</div><br />";
                unset($_SESSION['INVALID_STAFF']);
            }
        ?>
        <h2>Add New Item to Inventory</h2>
        <form method="post" action="createStaff.php">
            <label for="staffName">Name of Staff: </label>
            <input id="staffName" type="text" name="name" /><br/>
            <label for="password">Password: </label>
            <input type="text" id="password" name="password" /><br/>
            <label for="manager">Manager: </label>
            <input type="checkbox" id="manager" name="manager" value="1" /><br />
            <button type="submit">Add Staff Member</button>
        </form>
    </body>
</html>