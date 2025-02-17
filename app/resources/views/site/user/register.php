<?php require_once 'app/resources/views/site/components/header.php';
//var_dump($_POST);
?>

    <main class="register">
        <div class="wrapper">
            <h1>Register</h1>
            <form action="register" method="post">
                <p>
                    <label for="name">Name</label>
                    <input type="text" name="user[name]" id="name">
                </p>
                <p>
                    <label for="surname">Surname</label>
                    <input type="text" name="user[surname]" id="surname">
                </p>
                <p>
                    <label for="email">Email</label>
                    <input type="text" name="user[email]" id="email" placeholder="user@example.com">
                </p>
                <p>
                    <label for="phone">Phone</label>
                    <input type="text" name="user[phone]" id="phone" placeholder="+380123456789">
                </p>
                <p>
                    <label for="password">Password</label>
                    <input type="password" name="user[password]" id="password">
                </p>
                <p>
                    <label for="repPassword">Repeat your Password</label>
                    <input type="password" name="user[repeatPassword]" id="repPassword">
                </p>
                <p>
                    <label class="button" for="register">Register!</label>
                    <input type="submit" id="register">
                </p>
            </form>
            <?php if (!empty($registerError)): ?>
                <p class="warning"><?= $registerError ?></p>
            <?php endif; ?>
        </div>
    </main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>