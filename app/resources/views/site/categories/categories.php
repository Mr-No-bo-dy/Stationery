<?php $title = "List Of Stationery Categories"; ?>
<?php require_once 'app/resources/views/site/components/header.php' ?>
<main>
    <form action="category" method="get" class="filters">
        <input type="text" name="filter" placeholder="Title or description" value="<?= $_GET['filter'] ?? '' ?>">
        <button type="submit" class="search">search</button>
    </form>
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
    <ul class="categoriesButton">
        <?php foreach ($links as $link) { ?>
            <li><a href="?page=<?= $link['page'] ?>"><?= $link['label'] ?></a></li>
        <?php } ?>
    </ul>
</main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>