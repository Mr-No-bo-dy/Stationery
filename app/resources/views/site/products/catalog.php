<?php require_once 'app/resources/views/site/components/header.php';



?>
<main>
    <div class="catalog">
        <h2>Filters:</h2>
        <form action="" method="get">
            <input type="text" name="title" value="<?= $_GET["title"] ?? "" ?>" placeholder="Name">
            <input type="number" name="minPrice" value="<?= $_GET["minPrice"] ?? "" ?>" placeholder="Min price">
            <input type="number" name="maxPrice" value="<?= $_GET["maxPrice"] ?? "" ?>" placeholder="Max price">
            <select name="subcategory_id">
                <option>All</option>
                <?php foreach ($subCategories as $subCatId => $subCat) { ?>
                    <option value="<?= $subCatId ?>" <?= isset($_GET["subcategory_id"]) && $_GET["subcategory_id"] == $subCatId ? "selected" : "" ?>><?= $subCat ?></option>
                <?php } ?>
            </select>
            <input type="submit" value="Filter">
        </form>
        <a href="catalog">Clear filters</a>
        <div class="productCatalogBlock">
            <?php foreach ($products as $product) { ?>
                <a class="card" href="card?id=<?= $product['id'] ?>">
                    <img src="app/resources/img/products/<?= file_exists("app/resources/img/products/" . $product['image']) ? $product['image'] : "product.jpg" ?> " alt="<?= $product['title'] ?>">
                    <!-- Checking for a file. If the file does not exist, we use the prepared photo, if we use the file that we actually checked. -->
                    <h2><?= $product['title']; ?></h2>
                    <p><?= $product['price']; ?> $</p>
                </a>
            <?php } ?>
        </div>
    </div>
    <ul class="categoriesButton">
        <?php foreach ($links as $link) { ?>
            <li><a href="?page=<?= $link['page'] ?>"><?= $link['label'] ?></a></li>
        <?php } ?>
    </ul>
</main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>