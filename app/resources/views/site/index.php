<?php require_once 'app/resources/views/site/components/header.php';
//echo '<pre>';
//var_dump($_SESSION);
?>

<main>
    <h1>Hi, <?= $_SESSION['user']->fillable['name'] ?? 'guest' ?></h1>

</main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>