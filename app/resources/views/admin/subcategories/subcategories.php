<?php $title = "Admin List Of Stationery Subcategories"; ?>
<?php require_once 'app/resources/views/admin/components/header.php' ?>

    <main>
        <div class="categoriesButton">
            <a href="createSubcategory" class="createButton">Create subcategory</a>
            <a href="subcategory?sort=id" class="sortButton <?= (!isset($_GET['sort']) || $_GET['sort'] == 'id') ? 'active' : '' ?>">Sort by id</a>
            <a href="subcategory?sort=category" class="sortButton <?= (isset($_GET['sort']) && $_GET['sort'] == 'category') ? 'active' : '' ?>">Sort by category</a>
            <a href="subcategory?sort=title" class="sortButton <?= (isset($_GET['sort']) && $_GET['sort'] == 'title') ? 'active' : '' ?>">Sort by title</a>
        </div>
<!--        --><?php //$this->dd($allSubcategories); ?>
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
    </main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>