<?php require_once 'app/resources/views/site/components/header.php';
//echo '<pre>';
//var_dump($_SESSION);
?>

    <main>
        <?php if (isset($_SESSION['user'])): ?>

            <form action="edit" method="post">
                <label for="name">Name</label>
                <input type="text" name="name" value="<?= $_SESSION['user']->fillable['name'] ?>" id="name">
                <label for="surname">Surname</label>
                <input type="text" name="surname" value="<?= $_SESSION['user']->fillable['surname'] ?>" id="surname">
                <label for="email">Email</label>
                <input type="text" name="email" value="<?= $_SESSION['user']->fillable['email'] ?>" id="email">
                <label for="phone">Phone</label>
                <input type="text" name="phone" value="<?= $_SESSION['user']->fillable['phone'] ?>" id="phone">
                <label for="password">Password</label>
                <input type="text" name="password" id="password">
                <input type="file" name="photoUpload">
                <input type="submit" name="saveEdit" value="edit your data">
            </form>

        <?php endif; ?>



    </main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>