<?php $title = "Admin List Of Stationery Subcategories"; ?>
<?php require_once 'app/resources/views/admin/components/header.php' ?>

    <main>
        <form action="subcategory" method="get" class="filters">
            <div class="categoriesButton">
                <a href="createSubcategory" class="createButton">Create subcategory</a>
                <input type="radio" name="sort" value="id" class="sortRadio" <?= (!isset($_GET['sort']) || $_GET['sort'] == 'id') ? 'checked' : '' ?>>
                <input type="radio" name="sort" value="category" class="sortRadio" <?= (isset($_GET['sort']) && $_GET['sort'] == 'category') ? 'checked' : '' ?>>
                <input type="radio" name="sort" value="title" class="sortRadio" <?= (isset($_GET['sort']) && $_GET['sort'] == 'title') ? 'checked' : '' ?>>

                <button type="submit" class="sortButton <?= (!isset($_GET['sort']) || $_GET['sort'] == 'id') ? 'active' : '' ?>" data-value="id">Sort by id</button>
                <button type="submit" class="sortButton <?= (isset($_GET['sort']) && $_GET['sort'] == 'category') ? 'active' : '' ?>" data-value="category">Sort by category</button>
                <button type="submit" class="sortButton <?= (isset($_GET['sort']) && $_GET['sort'] == 'title') ? 'active' : '' ?>" data-value="title">Sort by title</button>
            </div>
            <input type="text" name="filter" placeholder="Title or description" value="<?= $_GET['filter'] ?? '' ?>">
            <button type="submit" class="search">search</button>
        </form>
        <table class="subcategory categoriesTable">
            <tr>
                <th>id</th>
                <th>category title</th>
                <th>title</th>
                <th>description</th>
                <th>update</th>
                <th>delete</th>
            </tr>
            <?php foreach ($allSubcategories as $subcategory) { ?>
                <tr>

                    <td><?= $subcategory['id'] ?></td>
                    <td><?= $subcategory['category_title'] ?></td>
                    <td><?= $subcategory['subcategory_title'] ?></td>
                    <td><?= $subcategory['description'] ?></td>
                    <td class="tableButton update"><a href="editSubcategory?id=<?= $subcategory['id'] ?>">UPDATE</a>
                    </td>
                    <td class="tableButton delete"><a href="deleteSubcategory?id=<?= $subcategory['id'] ?>">DELETE</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <ul class="categoriesButton">
            <?php foreach ($links as $link) { ?>
                <li><a href="?<?= (isset($_GET['filter'])) ? "filter=". urlencode($_GET['filter']) ."&" : "" ?><?= (isset($_GET['sort']))? "sort=" . urlencode($_GET['sort']) . "&" : "" ?>page=<?= urlencode($link['page']) ?>"><?= $link['label'] ?></a></li>
            <?php } ?>
        </ul>
    </main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>