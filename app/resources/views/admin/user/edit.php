<?php require_once 'app/resources/views/admin/components/header.php';


?>

<main>

    <h1>Hi, <?= $_SESSION['user']->fillable['name'] ?? 'guest'  ?> ADMIN</h1>

    <form action="edit" method="post">
        <input type="hidden" name="id" value="<?=$user['id']?>">
        <input type="text" name="name" value="<?=$user['name']?>">
    <input type="text" name="surname" value="<?=$user['surname']?>">
    <input type="text" name="email" value="<?=$user['email']?>">
    <input type="text" name="phone" value="<?=$user['phone']?>">
        <select name="role">
            <option selected value="<?= $user['role'] ?>"><?= $user['role'] ?></option>
            <option value="<?= $user['role'] == 'admin' ? 'user' : 'admin' ?>"><?= $user['role'] == 'admin' ? 'user' : 'admin' ?></option>
        </select>
        <input type="submit" name="saveEdit" value="edit">
    </form>

</main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>
