<?php
    require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR .
                "config" . DIRECTORY_SEPARATOR . "globals.php");
?>
<div id="headerWrapper">
    <div id="navbar" style="background-image:url(/<?php echo APPLICATION_ROOT ?>/images/bannerBackground.png)">
        <div id="signInContainer">
            <a href="/<?php echo APPLICATION_ROOT . DIRECTORY_SEPARATOR ?>signIn" id="signInLink">Sign In/Register</a>
        </div>
        <div id="searchFormContainer">
            <form id="searchForm" method="get" action="/<?php echo APPLICATION_ROOT ?>/shopping/keywordSearch">
                <label for="searchBar">Search: </label>
                <input type="text" name="keyword" id="searchBar" />
            </form>
        </div>
    </div>
    <div class="titleBanner">
        RetroniX
    </div>
</div>
