<?php require_once 'app/resources/views/admin/components/header.php';


?>

<main>

    <h1>Hi, <?= $_SESSION['user']->fillable['name'] ?? 'guest'  ?> ADMIN</h1>

    <form action="edit" method="post">
        <input type="hidden" name="user[id]" value="<?=$user['id']?>">
        <input type="text" name="user[name]" value="<?=$user['name']?>">
    <input type="text" name="user[surname]" value="<?=$user['surname']?>">
    <input type="text" name="user[email]" value="<?=$user['email']?>">
    <input type="text" name="user[phone]" value="<?=$user['phone']?>">
        <select name="user[role]">
            <option selected value="<?= $user['role'] ?>"><?= $user['role'] ?></option>
            <option value="<?= $user['role'] == 'admin' ? 'user' : 'admin' ?>"><?= $user['role'] == 'admin' ? 'user' : 'admin' ?></option>
        </select>
        <input type="submit" name="saveUserChanges" value="edit">
    </form>

</main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>
