<html>
    <head>
        <?php
            include_once "../layout/headerTags.php";
        ?>
    </head>
    <body>
        <h2>Customer Sign-In</h2>
        <?php
            include_once "../layout/navbar.php";
            include_once "../layout/sidebar.php";
            if(isset($_SESSION['FAILED_LOGIN']) && $_SESSION["FAILED_LOGIN"])
            {
                $msg = "Sign in failed. You have entered invalid credentials.";
                echo "<div class=\"alert\">$msg</div><br />";
                unset($_SESSION['FAILED_LOGIN']);
            }
            $_SESSION['FAILED_LOGIN'] = false;
            if(isset($_SESSION['NEEDS_TO_SIGN_IN']) && $_SESSION['NEEDS_TO_SIGN_IN'])
            {
                echo "<div class=\"alert\">Please sign in.</div><br />";
                unset($_SESSION['NEEDS_TO_SIGN_IN']);
            }
        ?>
        <div id="signInBox">
            <form method="post" action="signInCustomer.php">
                <label for="emailInput">Email: </label>
                <input type="text" name="customerEmail" id="emailInput" /><br />
                <label for="passwordInput">Password: </label>
                <input type="password" name="customerPassword" id="passwordInput" /><br />
                <button type="submit">Sign-In</button>
            </form>
            <a href="register.php">Are you a new customer?</a>
        </div>
    <?php include_once "../layout/footer.php"; ?>
    </body>
</html>