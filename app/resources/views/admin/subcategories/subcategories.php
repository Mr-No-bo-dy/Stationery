<?php require_once 'app/resources/views/admin/components/header.php' ?>

<main>
    <a href="createSubcategory" class="createButton">Create subcategory</a>
    <table class="subcategory categoriesTable">
        <tr>
            <th>category title</th>
            <th>title</th>
            <th>description</th>
            <th>update</th>
            <th>delete</th>
        </tr>
        <?php foreach ($allSubcategories as $subcategory) { ?>
            <tr>

                <td><?= $subcategory['category_title'] ?></td>
                <td><?= $subcategory['subcategory_title'] ?></td>
                <td><?= $subcategory['description'] ?></td>
                <td class="tableButton update"><a href="updateSubcategory?id=<?= $subcategory['id'] ?>">UPDATE</a></td>
                <td class="tableButton delete"><a href="deleteSubcategory?id=<?= $subcategory['id'] ?>">DELETE</a></td>
            </tr>
        <?php } ?>
    </table>
</main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>