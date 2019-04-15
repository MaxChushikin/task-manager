<?php

require __DIR__ . '/../app/DB.php';
require __DIR__ . '/../model/User.php';
require __DIR__ . '/../model/Model.php';


$project_model = new \model\Model();
$user_model = new \model\User();

if (isset($_GET['action'])) {
    $_GET['action']();
} else {
    index();
}

function index()
{

    if (validateSession()){
        start();
    } else {
        include './view/main.php';
    }

}

function isLogged()
{

}

function register()
{


    global $user_model;
    $model = $user_model;

    $json[] = array();


    if (isset($_POST)){

        if (mb_strlen($_POST['login'] ,'UTF-8') >= 6 && mb_strlen($_POST['login'] ,'UTF-8') <= 32 && mb_strlen($_POST['password'] ,'UTF-8') >= 6 && mb_strlen($_POST['password'] ,'UTF-8') <= 32){

            $user_validate = $model->getUser($_POST['login']);

            if (!$user_validate){

                $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $data = array(
                    'login'     => $_POST['login'],
                    'hash'  => $hash
                );

                $user_id = $model->addUser($data);

                setSession($user_id);
                $json['success'] = 'Success';
            } else {
                $json['error'] = 'User with this login already exists';
            }
        } else {
            $json['error'] = 'Login and Password must be at least 6 characters';
        }
    } else {
        $json['error'] = 'No data!';
    }

    echo json_encode($json);
}

function login()
{

    $json = array();



    if ($_POST){
        global $user_model;
        $model = $user_model;

        // Login validate
        $user_info = $model->getUser($_POST['login']);

        if (isset($user_info) && !empty($user_info)){

            if (password_verify($_POST['password'], $user_info['password'])) {
                setSession($user_info['id']);
                $json['success'] = 'Success';
            } else {
                $json['error']['password'] = 'Password is incorrect';
            }
        } else {
            $json['error']['login'] = 'This Login is not registered';
        }
    } else {
        $json['error']['nodata'] = 'No data';
    }

    echo json_encode($json);
}

function logout()
{
    $json = array();

    session_start();
    session_unset();

    echo json_encode($json);
}

function setSession($user_id) {


    session_start();
    global $user_model;
    $model = $user_model;

    $date = date("Y-m-d H:i:s");

    $data = array(
        'user_id'   => $user_id,
        'date_added' => $date
    );

    $session_id = $model->addSession($data);




    $session_info = array(
        'session_id' => $session_id,
        'user_id'    => $user_id,
        'date_added' => $date,
    );

    $_SESSION['user_session'] = $session_info;


}

function validateSession()
{

    session_start();

    global $user_model;
    $model = $user_model;

    $validate = $model->validateSession($_SESSION['user_session']);


    if (!$validate) {
        session_unset();
        return false;
    } else {
        return true;
    }
}

function start()
{


    validateSession();

    $title = 'Simple todo lists';
    $slogan = 'By Maxim Chushikin';
    $logout = true;
    global $project_model;
    $model = $project_model;


    $projects_info = $model->getProjects();

    $projects = array();

    foreach ($projects_info as $item) {

        $tasks = $model->getTasksByProjectId($item['id']);

        $projects[] = array(
            'id' => $item['id'],
            'name' => $item['name'],
            'tasks' => $tasks,
        );
    }

    include './view/main.php';
}

function addProject()
{

    global $project_model;
    $model = $project_model;

    $json[] = array();

    if (isset($_POST['project_name']) && mb_strlen($_POST['project_name'], 'utf8') > 3) {
        $json['id'] = $model->addProject($_POST);
    } else {
        $json['error']['error_name'] = 'Project name must contains less then 3 characters!';
    }

    echo json_encode($json);
}

function editProject()
{

    global $project_model;
    $model = $project_model;

    $json[] = array();

    if (!isset($_POST['project_name']) || mb_strlen($_POST['project_name'], 'utf8') < 3) {
        $json['error']['error_project_id'] = 'Project name must contains less then 3 characters!';
    } elseif (!isset($_POST['project_id']) || $_POST['project_id'] < 1) {
        $json['error']['error_project_id'] = 'Project ID lost!';
    } else {
        $model->editProject($_POST);
    }

    echo json_encode($json);
}

function removeProject()
{

    global $project_model;
    $model = $project_model;

    $json[] = array();

    if (!isset($_POST['project_id']) || $_POST['project_id'] < 3) {
        $json['error']['error_project_id'] = 'Project ID lost!';
    } else {
        $model->removeProject($_POST);
    }

    echo json_encode($json);
}

function addTask()
{

    global $project_model;
    $model = $project_model;

    $json[] = array();

    if (!isset($_POST['task_name']) && mb_strlen($_POST['task_name'], 'utf8') < 3) {
        $json['error']['error_name'] = 'Название должно быть не менее трёх символов';
    } elseif (!isset($_POST['project_id']) || $_POST['project_id'] < 1) {
        $json['error']['error_project_id'] = 'Project ID lost!';
    } else {
        $json['task_id'] = $model->addTask($_POST);
        $json['project_id'] = $_POST['project_id'];
    }

    echo json_encode($json);
}

function editTask()
{

    global $project_model;
    $model = $project_model;

    $json[] = array();

    if (!isset($_POST['task_id']) || $_POST['task_id'] < 1) {
        $json['error']['error_task_id'] = 'Task ID lost!';
    } elseif (isset($_POST['task_name']) && mb_strlen($_POST['task_name'], 'utf8') < 3) {
        $json['error']['task_name'] = 'Task name must contains less then 3 characters!';
    } elseif (isset($_POST['priority']) && $_POST['priority'] < 1 || $_POST['priority'] > 3) {
        $json['error']['priority'] = 'Priority is incorrect!';
    } else {
        $model->editTask($_POST);
    }

    echo json_encode($json);
}

function removeTask()
{

    global $project_model;
    $model = $project_model;

    $json[] = array();

    if (!isset($_POST['task_id']) || $_POST['task_id'] < 3) {
        $json['error']['error_task_id'] = 'Task ID lost!';
    } else {
        $model->removeTask($_POST);
    }

    echo json_encode($json);
}
