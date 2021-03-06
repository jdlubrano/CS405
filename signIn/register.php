<?php
/**
 * Displays form for customer to register.
 * User: Joel
 * Date: 4/16/14
 * Time: 11:58 PM
 */
?>

<html>
    <head>
        <?php include_once "../layout/headerTags.php"; ?>
    </head>
    <body>
        <?php
            include_once "../layout/navbar.php";
            include_once "../layout/sidebar.php";
            if(isset($_SESSION['INVALID_CUSTOMER']))
            {
                $msg = $_SESSION['INVALID_CUSTOMER'];
                echo "<div class=alert>$msg</div><br />";
                unset($_SESSION['INVALID_CUSTOMER']);
            }
        ?>
        <form method="post" action="createCustomer.php">
            <label for="name">Name: </label>
            <input id="name" name="name" type="text" /><br />
            <label for="email">Email: </label>
            <input id="email" name="email" type="text" /><br />
            <label for="password">Password: </label>
            <input id="password" name="password" type="password"/><br />
            <label for="address">Address: </label>
            <input size="100" id="address" name="address" value="Address, City, State, Zip"/><br />
            <button type="submit">Register</button>
        </form>
        <?php include_once "../layout/footer.php"; ?>
    </body>
</html>