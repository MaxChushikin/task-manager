<?php

require __DIR__ . '/../app/DB.php';
require __DIR__ . '/../model/Model.php';


$model = new \model\Model();


index();


function index()
{

    global $model;

    $title = 'Technical requirements';

    //hide Account button on technical page
    $technical = true;

    $task_titles = array(
//        'First Task',
        'Second Task',
        'Third Task',
        'Fourth Task',
        'Fifth Task',
        'Sixth Task',
        'Seventh Task',
        'Eighth Task',
    );

    $task_text = array(
//        'get all statuses, not repeating, alphabetically ordered',
        'get the count of all tasks in each project, order by tasks count descending',
        'get the count of all tasks in each project, order by projects names',
        'get the tasks for all projects having the name beginning with "N" letter',
        'get the list of all projects containing the "a" letter in the middle of the name, and show the tasks count near each project. Mention that there can exist projects without tasks and tasks with project _ id = NULL',
        'get the list of tasks with duplicate names. Order alphabetically',
        'get list of tasks having several exact matches of both name and status, from the project "Garage". Order by matches count',
        'get the list of project names having more than 10 tasks in status "completed". Order by project_id',
    );

    $task_sql = array(
//        '',
        'SELECT p.`name` as name, COUNT(t.`id`) as total FROM `projects` p INNER JOIN `tasks` t ON (p.id = t.projected) GROUP BY p.name ORDER BY COUNT(t.`id`) DESC',
        'SELECT p.`name` as name, COUNT(t.`id`) as total FROM `projects` p INNER JOIN `tasks` t ON (p.id = t.projected) GROUP BY p.name ORDER BY p.name',
        "SELECT `name`, COUNT(`id`) as total FROM `tasks` WHERE name LIKE 'N%' GROUP BY name",
        "SELECT p.`name` as name, COUNT(t.`id`) as total FROM `projects` p INNER JOIN `tasks` t ON (p.id = t.projected) WHERE p.name LIKE '%a%' GROUP BY p.name",
        "SELECT `name`, COUNT(id) as total FROM `tasks` GROUP BY name HAVING COUNT(*) > 1 ORDER BY COUNT(id) desc",
        "SELECT `name`, COUNT(id) as total FROM `tasks` WHERE `projected` = 1 GROUP BY name, status HAVING COUNT(*) > 1 ORDER BY COUNT(id) desc",
        "SELECT p.`name` as name, COUNT(t.`projected`) as total FROM `projects` p INNER JOIN `tasks` t ON (p.id = t.projected) WHERE t.`status` = 1 GROUP BY p.`id` HAVING COUNT(*) > 10 ORDER BY p.`id`",
    );

    $tasks = array();

    foreach ($task_titles as $kay => $item) {
        $tasks[] = array(
            'title'         => $item,
            'text'     => $task_text[$kay],
            'result'        => $model->getTechnicalTask($task_sql[$kay])
        );
    }

    include './view/technical.php';
}