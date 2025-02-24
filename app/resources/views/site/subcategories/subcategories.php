<?php require_once 'app/resources/views/site/components/header.php' ?>

    <main>
        <table class="categoriesTable">
            <tr>
                <th>title</th>
                <th>description</th>
            </tr>
            <?php foreach ($subcategories as $subcategory) { ?>
                <tr>
                    <td><?= $subcategory['title'] ?></td>
                    <td><?= $subcategory['description'] ?></td>
                </tr>
            <?php } ?>
        </table>
    </main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>