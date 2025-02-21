<?php require_once 'app/resources/views/site/components/header.php' ?>

<main>
    <table class="categoriesTable">
        <tr>
            <th>title</th>
            <th>description</th>
        </tr>
        <?php foreach ($allCategories as $category) {?>
            <tr>
                <td><?= $category['title'] ?></td>
                <td><?= $category['description'] ?></td>
<!--                <td><form action="subcategory" method="post"><button type="submit" name="categoryId" value="--><?php //= $category['id'] ?><!--" >go to subcategories</button></form></td>-->
                <td><a href="subcategory?categoryId=<?= $category['id'] ?>">go to subcategories</a></td>
            </tr>
        <?php } ?>
    </table>
</main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>