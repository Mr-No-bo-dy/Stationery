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
            </tr>
        <?php } ?>
    </table>
</main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>