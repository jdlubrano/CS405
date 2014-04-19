<?php
/**
 * Class: StaffDAO
 * User: Joel
 * Date: 4/17/14
 * Time: 5:00 PM
 */
if(!class_exists("DB_Connector"))
{
    require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR .
        "utilities" . DIRECTORY_SEPARATOR . "DB_Connector.php");
}

class StaffDAO {

    const GET_ALL_STAFF = 'SELECT * FROM Staff';

    const AUTHENTICATE_STAFF = "SELECT * FROM Staff WHERE staff_id = ? AND password = ?";

    const GET_STAFF_BY_ID = "SELECT * FROM Staff WHERE staff_id = ?";

    const CREATE_STAFF = "INSERT INTO Staff(name, password, manager) VALUES (?,?,?)";

    public function __construct(){}

    public function getAllStaff()
    {
        return DB_Connector::getInstance()->executeSimpleQuery(self::GET_ALL_STAFF);
    }

    public function authenticateStaff($id, $password)
    {
        $result = DB_Connector::getInstance()->executePreparedQuery(self::AUTHENTICATE_STAFF, array($id, $password));
        if($result->rowCount())
            return true;
        else
            return false;
    }

    public function authenticateManager($id, $password)
    {
        $result = DB_Connector::getInstance()->executePreparedQuery(self::AUTHENTICATE_STAFF,
                                                                    array($id, $password));
        $row = $result->fetch();
        return $row['manager'];
    }

    public function createStaff($name, $password, $manager)
    {
        $result = DB_Connector::getInstance()->executePreparedQuery(self::CREATE_STAFF,
                                               array($name, $password, $manager));
        return $result;
    }

    public function getStaffById($id)
    {
        $result = DB_Connector::getInstance()->executePreparedQuery(self::GET_STAFF_BY_ID, array($id));
        return $result;
    }
} 