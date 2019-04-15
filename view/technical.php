<?php include 'view/header.php'; ?>
<div class="container">
    <h1 class="title"><?= $title; ?></h1>
    <div class="technical">
        <div class="row">
            <div class="col-4">
                <div class="list-group" id="list-tab" role="tablist">
                    <?php foreach ($tasks as $kay => $task) : ?>
                        <a class="list-group-item list-group-item-action <?php if ($kay == 0) echo 'active' ?>" id="task<?= $kay ?>-list" data-toggle="list" href="#task<?= $kay ?>" role="tab" aria-controls="home"><?= $task['title'] ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-8">
                <div class="tab-content technical-task " id="nav-tabContent">
                    <?php foreach ($tasks as $kay => $task) : ?>
                    <div class="tab-pane fade show <?php if ($kay == 0) echo 'active' ?>" id="task<?= $kay ?>" role="tabpanel" aria-labelledby="task<?= $kay ?>-list">
                        <h5><?= $task['title'] ?></h5>
                        <div>
                            <p><?= $task['text'] ?></p>
                            <ul class="list-group">
                                <?php foreach ( $task['result'] as $item ) : ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?= $item['name'] ?>
                                        <span class="badge badge-primary badge-pill"><?= $item['total'] ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'view/footer.php'; ?>
