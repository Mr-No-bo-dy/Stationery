<?php require_once 'app/resources/views/site/components/header.php' ?>

    <main class="login">
        <div class="wrapper">
        <h1>Login</h1>
        <form action="login" method="post">
            <p>
            <label for="email">email or phone</label>
            <input type="text" name="login" id="email">
            </p>
            <p>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            </p>
            <p>
            <label for="submit" class="button">Log in!</label>
            <input type="submit" id="submit">
            </p>
        </form>
        <?php if (!empty($loginError)): ?>
            <p class="warning"><?= $loginError ?></p>
        <?php endif; ?>
        </div>
    </main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>