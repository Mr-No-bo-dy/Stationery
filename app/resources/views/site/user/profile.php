<?php require_once 'app/resources/views/site/components/header.php';

?>

    <main class="profile">
        <div class="wrapper">
            <?php if (isset($_SESSION['user'])): ?>
                <p class="photo-profile">
                    <img src="<?= 'app/resources/img/users/' . $_SESSION['user']['photo'] ?>" alt="profile photo">
                </p>
            <?php if ($_SESSION['user']['photo'] !== 'default.png'): ?>
                <p>
                    <a class="deleteButton" href="deletePhoto">delete photo</a>
                </p>

            <?php endif; ?>
                <p class="photo">
                <form class="photo" action="setPhoto" method="post" enctype="multipart/form-data">
                    <input type="file" name="photo">
                    <button type="submit" name="save">save choosen photo</button>
                </form>
                </p>
                <p><b>name:</b> <?= $_SESSION['user']['name'] ?></p>
                <p><b>surname:</b> <?= $_SESSION['user']['surname'] ?></p>
                <p><b>email:</b> <?= $_SESSION['user']['email'] ?></p>
                <p><b>phone:</b> <?= $_SESSION['user']['phone'] ?></p>
                <p>
                <form action="edit" method="post">
                    <input type="submit" name="edit" value="edit your data">
                </form>
                </p>
                <p class="warning"><?= $message ?? '' ?></p>

            <?php endif; ?>


        </div>
    </main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>