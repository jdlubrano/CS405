<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 4/16/14
 * Time: 10:01 PM
 */

if($_SERVER['SERVER_NAME'] == 'localhost')
    define("APPLICATION_ROOT", "cs405");
else
    define("APPLICATION_ROOT", "");
define("VIEW_ONLY", 0);
define("ADD_TO_CART", 1);
define("UPDATE_INVENTORY", 2);
define("DELETE_ITEM", 3);
define("WEEKLY", 0);
define("MONTHLY", 1);
define("YEARLY", 2);
define("CONSOLE_SEARCH", -1);
define("GAMES_SEARCH", -2);
define("MUSIC_SEARCH", -3);
define("ACCESSORIES_SEARCH", -4);