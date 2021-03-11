<!DOCTYPE html>
<html lang="ru">

<?= $this->getContent(APP . '/views/template/header.php') ?>

<body>
    <div class="container">
        <?= $content ?>
    </div>

</body>

<?= $this->getContent(APP . '/views/template/footer.php') ?>

</html>