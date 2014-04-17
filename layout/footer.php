<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 4/17/14
 * Time: 1:13 AM
 */
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR .
            "config" . DIRECTORY_SEPARATOR . "globals.php");
?>

<div id="footerWrapper">
    <div id="footer" style="background-image:url(/<?php echo APPLICATION_ROOT ?>/images/bannerBackground.png)">
        <div id="contactUsContainer">
            <a href="/<?php APPLICATION_ROOT ?>/contact">Contact Us</a>
        </div>
        <div id="staffPortalContainer">
            <a href="/<?php APPLICATION_ROOT ?>/staff">Staff Portal</a>
        </div>
    </div>
</div>