<?php require_once 'app/resources/views/site/components/header.php';
?>

    <main>
        <div class="wrapper">
        <?php if (isset($_SESSION['user'])): ?>

            <form action="passwordChange" method="post">
                <label for="old">Enter your old password</label>
                <input type="password" name="oldPassword" id="old">
                <label for="repeat">Repeat your old password</label>
                <input type="password" name="repeatPassword" id="repeat">
                <label for="new">Enter your new password</label>
                <input type="password" name="newPassword" id="new">
                <input type="submit" name="changePassword">
            </form>

        <?php endif; ?>
        </div>
    </main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>