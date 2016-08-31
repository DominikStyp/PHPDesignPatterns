<?php
/*
 * User: Dominik
 * Date: 2016-08-31
 * Time: 22:11
 */
interface DatabaseI {
    public function connect($user, $password, $host, $dbName);
    public function query($query);
    public function fetchRow($query);
    public function fetchAllRows($query);
}

class MySQLDB implements DatabaseI {

    public function __construct($user, $password, $host, $dbName){
        $this->connect($user, $password, $host, $dbName);
    }

    public function fetchRow($query) {
        $this->query($query);
        return array(
            ['id' => '1', 'title' => 'Title 1', 'content' => 'Content 1'],
        );
    }

    public function fetchAllRows($query) {
        $this->query($query);
        return array(
            ['id' => '1', 'title' => 'Title 1', 'content' => 'Content 1'],
            ['id' => '2', 'title' => 'Title 2', 'content' => 'Content 2']
        );
    }

    public function connect($user, $password, $host, $dbName) {
        echo "Connected to MySQL database: {$dbName} with data {$host}://{$user}:{$password} <br />";

    }

    public function query($query) {
        echo "Query to MySQLDB: $query <br />";
    }
}

class PostgresDB implements DatabaseI {

    public function __construct($user, $password, $host, $dbName){
        $this->connect($user, $password, $host, $dbName);
    }

    public function fetchRow($query) {
        $this->query($query);
        return array(
            ['id' => '1', 'title' => 'Title 1', 'content' => 'Content 1'],
        );
    }

    public function fetchAllRows($query) {
        $this->query($query);
        return array(
            ['id' => '1', 'title' => 'Title 1', 'content' => 'Content 1'],
            ['id' => '2', 'title' => 'Title 2', 'content' => 'Content 2']
        );
    }

    public function connect($user, $password, $host, $dbName) {
        echo "Connected to Postgres database: {$dbName} with data {$host}://{$user}:{$password} <br />";

    }

    public function query($query) {
        echo "Query to PostgresDB: $query <br />";
    }
}

class DatabaseFactory {

    private static $configs = array(
        'mysql' => ['user' => 'myuser', 'password' => 'mysql123', 'host' => '127.0.0.1', 'dbName' => 'mysql_database', 'className' => 'MySQLDB', 'instance' => null ],
        'postgres' => ['user' => 'pguser', 'password' => 'pg123', 'host' => '127.0.0.2', 'dbName' => 'postgres_database', 'className' => 'PostgresDB', 'instance' => null ]
    );

    /**
     * Longer version if classes constructors have different parameters order or/and number
     * This is also handy when you need to make a query upon instantiating database
     * @param $name
     * @return MySQLDB|PostgresDB
     * @throws Exception
     */
    public static function getDatabase($name){
        // reference to avoid copy of the config array,
        // we want instance to be stored there
        $conf = & self::$configs[$name];
        if(empty($conf)){
            throw new Exception("Unknown database type!");
        }
        switch($name){
            case 'mysql':
                 //singleton pattern - if instance is defined return existing, if not create new
                 if(empty($conf['instance'])) {
                     $conf['instance'] = new MySQLDB($conf['user'], $conf['password'], $conf['host'], $conf['dbName']);
                     $conf['instance']->query('SET NAMES "utf8"');
                 }
            break;
            case 'postgres':
                if(empty($conf['instance'])){
                    $conf['instance'] = new PostgresDB($conf['user'],$conf['password'],$conf['host'],$conf['dbName']);
                }
            break;
        }
        return $conf['instance'];
    }

    /**
     * You can use handy reflection when constructors get the same parameters in the same order
     * @param $name
     * @return MySQLDB|PostgresDB
     * @throws Exception
     */
    public static function getDatabaseShorter($name){
        // reference to avoid copy of the config array,
        // we want instance to be stored there
        $conf = & self::$configs[$name];
        if(empty($conf)){
            throw new Exception("Unknown database type!");
        }
        if(empty($conf['instance'])){
            $conf['instance'] = new $conf['className']($conf['user'],$conf['password'],$conf['host'],$conf['dbName']);
        }
        return $conf['instance'];
    }

}

///////////// example //////////
$db = DatabaseFactory::getDatabaseShorter('mysql');
$db = DatabaseFactory::getDatabaseShorter('mysql'); //notice that only one "connected" message will appear
$row = $db->fetchRow("SELECT * FROM table");
print_r($row);