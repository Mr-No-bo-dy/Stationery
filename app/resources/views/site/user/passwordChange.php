<?php
require_once 'app/resources/views/site/components/header.php';
?>

    <main class="wrapper">
        <div class="profile-passwordChange">
            <?php if (isset($_SESSION['user'])): ?>

                <form action="passwordUpdate" method="post">
                    <label for="old">Enter your old password</label>
                    <input type="password" name="oldPassword" id="old">
                    <label for="repeat">Repeat your old password</label>
                    <input type="password" name="repeatPassword" id="repeat">
                    <label for="new">Enter your new password</label>
                    <input type="password" name="newPassword" id="new">
                    <label for="editButton" class="usersButton">Change password</label>
                    <button type="submit" name="changePassword" id="editButton"></button>
                </form>

                <p class="warning"><?= $message ?? '' ?></p>
            <?php endif; ?>
        </div>
    </main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>