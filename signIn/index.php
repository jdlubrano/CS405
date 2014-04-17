<html>
    <head>
        <?php
            include_once "../layout/headerTags.php";
        ?>
    </head>
    <body>
        <?php
            include_once "../layout/navbar.php";
            include_once "../layout/sidebar.php";
            session_start();
            if(isset($_SESSION['FAILED_LOGIN']) && $_SESSION["FAILED_LOGIN"])
            {
                $msg = "Sign in failed. You have entered invalid credentials.";
                echo "<div class=\"alert\">$msg</div><br />";
            }
        ?>
        <div id="signInBox">
            <form method="post" action="authenticateUser.php">
                <label for="emailInput">Email: </label>
                <input type="text" name="customerEmail" id="emailInput" /><br />
                <label for="passwordInput">Password: </label>
                <input type="text" name="customerPassword" id="passwordInput" /><br />
                <button type="submit">Sign-In</button>
            </form>
            <a href="register.php">Are you a new customer?</a>
        </div>
    <?php include_once "../layout/footer.php"; ?>
    </body>
</html>