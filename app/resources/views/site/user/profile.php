<?php require_once 'app/resources/views/site/components/header.php';

?>

    <main>
        <?php if (isset($_SESSION['user'])): ?>
            <img src="<?= 'app/resources/img/users/'.$_SESSION['user']['photo'] ?>" alt="profile photo">
            <p><b>name:</b> <?= $_SESSION['user']['name']?></p>
    <p><b>surname:</b> <?= $_SESSION['user']['surname']  ?></p>
    <p><b>email:</b> <?= $_SESSION['user']['email']  ?></p>
    <p><b>phone:</b> <?= $_SESSION['user']['phone']  ?></p>

            <form action="edit" method="post">
                <input type="submit" name="edit" value="edit your data">
            </form>

        <?= $message ?? '' ?>
        <?php endif; ?>



    </main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>