<?php require_once 'app/resources/views/admin/components/header.php';

?>

    <main class="users">
        <div class="wrapper">

        <h1>Hi, <?= $_SESSION['user']->fillable['name'] ?? 'guest' ?> ADMIN</h1>
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
            <?php foreach ($users as $user): ?>

                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['surname'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['phone'] ?></td>
                    <td><?= $user['role'] ?></td>

                    <td>
                        <form action="edit" method="post">
                            <label for="edit">edit</label>
                            <input class="dn" type="submit" name="userId" id="edit" value="<?= $user['id'] ?>">
                        </form>
                    </td>
                    <td>
                        <form action="delete" method="post">
                            <input type="hidden" name="userId" value="<?= $user['id'] ?>">
                            <label for="delete">delete</label>
                            <input class="dn" type="submit" name="delete" id="delete" value="delete">
                        </form>
                    </td>

                </tr>
            <?php endforeach; ?>
        </table>
        </div>
    </main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>