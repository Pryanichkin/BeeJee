<?php


namespace php\core;

use mysqli;

class DB
{
    private const HOST = 'localhost';
    private const PORT = '3306';
    private const DB = 'u0382424_beejee';
    private const USER = 'u0382424_beejee';
    private const PASSWORD = 'Password+1';
    private static $instance;
    private $conn;
    private $isOk;

    private static function getInstance() {
        if (self::$instance == null) {
            $className = __CLASS__;
            self::$instance = new $className;
        }

        return self::$instance;
    }

    private static function initConnection() {
        $instance = self::getInstance();
        $conn = $instance->conn;

        if ($instance->isOk && $conn) return $instance->conn;

        $conn = new mysqli(self::HOST, self::USER, self::PASSWORD, self::DB, self::PORT);

        if ($conn->connect_error) {
            $instance->isOk = false;
        } else {
            $instance->isOk = true;
            $conn->set_charset('utf8');
        }

        $instance->conn = $conn;

        return $conn;
    }

    private function __construct() {
    }

    public function __destruct() {
        if ($this->conn) $this->conn->close;
    }

    public static function query($query) {
        $instance = self::getInstance();
        $conn = self::initConnection();

        if (!$instance->isOk) {
            return false;
        }

        $result = $conn->query($query);

        if ($conn->error) {
            return false;
        }

        if (is_bool($result)) {
            return $result;
        } else {
            $answer = $result->fetch_all(MYSQLI_ASSOC);
            $result->close();
            return $answer;
        }
    }
}