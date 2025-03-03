<?php $title = "List Of Stationery Subcategories"; ?>
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
        <ul class="categoriesButton">
            <?php foreach ($links as $link) { ?>
                <li><a href="?page=<?= $link['page'] ?>"><?= $link['label'] ?></a></li>
            <?php } ?>
        </ul>
    </main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>