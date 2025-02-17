<?php require_once 'app/resources/views/admin/components/header.php' ?>

<main>
    <table>
        <tr>
            <td colspan="4" class="text-left">
                <form action="createSubcategory" method="post">
                    <button type="submit" name="categoryId" value="<?= $_POST['categoryId'] ?>">Create new subcategory</button>
                </form>
            </td>
        </tr>
        <tr>
            <th>title</th>
            <th>description</th>
        </tr>
        <?php foreach ($allSubcategories as $subcategory) { ?>
            <tr>
                <td><?= $subcategory['title'] ?></td>
                <td><?= $subcategory['description'] ?></td>
                <td>
                    <form action="updateSubcategory" method="post">
                        <input type="hidden" name="subcategoryName" value="<?= $subcategory['title'] ?>">
                        <input type="hidden" name="subcategoryDescription" value="<?= $subcategory['description'] ?>">
                        <button type="submit" name="subcategoryId" value="<?= $subcategory['id'] ?>">UPDATE</button>
                    </form>
                </td>
                <td><form action="deleteSubcategory" method="post"><button type="submit" name="subcategoryId" value="<?= $subcategory['id'] ?>" >DELETE</button></form></td>
            </tr>
        <?php } ?>
    </table>
</main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>