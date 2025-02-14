<?php require_once 'app/resources/views/site/components/header.php';
?>

    <main>
        <?php if (isset($_SESSION['user'])): ?>

            <form action="passwordChange" method="post">
                <label for="old">Enter your old password</label>
                <input type="text" name="oldPassword" id="old">
                <label for="repeat">Repeat your old password</label>
                <input type="text" name="repeatPassword" id="repeat">
                <label for="new">Enter your new password</label>
                <input type="text" name="newPassword" id="new">
                <input type="submit" name="changePassword">
            </form>

        <?php endif; ?>

    </main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>