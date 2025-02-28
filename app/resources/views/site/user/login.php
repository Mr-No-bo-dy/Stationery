<?php
$title = 'Login';
require_once 'app/resources/views/site/components/header.php' ?>

    <main class="login">
        <div class="wrapper">
        <form action="signIn" method="post">
        <h1>Login</h1>
            <p>
            <label for="email">email or phone</label>
            <input type="text" name="login" id="email">
            </p>
            <p>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            </p>
            <p>
            <label for="submit" class="button">Sign in!</label>
            <input type="submit" id="submit">
            </p>
            <p class="warning"><?= $message ?? '' ?></p>
        </form>
        </div>
    </main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>