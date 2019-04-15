<?php
/**
 * Created by PhpStorm.
 * User: Пользователь
 * Date: 30.03.2019
 * Time: 20:37
 */

namespace app;
use mysqli;


class DB
{

    private $connection;
    protected $sql;

    public function __construct($hostname = 'localhost', $username = 'root', $password = '', $database = 'task-manager')
    {
        $this->connection = new mysqli($hostname, $username, $password, $database);
        $this->connection->set_charset("utf8");

        if ($this->connection->connect_error) {
            echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
            echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
    }

    public function query($sql)
    {

        $query = $this->connection->query($sql);

        if (!$this->connection->errno) {



            if ($query instanceof \mysqli_result) {
                $data = array();

                while ($row = $query->fetch_assoc()) {
                    $data[] = $row;
                }

                $result = new \stdClass();
                $result->num_rows = $query->num_rows;
                $result->row = isset($data[0]) ? $data[0] : array();
                $result->rows = $data;

                $query->close();

                return $result;
            } else {
                return true;
            }
        } else {
            throw new \Exception('Error: ' . $this->connection->error . '<br />Error No: ' . $this->connection->errno . '<br />' . $sql);
        }
    }

    public function escape($value) {
        return $this->connection->real_escape_string($value);
    }

    public function getLastId() {
        return $this->connection->insert_id;
    }
}