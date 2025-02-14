<?php require_once 'app/resources/views/admin/components/header.php';

?>

    <main>

        <h1>Hi, <?= $_SESSION['user']->fillable['name'] ?? 'guest' ?> ADMIN</h1>
        <table>
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
                            <input type="submit" name="userId" value="<?= $user['id'] ?>">edit
                        </form>
                    </td>
                    <td>
                        <form action="delete" method="post">
                            <input type="hidden" name="userId" value="<?= $user['id'] ?>">
                            <input type="submit" name="delete" value="delete">
                        </form>
                    </td>

                </tr>
            <?php endforeach; ?>
        </table>

    </main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>