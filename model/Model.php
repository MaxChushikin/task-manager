<?php

namespace model;

class Model extends \app\DB
{


    function getUser()
    {
        session_start();
        return isset($_SESSION['user_session']['user_id']) ? $_SESSION['user_session']['user_id'] : false;
    }

    function getProjects()
    {
        $result = $this->query("SELECT * FROM `projects` WHERE `user_id` = '" . (int)$this->getUser() . "'");

        return $result->rows;
    }

    function getProject($project_id)
    {
        $result = $this->query("SELECT * FROM `projects` WHERE `id` = '" . $project_id . "'");

        return $result->rows;
    }

    function getTasksByProjectId($project_id)
    {
        $result = $this->query("SELECT * FROM `tasks` WHERE `projected` = '" . $project_id . "' ORDER BY `priority` ASC");

        return $result->rows;
    }

    function addProject($data)
    {
        $this->query("INSERT INTO `projects` SET `name` = '" . $this->escape($data['project_name']) . "', `user_id` = '" . (int)$this->getUser() . "'");

        return $this->getLastId();
    }

    function editProject($data)
    {
        $this->query("UPDATE `projects` SET `name` = '" . $this->escape($data['project_name']) . "' WHERE `id` = '" . $this->escape($data['project_id']) . "'");
    }

    function removeProject($data)
    {
        $this->query("DELETE FROM `projects` WHERE `id` = '" . $this->escape($data['project_id']) . "'");
    }


    function addTask($data)
    {
        $this->query("INSERT INTO `tasks` SET `name` = '" . $this->escape($data['task_name']) . "', `projected` = '" . (int)$data['project_id'] . "'");

        return $this->getLastId();
    }

    function editTask($data)
    {

        if (!empty($data)) {
            $sql = "UPDATE `tasks` SET";

            if (isset($data['task_name'])) {
                $sql .= " `name` = '" . $this->escape($data['task_name']) . "'";
            }

            if (isset($data['status'])) {
                $sql .= " `status` = '" . (int)($data['status'] === 'true') . "'";
            }

            if (isset($data['date'])) {
                $sql .= " `date` = '" . $this->escape($data['date']) . "'";
            }

            if (isset($data['priority'])) {
                $sql .= " `priority` = '" . (int)$data['priority'] . "'";
            }

            $sql .= " WHERE `id` = '" . $this->escape($data['task_id']) . "'";

            $this->query($sql);
        }
    }

    function getTasks()
    {
        $result = $this->query('SELECT * FROM `tasks`');

        return $result->rows;
    }

    function getTask($task_id)
    {
        $result = $this->query("SELECT * FROM `tasks` WHERE `id` = '" . $task_id . "'");

        return $result->rows;
    }

    function removeTask($data)
    {
        $this->query("DELETE FROM `tasks` WHERE `id` = '" . $this->escape($data['task_id']) . "'");
    }

    function getTechnicalTask($sql)
    {
        return $this->query($sql)->rows;
    }
}
