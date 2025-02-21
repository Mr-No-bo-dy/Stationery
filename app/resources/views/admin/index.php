<?php require_once 'app/resources/views/admin/components/header.php';
//echo '<pre>';
//var_dump($_SESSION);
?>

<main>
<div class="wrapper">
    <h1>Hi, <?= $_SESSION['user']['name'] ?? 'guest'  ?> ADMIN</h1>
    <h2 class="warning"><?=$message?? ''?></h2>

    <p>here can be some information for admin, like fast link to new data from users, or other new information</p>
</div>
</main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>