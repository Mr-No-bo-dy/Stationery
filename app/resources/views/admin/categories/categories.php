<?php $title = "Admin List Of Stationery Categories"; ?>
<?php require_once 'app/resources/views/admin/components/header.php' ?>

<main>
    <div class="categoriesButton">
        <a href="createCategory" class="createButton">Create category</a>
        <a href="category?sort=id" class="sortButton <?= (!isset($_GET['sort']) || $_GET['sort'] == 'id') ? 'active' : '' ?>">Sort by id</a>
        <a href="category?sort=title" class="sortButton <?= (isset($_GET['sort']) && $_GET['sort'] == 'title') ? 'active' : '' ?>">Sort by title</a>
    </div>
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
                <td class="tableButton update">
                    <a href="editCategory?id=<?= $category['id'] ?>">UPDATE</a>
                </td>
                <td class="tableButton delete">
                    <a href="deleteCategory?id=<?= $category['id'] ?>">DELETE</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>