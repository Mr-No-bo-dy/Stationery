<?php require_once 'app/resources/views/site/components/header.php' ?>

    <main>
        <h1>Login</h1>
        <form action="login" method="post">
            <label for="email">name</label>
            <input type="text" name="name" id="email">
            <label for="password">Password</label>
            <input type="text" name="password" id="password">
            <button type="submit">Login</button>
    </main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>