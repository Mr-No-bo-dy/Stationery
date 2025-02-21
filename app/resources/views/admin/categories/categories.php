<?php require_once 'app/resources/views/admin/components/header.php' ?>

<main>
    <table class="categoriesTable">
        <tr>
            <td colspan="6" class="text-left"><a href="createCategory">Create new category</a></td>
        </tr>
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
                <td>
                    <a href="updateCategory?id=<?= $category['id'] ?>">UPDATE</a>
                </td>
                <td>
oca                    <a href="deleteCategory?id=<?= $category['id'] ?>">DELETE</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>