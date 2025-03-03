<?php
require_once 'app/resources/views/site/components/header.php';

?>

    <main>
        <div class="wrapper">
            <div class="profile">
            <?php if (isset($_SESSION['user'])): ?>
            <h1>Profile</h1>
                <p class="photo-profile">
                    <img src="<?= 'app/resources/img/users/' . $_SESSION['user']['photo'] ?>" alt="profile photo">
                </p>
                <p class="photo">
                <form class="photo" action="setPhoto" method="post" enctype="multipart/form-data">
                    <label for="chooseFile" class="usersButton">Choose File</label>
                    <input type="file" name="photo" id="chooseFile">
                    <label for="saveButton" class="usersButton">Save choosen photo</label>
                    <button type="submit" name="save" id="saveButton">save choosen photo</button>

                </form>
                <?php if ($_SESSION['user']['photo'] !== 'default.png'): ?>
                    <form action="deletePhoto" method="post">
                        <label class="usersButton" for="deleteButton">delete photo</label>
                        <button type="submit" name="delete" id="deleteButton">delete photo</button>
                    </form>
                <?php endif; ?>

            <div class="profile-info">
                <p><b>Name:</b> <?= $_SESSION['user']['name'] ?></p>
                <p><b>Surname:</b> <?= $_SESSION['user']['surname'] ?></p>
                <p><b>Email:</b> <?= $_SESSION['user']['email'] ?></p>
                <p><b>Phone:</b> <?= $_SESSION['user']['phone'] ?></p>
            </div>
                <p>
                    <a class="usersButton" href="edit">edit profile</a>
                </p>
                <p class="warning"><?= $message ?? '' ?></p>

            <?php endif; ?>

            </div>
        </div>
    </main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>