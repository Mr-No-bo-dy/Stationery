<?php require_once 'app/resources/views/site/components/header.php' ?>

<main>
    <h1>Hi, <?= $_SESSION['user']->name ?? 'guest' ?></h1>

</main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>