<?php
require_once 'app/resources/views/admin/components/header.php';

?>

    <main class="users">
        <div class="wrapper">
            <?php if ($_SESSION['user']['role'] == 'SuperAdmin'): ?>

                <a class="<?= !isset($_GET['role']) ? 'active' : '' ?>" href="users">All</a>
                <a class="<?= (isset($_GET['role']) && $_GET['role'] == 'user') ? 'active' : '' ?>"
                   href="users?role=user">Users</a>
                <a class="<?= (isset($_GET['role']) && $_GET['role'] == 'admin') ? 'active' : '' ?>"
                   href="users?role=admin">Admins</a>
            <?php endif; ?>

            <form action="edit" method="get">
                <input type="text" name="search" value="<?= $_GET['search'] ?? '' ?>">
                <button type="submit">search</button>
                <a href="users">clear</a>
            </form>

            <h1>Users list</h1>
            <table>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>

                        <tr>
                            <td class="<?php if (isset($_GET['search']) && str_contains(strtolower($user['id']), strtolower($_GET['search']))) {
                                echo 'warning';
                            } ?>"><?= $user['id'] ?></td>
                            <td class="<?php if (isset($_GET['search']) && str_contains(strtolower($user['name']), strtolower($_GET['search']))) {
                                echo 'warning';
                            } ?>"><?= $user['name'] ?></td>
                            <td class="<?php if (isset($_GET['search']) && str_contains(strtolower($user['surname']), strtolower($_GET['search']))) {
                                echo 'warning';
                            } ?>"><?= $user['surname'] ?></td>
                            <td class="<?php if (isset($_GET['search']) && str_contains(strtolower($user['email']), strtolower($_GET['search']))) {
                                echo 'warning';
                            } ?>"><?= $user['email'] ?></td>
                            <td class="<?php if (isset($_GET['search']) && str_contains(strtolower($user['phone']), strtolower($_GET['search']))) {
                                echo 'warning';
                            } ?>"><?= $user['phone'] ?></td>
                            <td class="<?php if (isset($_GET['search']) && str_contains(strtolower($user['role']), strtolower($_GET['search']))) {
                                echo 'warning';
                            } ?>"><?= $user['role'] ?></td>
                            <td>
                                <a class="usersButton" href="edit?id=<?= $user['id'] ?>">edit</a>
                            </td>
                            <td>
                                <form action="delete" method="post">
                                    <button class="usersButton-delete" type="submit" id="delete" name="delete" value="<?= $user['id'] ?>">delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
            <p class="warning"><?= $message ?? '' ?></p>
        </div>
    </main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>