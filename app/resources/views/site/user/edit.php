<?php require_once 'app/resources/views/site/components/header.php';
?>

    <main>
        <?php if (isset($_SESSION['user'])): ?>

            <form action="edit" method="post">
                <label for="name">Name</label>
                <input type="text" name="user[name]" value="<?= $_SESSION['user']['name'] ?>" id="name">
                <label for="surname">Surname</label>
                <input type="text" name="user[surname]" value="<?= $_SESSION['user']['surname'] ?>" id="surname">
                <label for="email">Email</label>
                <input type="text" name="user[email]" value="<?= $_SESSION['user']['email'] ?>" id="email">
                <label for="phone">Phone</label>
                <input type="text" name="user[phone]" value="<?= $_SESSION['user']['phone'] ?>" id="phone">
                <input type="hidden" name="user[role]" value="<?=$_SESSION['user']['role']?>">
                <input type="hidden" name="user[id]" value="<?=$_SESSION['user']['id']?>">
                <input type="submit" name="saveEdit" value="edit your data">
            </form>
            <a href="passwordChange">Change your password?</a>

        <?php endif; ?>



    </main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>