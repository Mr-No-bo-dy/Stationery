<?php require_once 'app/resources/views/site/components/header.php';
//echo '<pre>';
//var_dump($_SESSION);
?>

    <main>
        <?php if (isset($_SESSION['user'])): ?>
            <img src="<?= 'app/resources/img/users/'.$_SESSION['user']->fillable['photo'] ?>" alt="profile photo">
            <p><b>name:</b> <?= $_SESSION['user']->fillable['name']?></p>
    <p><b>surname:</b> <?= $_SESSION['user']->fillable['surname']  ?></p>
    <p><b>email:</b> <?= $_SESSION['user']->fillable['email']  ?></p>
    <p><b>phone:</b> <?= $_SESSION['user']->fillable['phone']  ?></p>

            <form action="edit" method="post">
                <input type="submit" name="edit" value="edit your data">
            </form>

        <?= $message ?? '' ?>
        <?php endif; ?>



    </main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>