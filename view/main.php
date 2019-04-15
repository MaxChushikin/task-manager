<?php include 'view/header.php'; ?>
<div class="container">
    <h1 class="title"><?= $title; ?></h1>
    <h2 class="slogan"><?= $slogan; ?></h2>
    <?php if (isset($projects)) : ?>
    <div class="todo-list-container">
        <?php foreach ($projects as $project) : ?>
            <div class="todo-list" data-project_id="<?= $project['id'] ?>">
                <div class="todo-list-header">
                    <div class="left">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <div class="project-header-title">
                            <h5 class="project-header-title-element"><?= $project['name'] ?></h5>
                        </div>
                    </div>
                    <div class="right">
                        <i class="edit-project fas fa-pencil-alt"></i>
                        <i class="remove-project fas fa-trash-alt"></i>
                    </div>
                </div>
                <div class="todo-list-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th colspan="4">
                                <div class="input-group">
                                    <a href="javascript:void(0)"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                    <input type="text" name="task-name" class="form-control" placeholder="Start typing here to create a task">
                                    <div class="input-group-append">
                                        <button class="add-task btn btn-outline-secondary" type="button"><span>Add Task</span></button>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($project['tasks'] as $task) : ?>
                            <tr data-task_id="<?= $task['id'] ?>">
                                <td class="checkbox">
                                    <div class="custom-control custom-checkbox">
                                        <input <?php if ($task['status']) : ?>checked="checked"<?php endif ;?> type="checkbox" class="status custom-control-input" id="status<?= $task['id'] ?>">
                                        <label class="custom-control-label" for="status<?= $task['id'] ?>"></label>
                                    </div>
                                </td>
                                <td class="task-title"><?= $task['name'] ?></td>
                                <td class="priority">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="priority<?= $task['id'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?php if ($task['priority'] == 1) : echo 'High' ?>
                                            <?php elseif ($task['priority'] == 2) : echo 'Middle' ?>
                                            <?php else : echo 'low' ?>
                                            <?php endif; ?>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="priority<?= $task['id'] ?>">
                                            <button data-priority="1" class="dropdown-item" type="button">High</button>
                                            <button data-priority="2" class="dropdown-item" type="button">Middle</button>
                                            <button data-priority="3" class="dropdown-item" type="button">Low</button>
                                        </div>
                                    </div>
                                </td>
                                <td class="operate">
                                    <i class="edit-task fas fa-pencil-alt"></i>
                                    <i class="remove-task fas fa-trash-alt"></i>
                                </td>
                            </tr>
                            <?php endforeach ;?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endforeach ;?>
    </div>
    <div class="text-center">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProjectModal">Add TODO List</button>
    </div>
    <?php endif; ?>
</div>
<?php include 'view/footer.php'; ?>
