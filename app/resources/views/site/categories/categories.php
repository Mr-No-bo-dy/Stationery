<?php $title = "List Of Stationery Categories"; ?>
<?php require_once 'app/resources/views/site/components/header.php' ?>
<main>
    <table class="categoriesTable">
        <tr>
            <th>title</th>
            <th>description</th>
            <th>subcategory</th>
        </tr>
        <?php foreach ($allCategories as $category) {?>
            <tr>
                <td><?= $category['title'] ?></td>
                <td><?= $category['description'] ?></td>
                <td class="tableButton subcategory"><a href="subcategory?categoryId=<?= $category['id'] ?>">go to subcategories</a></td>
            </tr>
        <?php } ?>
    </table>
</main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>