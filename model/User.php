<?php

namespace model;

class User extends \app\DB
{
    function addUser($data)
    {

        $this->query("INSERT INTO `users` SET `login` = '" . $this->escape($data['login']) . "', `password` = '" . $data['hash'] . "', `date_added` =  NOW()");

        return $this->getLastId();
    }

    function getUser($login)
    {
        $query = $this->query("SELECT * FROM `users` WHERE `login` = '" . $this->escape($login) . "'");

        return $query->row;
    }

    function addSession($data){
        $this->query("INSERT INTO `sessions` SET `user_id` = '" . (int)$data['user_id'] . "', `date_added` =  '" . $data['date_added'] . "'");

        return $this->getLastId();
    }

    function validateSession($data)
    {
        $query = $this->query("SELECT * FROM `sessions` WHERE `session_id` = '" . (int)$data['session_id'] . "' AND `user_id` = '" . (int)$data['user_id'] . "' AND `date_added` =  '" . $data['date_added'] . "'");

        return $query->row;
    }
}
