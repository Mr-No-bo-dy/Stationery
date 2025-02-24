<?php require_once 'app/resources/views/admin/components/header.php';



?>
<main>
    <div class="catalog">
        <a href="productCreating" class="productCreate">Create product</a>
        <div class="productBlock">
            <?php foreach ($products as $product) { ?>
                <a class="card" href="productEdit?id=<?= $product['id'] ?>" id="<?= $product['id']?>">
                    <img src="../app/resources/img/products/<?= (file_exists("app/resources/img/products/" . $product['image']) ? $product['image'] : "product.jpg") ?> "alt="<?= $product['title'] ?>">
                    <!-- Checking for a file. If the file does not exist, we use the prepared photo, if we use the file that we actually checked. -->
                    <h2><?= $product['title']; ?></h2>
                    <p><?= $product['price']; ?> $</p>
                </a>    
            <?php } ?>
        </div>
    </div>
</main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>