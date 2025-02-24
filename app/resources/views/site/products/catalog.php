<?php require_once 'app/resources/views/site/components/header.php';



?>
<main>
    <div class="catalog">
        <div class="productCatalogBlock">
            <?php foreach ($products as $product) { ?>
                <a class="card" href="card?id=<?= $product['id'] ?>">
                    <img src="app/resources/img/products/<?= (file_exists("app/resources/img/products/" . $product['image']) ? $product['image'] : "product.jpg") ?> " alt="<?= $product['title'] ?>">
                     <!-- Checking for a file. If the file does not exist, we use the prepared photo, if we use the file that we actually checked. -->
                    <h2><?= $product['title']; ?></h2>
                    <p><?= $product['price']; ?> $</p>
                </a>
            <?php } ?>
        </div>
    </div>
</main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>