<?php require_once 'app/resources/views/admin/components/header.php';


?>

<main class="users edit">
    <div class="wrapper">
    <form action="edit" method="post">
        <table>
            <tr>
                <td>Name:</td>
                <td> <input type="text" name="user[name]" value="<?=$user['name']?>"></td>
            </tr>
            <tr>
                <td>Surname:</td>
                <td><input type="text" name="user[surname]" value="<?=$user['surname']?>"></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="text" name="user[email]" value="<?=$user['email']?>"></td>
            </tr>
            <tr>
                <td>Phone:</td>
                <td> <input type="text" name="user[phone]" value="<?=$user['phone']?>"></td>
            </tr>
            <tr>
                <td>Role:</td>
                <td> <select name="user[role]">
                        <option selected value="<?= $user['role'] ?>"><?= $user['role'] ?></option>
                        <option value="<?= $user['role'] == 'admin' ? 'user' : 'admin' ?>"><?= $user['role'] == 'admin' ? 'user' : 'admin' ?></option>
                    </select></td>
            </tr>
            <tr>
                <td colspan="2"> <input type="submit" name="saveUserChanges" value="edit"></td>
            </tr>
        </table>
        <input type="hidden" name="user[id]" value="<?=$user['id']?>">


    </form>
    </div>
</main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>
