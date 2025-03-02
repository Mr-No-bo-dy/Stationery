<?php require_once 'app/resources/views/admin/components/header.php' ?>

    <main>
        <form action="category" method="get" class="filters">
            <div class="categoriesButton">
                <a href="createCategory" class="createButton">Create category</a>
                <input type="radio" name="sort" value="id" class="sortRadio" <?= (!isset($_GET['sort']) || $_GET['sort'] == 'id') ? 'checked' : '' ?>>
                <input type="radio" name="sort" value="title" class="sortRadio" <?= (isset($_GET['sort']) && $_GET['sort'] == 'title') ? 'checked' : '' ?>>

                <button type="submit" class="sortButton <?= (!isset($_GET['sort']) || $_GET['sort'] == 'id') ? 'active' : '' ?>" data-value="id">Sort by id</button>
                <button type="submit" class="sortButton <?= (isset($_GET['sort']) && $_GET['sort'] == 'title') ? 'active' : '' ?>" data-value="title">Sort by title</button>
            </div>
            <input type="text" name="filter" placeholder="Title or description" value="<?= $_GET['filter'] ?? '' ?>">
            <button type="submit" class="search">search</button>
        </form>
        <table class="categoriesTable">
            <tr>
                <th>id</th>
                <th>title</th>
                <th>description</th>
                <th>update</th>
                <th>delete</th>
            </tr>
            <?php foreach ($allCategories as $category) { ?>
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