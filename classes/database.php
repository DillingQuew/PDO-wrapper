<?php
namespace database;
use PDO;
class MyPDO {
    protected static $instance;
    protected function __clone() {}
    public static function getInstance() {
        if (empty(self::$instance)) {
            $default_options = [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ];
            try {
                self::$instance =
                    new PDO('mysql:host=localhost;
                                dbname=site_db;
                                charset=utf8',
                        'root',
                        '',
                        $default_options);
            }
            catch(PDOException $error) {
                echo $error->getMessage();
            }
        } else {
            return self::$instance;
        }
    }
    private function __construct() {}
    public final static function run($sql, $args = NULL)
    {
        self::getInstance();
        if (!$args)
        {
            return self::$instance->query($sql);
        }
        $stmt = self::$instance->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}