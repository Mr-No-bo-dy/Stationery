<?php require_once 'app/resources/views/admin/components/header.php' ?>

<main>
    <table class="categoriesTable">
        <tr>
            <th>id</th>
            <th>title</th>
            <th>description</th>
            <th>update</th>
            <th>delete</th>
        </tr>
        <?php foreach ($allCategories as $category) {?>
            <tr>
                <?php foreach ($category as $column) { ?>
                    <td><?= $column ?></td>
                <?php } ?>
                <td><form action="updateCategories" method="post"><button type="submit">UPDATE</button></form></td>
                <td><form action="adminDeleteCategories" method="post"><button type="submit" name="categoryId" value="<?= $category['id'] ?>" >DELETE</button></form></td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="5" class="text-left"><a href="createCategory">Create new category</a></td>
        </tr>
    </table>
</main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>