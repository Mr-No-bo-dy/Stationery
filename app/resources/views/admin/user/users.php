<?php
require_once 'app/resources/views/admin/components/header.php';

?>

    <main class="users">
        <div class="wrapper">
            <?php if ($_SESSION['user']['role'] == 'SuperAdmin'): ?>

                <a class="<?= !isset($_GET['role']) ? 'active' : '' ?>"
                   href="users<?= isset($_GET['search']) ? '?search=' . urlencode($_GET['search']) : '' ?>">All</a>

                <a class="<?= (isset($_GET['role']) && $_GET['role'] == 'user') ? 'active' : '' ?>"
                   href="users?role=user<?= isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '' ?>">Users</a>

                <a class="<?= (isset($_GET['role']) && $_GET['role'] == 'admin') ? 'active' : '' ?>"
                   href="users?role=admin<?= isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '' ?>">Admins</a>
            <?php endif; ?>

            <form action="users?<?= isset($_GET['role']) ? 'role=' . urlencode($_GET['role']) : '' ?>" method="get">
                <?php if (isset($_GET['role'])): ?>
                    <input type="hidden" name="role" value="<?= $_GET['role'] ?? '' ?>">
                <?php endif; ?>
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
                    <?php foreach ($usersPerPage as $user): ?>

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
                                    <button class="usersButton-delete" type="submit" id="delete" name="delete"
                                            value="<?= $user['id'] ?>">delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
            </table>

            <p class="warning"><?= $message ?? '' ?></p>
            <?php if ($links): ?>
                <div class="UserMenu">
                    <ul>
                        <?php foreach ($links as $link) { ?>
                            <li>
                                <?php if ((isset($_GET['page']) && $_GET['page'] == $link['page']) || (!isset($_GET['page']) && $link['page'] == 1)): ?>
                                    <a class="active"
                                       href="?<?= isset($_GET['role']) ? 'role=' . urlencode($_GET['role']) . '&' : '' ?><?= isset($_GET['search']) ? 'search=' . urlencode($_GET['search']) . '&' : '' ?>page=<?= $link['page'] ?>"><?= $link['label'] ?></a>
                                <?php else: ?>
                                    <a href="?<?= isset($_GET['role']) ? 'role=' . urlencode($_GET['role']) . '&' : '' ?><?= isset($_GET['search']) ? 'search=' . urlencode($_GET['search']) . '&' : '' ?>page=<?= $link['page'] ?>"><?= $link['label'] ?></a>
                                <?php endif; ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>