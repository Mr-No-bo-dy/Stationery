<?php require_once 'app/resources/views/site/components/header.php';



?>
<main>
    <div class="catalog">
        <div class="productBlock">
            <?php foreach ($products as $i => $product) { ?>
                <a class="card" href="card?id=<?= $product['id'] ?>">
                <img src="app/resources/img/products/<?= $product['image']; ?>" alt="табурєтка">
                    <h2><?= $product['title']; ?></h2>
                    <p><?= $product['price']; ?> $</p>
                </a>
            <?php } ?>
        </div>
    </div>
</main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>