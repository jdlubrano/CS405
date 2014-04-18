<?php
/**
 * Sign-in page for staff.
 * User: Joel
 * Date: 4/17/14
 * Time: 4:45 PM
 */
?>

<html>
    <head>
        <?php include_once "../layout/headerTags.php"; ?>
    </head>
    <body>
        <h2>Staff Sign-In</h2>
        <?php
            include_once "../layout/navbar.php";
            include_once "../layout/sidebar.php";
            if(isset($_SESSION['FAILED_LOGIN']) && $_SESSION["FAILED_LOGIN"])
            {
                $msg = "Sign in failed. You have entered invalid credentials.";
                echo "<div class=\"alert\">$msg</div><br />";
            }
            $_SESSION['FAILED_LOGIN'] = false;
        ?>
        <div id="signInBox">
            <form method="post" action="signInStaff.php">
                <label for="idInput">Staff ID: </label>
                <input type="text" name="staffId" id="idInput" /><br />
                <label for="passwordInput">Password: </label>
                <input type="password" name="staffPassword" id="passwordInput" /><br />
                <button type="submit">Sign-In</button>
            </form>
        </div>
        <?php include_once "../layout/footer.php"; ?>
    </body>
</html>