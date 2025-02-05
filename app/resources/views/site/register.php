<?php require_once 'app/resources/views/site/components/header.php';
//var_dump($_POST);
?>

    <main>
        <h1>Register</h1>
        <form action="<?= REGISTER ?>" method="post">
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
            <label for="surname">Surname</label>
            <input type="text" name="surname" id="surname">
            <label for="email">Email</label>
            <input type="text" name="email" id="email">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone">
            <label for="role">Role</label>
                <select name="role" id="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <label for="password">Password</label>
            <input type="text" name="password" id="password">
            <button type="submit">Register</button>
        </form>
    </main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>