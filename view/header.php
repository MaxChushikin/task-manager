<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
          crossorigin="anonymous">
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <title><?= $title; ?></title>
</head>
<body>

<header id="page">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Task-manager</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/technical">Technical</a>
                </li>
                <?php if (!$technical): ?>
                <li class="nav-item">
                    <?php if (!$logout): ?>
                        <a class="nav-link" id href="javascript:void(0)" data-toggle="modal" data-target="#accountModal">Account</a>
                    <?php else: ?>
                        <a class="nav-link" href="javascript:void(0)" id="logout">Logout</a>
                    <?php endif ?>
                </li>
                <?php endif ?>
            </ul>
        </div>
    </nav

</header>



