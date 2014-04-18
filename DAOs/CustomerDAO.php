<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 4/16/14
 * Time: 11:39 PM
 */
if(!class_exists("DB_Connector"))
{
    require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR .
                        "utilities" . DIRECTORY_SEPARATOR . "DB_Connector.php");
}

class CustomerDAO {

    const AUTHENTICATE_USER = "SELECT * FROM Customers WHERE email = ? AND password = ?";

    const CREATE_CUSTOMER = "INSERT INTO Customers(email, password, name, address, VIP) VALUES (?,?,?,?,?)";

    const GET_CUSTOMER_BY_EMAIL = "SELECT * FROM Customers WHERE email = ?";

    public function  __construct(){}

    /**
     * Checks email and password combination against the database.
     * @param $email
     * @param $password
     * @return true if customer is found
     */
    public function authenticateUser($email, $password)
    {
        $result = DB_Connector::getInstance()->executePreparedQuery(self::AUTHENTICATE_USER, [$email, $password]);
        if($result->rowCount())
            return true;
        else
            return false;
    }

    /**
     * Creates user with parameters in argument array.
     */
    public function createCustomer($customerArray)
    {
        $email = $customerArray['email'];
        $password = $customerArray['password'];
        $name = $customerArray['name'];
        $address = $customerArray['address'];
        if(isset($customerArray['VIP']))
            $VIP = $customerArray['VIP'];
        else
            $VIP = 0;
        $result = DB_Connector::getInstance()->executePreparedQuery(self::CREATE_CUSTOMER,
                                                                     array($email, $password, $name, $address, $VIP));
        if($result->rowCount())
            return true;
        else
            return false;
    }

    /**
     * Retrieves customer with email specified by parameter.
     * @param $email
     * @return PDOStatement
     */
    public function getCustomerByEmail($email)
    {
        $result = DB_Connector::getInstance()->executePreparedQuery(self::GET_CUSTOMER_BY_EMAIL, array($email));
        return $result;
    }
} 