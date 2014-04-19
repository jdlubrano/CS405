<?php
    require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR .
                "config" . DIRECTORY_SEPARATOR . "globals.php");
    if(session_status() == PHP_SESSION_NONE)
        session_start();
?>
<div id="headerWrapper">
    <div id="navbar" style="background-image:url(<?php echo APPLICATION_ROOT ?>/images/bannerBackground.png)">
        <div class="navbar-left" id="signInContainer">
            <a href="<?php echo APPLICATION_ROOT ?>/signIn" id="signInLink">Sign In/Register</a>
        </div>
        <div class="navbar-left" id="myAccountContainer">
            <?php displayMyOrdersLink(); ?>
        </div>
        <div class="navbar-left" id="myCartContainer">
            <?php displayMyCartLink(); ?>
        </div>
        <div class="navbar-left" id="signOutContainer">
            <?php displaySignOutLink(); ?>
        </div>
        <div class="navbar-left" id="currentUserContainer">
            <?php displayCurrentUser(); ?>
        </div>
        <div id="searchFormContainer">
            <form id="searchForm" method="get" action="<?php echo APPLICATION_ROOT ?>/shopping/search.php">
                <label for="searchBar">Search Store: </label>
                <input type="text" name="keyword" id="searchBar" />
            </form>
        </div>
    </div>
    <div class="titleBanner">
        <a href="<?php echo APPLICATION_ROOT ?>/index.php">RetroniX</a>
        <span id="slogan">"We sell stuff, you buy stuff."</span>
    </div>
</div>

<?php

    function displayMyOrdersLink()
    {
        if(isset($_SESSION['current_customer_email']))
        {
            echo "<a href=" . APPLICATION_ROOT . "/shopping/myOrders.php >My Orders</a>";
        }
    }

    function displayMyCartLink()
    {
        if(isset($_SESSION['current_customer_email']))
        {
            echo "<a href=" . APPLICATION_ROOT . "/shopping/viewCart.php".">My Cart</a>";
        }
    }

    function displaySignOutLink()
    {
        if(isset($_SESSION['current_customer_email']) ||
            isset($_SESSION['current_staff_id']))
        {
            echo "<a href=" . APPLICATION_ROOT . "/signOut.php>Sign Out</a>";
        }
    }

    function displayCurrentUser()
    {
        if(!class_exists("CustomerDAO"))
        {
            try
            {
                require(dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR .
                    "DAOs" . DIRECTORY_SEPARATOR . "CustomerDAO.php");
            }catch(Exception $e)
            {
                die("REQUIRE ERROR: $e");
            }
        }

        if(!class_exists("StaffDAO"))
        {
            require(dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR .
                "DAOs" . DIRECTORY_SEPARATOR . "StaffDAO.php");
        }
        $currentUser = '';
        if(isset($_SESSION['current_customer_email']))
        {
            $customerDAO = new CustomerDAO();
            $result = $customerDAO->getCustomerByEmail($_SESSION['current_customer_email']);
            if($row = $result->fetch());
                $currentUser = $row['name'];

        }elseif(isset($_SESSION['current_staff_id']))
        {
            $staffDAO = new StaffDAO();
            $result = $staffDAO->getStaffById($_SESSION['current_staff_id']);
            if($row = $result->fetch());
                $currentUser = $row['name'];
        }
        if(strlen($currentUser) > 0)
            echo "Currently signed in as $currentUser.";
        else
            echo "Currently not signed in.";
    }

?>