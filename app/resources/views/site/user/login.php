<?php require_once 'app/resources/views/site/components/header.php' ?>

    <main>
        <h1>Login</h1>
        <form action="login" method="post">
            <label for="email">email or phone</label>
            <input type="text" name="login" id="email">
            <label for="password">Password</label>
            <input type="text" name="password" id="password">
            <button type="submit">Login</button>
        </form>
        <?php if (!empty($loginError)): ?>
            <p class="warning"><?= $loginError ?></p>
        <?php endif; ?>
    </main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>