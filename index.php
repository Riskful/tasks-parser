<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Парсер</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<?php date_default_timezone_set('Europe/Moscow'); ?>

<?php require 'vendor/autoload.php'; ?>

<?php $parser = new \App\MyParser(); ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Список событий</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <?php /** @var \App\Event $event */ ?>
            <?php foreach ($parser->getEvents() as $event): ?>
                <ul class="list-group">
                    <li class="list-group-item">
                        <b>Заголовок: </b> <?php echo $event->getTitle(); ?>
                    </li>
                    <li class="list-group-item">
                        <b>Дата: </b> <?php echo $event->getDate()->format('Y-m-d'); ?>
                    </li>
                    <li class="list-group-item">
                        <b>Ссылка: </b> <?php echo $event->getUrl(); ?>
                    </li>
                </ul>
                <br>
            <?php endforeach; ?>
        </div>
    </div>
</div>

</body>
</html>