<?php
require_once 'app/resources/views/site/components/header.php';

?>

    <main class="register">
        <div class="wrapper">
            <form action="signUp" method="post">
                <h1>Register</h1>
                <p>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="<?= $_POST['name'] ?? '' ?>">
                </p>
                <p>
                    <label for="surname">Surname</label>
                    <input type="text" name="surname" id="surname" value="<?= $_POST['surname'] ?? '' ?>">
                </p>
                <p>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?= $_POST['email'] ?? '' ?>"
                           placeholder="user@example.com">
                </p>
                <p>
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" value="<?= $_POST['phone'] ?? '' ?>"
                           placeholder="+380123456789">
                </p>
                <p>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                </p>
                <p>
                    <label for="repPassword">Repeat your Password</label>
                    <input type="password" name="repeatPassword" id="repPassword">
                </p>
                <p>
                    <label class="button" for="register">Register!</label>
                    <input type="submit" id="register">
                </p>
                <p class="warning"><?= $message ?? '' ?></p>
            </form>
        </div>
    </main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>