<?php
/**
 * search.php
 * User: Joel
 * Date: 4/19/14
 * Time: 3:53 PM
 */
require_once '../config/globals.php';

if(!class_exists("DB_Connector"))
    require '../utilities/DB_Connector.php';

if(!class_exists("ItemsDAO"))
    require '../DAOs/ItemsDAO.php';

if(isset($_GET['keyword']) && strlen($_GET['keyword']) > 0)
{
    $gameFlag = false;
    $keyword = $_GET['keyword'];
    switch($keyword){
        case CONSOLE_SEARCH:
            $keyword = 'console';
            break;
        case GAMES_SEARCH:
            $keyword = 'video game';
            $gameFlag = true;
            break;
        case MUSIC_SEARCH:
            $keyword = 'player';
            break;
        default:
            break; // Do nothing special
    }
    $itemsDAO = new ItemsDAO();
    if($gameFlag)
    {
        $result = $itemsDAO->getVideoGames();

    }else
        $result = $itemsDAO->getItemsByKeyword($keyword);
}

require_once  "index.php";

