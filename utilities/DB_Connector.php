<?php
/**
 * DB_Connector.php
 * Author: Joel
 * Date: 3/19/14
 */

define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST'));
define('DB_PORT',getenv('OPENSHIFT_MYSQL_DB_PORT'));
define('DB_USER',getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
define('DB_PASS',getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
define('DB_NAME',getenv('OPENSHIFT_GEAR_NAME'));

class DB_Connector {

    private static $PDO;
    private static $db_database;
    private static $db_username;
    private static $db_password;
    private static $db_hostname;
    private static $instance;

    /**
     * @param PDO $PDO
     */
    public function setPDO($PDO)
    {
        self::$PDO = $PDO;
    }

    /**
     * @return PDO
     */
    public function getPDO()
    {
        return self::$PDO;
    }

    /**
     * @param string $db_database
     */
    public function setDbDatabase($db_database)
    {
        self::$db_database = $db_database;
        self::connectPDO();
    }

    /**
     * @return string
     */
    public function getDbDatabase()
    {
        return self::$db_database;
    }

    /**
     * @param string $db_hostname
     */
    public function setDbHostname($db_hostname)
    {
        self::$db_hostname = $db_hostname;
    }

    /**
     * @return string
     */
    public function getDbHostname()
    {
        return self::$db_hostname;
    }

    /**
     * @param string $db_password
     */
    public function setDbPassword($db_password)
    {
        self::$db_password = $db_password;
    }

    /**
     * @return string
     */
    public function getDbPassword()
    {
        return self::$db_password;
    }

    /**
     * @param string $db_username
     */
    public function setDbUsername($db_username)
    {
        self::$db_username = $db_username;
    }

    /**
     * @return string
     */
    public function getDbUsername()
    {
        return self::$db_username;
    }

    private function __construct()
    {
        self::$db_hostname = DB_HOST;
        self::$db_database = DB_NAME;
        self::$db_username = DB_USER;
        self::$db_password = DB_PASS;
        self::connectPDO();
    }

    /**
     * Overwrite default clone function.
     */
    private function __clone(){}

    private function connectPDO()
    {
        try
        {
            self::$PDO = new PDO("mysql:host=".self::$db_hostname.";dbname=".self::$db_database,
                self::$db_username, self::$db_password,
                array(PDO::ATTR_PERSISTENT => true));

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * @param $queryString
     * @return PDOStatement The query results ready to be fetched.
     */
    public function executeSimpleQuery($queryString)
    {
        try
        {
            return self::$PDO->query($queryString);
        }
        catch(PDOException $e)
        {
            die("Failed in method executeSimpleQuery: " . $e->getMessage() . "\n $queryString");
        }
    }

    /**
     * @param $queryString
     * @param $paramArray
     * @return PDOStatement The query results ready to be fetched.
     */
    public function executePreparedQuery($queryString, $paramArray)
    {
        try
        {
            $PDOStatement = self::$PDO->prepare($queryString);
            $PDOStatement->execute($paramArray);
            return $PDOStatement;
        }
        catch(PDOException $e)
        {
            die("Failed in method executePreparedQuery: " . $e->getMessage() . "\n $queryString");
        }
    }

    public function close()
    {
        self::setPDO(null);
    }

    public static function getInstance()
    {
        if(!isset(self::$instance))
            self::$instance = new DB_Connector();
        return self::$instance;
    }

} 