<?php require_once 'app/resources/views/site/components/header.php' ?>

<main>
    <table>
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
                <td><form action="" method="post"><button type="submit">UPDATE</button></form></td>
                <td><form action="" method="post"><button type="submit">DELETE</button></form></td>
            </tr>
        <?php } ?>
    </table>
    <form action="/stationery/categories" method="post">
        <input type="text" name="categoryName" placeholder="Category name">
        <input type="text" name="categoryDescription" placeholder="Category description">
        <button type="submit">Create</button>
    </form>
</main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>