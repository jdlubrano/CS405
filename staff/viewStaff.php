<?php
/**
 * viewStaff.php
 * User: Joel
 * Date: 4/19/14
 * Time: 1:38 PM
 */

require_once 'authenticateManager.php';
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
            if(!class_exists("StaffDAO"))
                require '../DAOs/StaffDAO.php';
            $staffDAO = new StaffDAO();
            $result = $staffDAO->getAllStaff();
        ?>
        <table class="separated">
            <thead>
                <tr>
                    <th>Staff ID</th>
                    <th>Name</th>
                    <th>Password</th>
                    <th>Staff Type</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row = $result->fetch())
                    {
                        $id = $row['staff_id'];
                        $name = $row['name'];
                        $password = $row['password'];
                        $manager = $row['manager'];
                        $staffType = ($manager ? "Manager" : "Regular Staff");
                        echo "<tr>
                                <td>$id</td>
                                <td>$name</td>
                                <td>$password</td>
                                <td>$staffType</td>
                              </tr>";
                    }
                ?>
            </tbody>
        </table>
    </body>
</html>