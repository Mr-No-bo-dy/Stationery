<?php
require_once 'app/resources/views/site/components/header.php';
?>

    <main>
        <div class="wrapper">
            <div class="profile-edit">
                <?php if (isset($_SESSION['user'])): ?>

                    <form action="update" method="post">
                        <p>
                            <label for="name">Name</label>
                            <input type="text" name="user[name]" value="<?= $_SESSION['user']['name'] ?>" id="name">
                        </p>
                        <p>
                            <label for="surname">Surname</label>
                            <input type="text" name="user[surname]" value="<?= $_SESSION['user']['surname'] ?>"
                                   id="surname"></p>
                        <p>
                            <label for="email">Email</label>
                            <input type="text" name="user[email]" value="<?= $_SESSION['user']['email'] ?>" id="email">
                        </p>
                        <p>
                            <label for="phone">Phone</label>
                            <input type="text" name="user[phone]" value="<?= $_SESSION['user']['phone'] ?>" id="phone">
                        </p>
                        <p>
                            <input type="hidden" name="user[role]" value="<?= $_SESSION['user']['role'] ?>">
                            <input type="hidden" name="user[id]" value="<?= $_SESSION['user']['id'] ?>">
                        <p>
                            <label for="editButton" class="usersButton">Edit your data</label>
                            <button type="submit" name="update" value="edit your data" id="editButton"></button>
                        </p>
                    </form>
                    <a class="warning" href="passwordChange">Change your password?</a>
                    <p class="warning"><?= $message ?? '' ?></p>

                <?php endif; ?>
            </div>
        </div>

    </main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>