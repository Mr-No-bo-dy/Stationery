<?php require_once 'app/resources/views/site/components/header.php' ?>

<main>
    <table class="categoriesTable">
        <tr>
            <th>title</th>
            <th>description</th>
<!--            <th>update</th>-->
<!--            <th>delete</th>-->
        </tr>
        <?php foreach ($allCategories as $category) {?>
            <tr>
                <td><?= $category['title'] ?></td>
                <td><?= $category['description'] ?></td>
<!--                <td><form action="" method="post"><button type="submit">UPDATE</button></form></td>-->
<!--                <td><form action="" method="post"><button type="submit">DELETE</button></form></td>-->
            </tr>
        <?php } ?>
    </table>
<!--    <form action="categories" method="post">-->
<!--        <input type="text" name="categoryName" placeholder="Category name">-->
<!--        <input type="text" name="categoryDescription" placeholder="Category description">-->
<!--        <button type="submit">Create</button>-->
<!--    </form>-->
</main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>