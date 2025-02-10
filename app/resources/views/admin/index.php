<?php require_once 'app/resources/views/admin/components/header.php';

?>

<main>

    <h1>Hi, <?= $_SESSION['user']->fillable['name'] ?? 'guest'  ?> ADMIN</h1>
    <h2><?=$message?? ''?></h2>

</main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>