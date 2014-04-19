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
} 