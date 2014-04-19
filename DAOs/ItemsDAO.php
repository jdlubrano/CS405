<?php
/**
 * ItemsDAO.php
 * User: Joel
 * Date: 4/17/14
 * Time: 9:05 PM
 */

if(!class_exists("DB_Connector"))
    require "../utilities/DB_Connector.php";

class ItemsDAO {

    const GET_ALL_ITEMS_FOR_SALE = "SELECT * FROM Items I";

    const UPDATE_QUANTITY = "UPDATE Items SET quantity = ? WHERE item_id = ?";

    const GET_ITEMS_BY_KEYWORD = "SELECT * FROM Items I WHERE name LIKE ? OR description LIKE ?";

    const GET_VIDEO_GAMES = "SELECT * FROM Items I
                             WHERE description LIKE '%video game%' AND I.item_id
                             NOT IN(SELECT I2.item_id
                                    FROM Items I2
                                    WHERE name LIKE '%console%')";

    public function __construct(){}

    /**
     * @return PDOStatement
     */
    public function getAllItemsForSale()
    {
       $result = DB_Connector::getInstance()->executeSimpleQuery(self::GET_ALL_ITEMS_FOR_SALE);
       return $result;
    }

    public function updateQuantity($item_id, $quantity)
    {
        $result = DB_Connector::getInstance()->executePreparedQuery(self::UPDATE_QUANTITY,
                                                                    array($quantity, $item_id));
        return $result;
    }

    public function getItemsByKeyword($keyword)
    {
        $keyword = '%' . $keyword . '%';
        $result = DB_Connector::getInstance()->executePreparedQuery(self::GET_ITEMS_BY_KEYWORD,
                                                                   array($keyword, $keyword));
        return $result;
    }

    public function getVideoGames()
    {
        return DB_Connector::getInstance()->executeSimpleQuery(self::GET_VIDEO_GAMES);
    }
} 