<?php

namespace App;

use mysqli;

/**
 * Class Database
 *
 * @author A. Suvorkin
 */
class Database
{
    /**
     * @var mysqli
     */
    private $mysqli;

    /**
     * Database constructor.
     */
    public function __construct()
    {
        $this->mysqli = new mysqli(
            'db',
            'root',
            '123',
            'test'
        );
        $this->mysqli->set_charset('utf8');
    }

    /**
     * @return \mysqli_stmt
     */
    public function createTable()
    {
        $query = "CREATE table `test`.`bills_ru_events`(
             `id` INT(6) AUTO_INCREMENT PRIMARY KEY,
             `date` DATETIME DEFAULT NULL, 
             `title` VARCHAR (230) DEFAULT NULL,
             `url` VARCHAR (240) UNIQUE NOT NULL)  ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        return $this->query($query);
    }

    /**
     * @param $query
     * @return \mysqli_stmt
     */
    public function query($query)
    {
        $queryPrepare = $this->mysqli->prepare($query);
        $queryPrepare->execute();

        return $queryPrepare;
    }
}