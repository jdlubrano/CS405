<?php
/**
 * ItemsDAO.php
 * User: Joel
 * Date: 4/17/14
 * Time: 9:05 PM
 */

class ItemsDAO {

    const GET_ALL_ITEMS_FOR_SALE = "SELECT * FROM Items I WHERE I.item_id
                                    NOT IN(SELECT item_id FROM item_orders)";

    const GET_ALL_ITEMS_FOR_SALE_AND_NOT_IN_CART = "SELECT * FROM Items I";

    public function __construct(){}

    /**
     * @return PDOStatement
     */
    public function getAllItemsForSale()
    {
        if(!isset($_SESSION['current_customer_email']))
            $result = DB_Connector::getInstance()->executeSimpleQuery(self::GET_ALL_ITEMS_FOR_SALE);
        else
            $result = DB_Connector::getInstance()->executePreparedQuery(self::GET_ALL_ITEMS_FOR_SALE_AND_NOT_IN_CART,
                                                                        array($_SESSION['current_customer_email']));
        return $result;
    }
} 