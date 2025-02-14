<?php require_once 'app/resources/views/site/components/header.php';

?>
<main>
    <div class="productCard">
        <img src="app/resources/img/products/<?= $product['image']; ?>" alt="табурєтка">
        <h2><?= $product['title']; ?></h2>
        <p><?= $product['description']; ?></p>
        <p><?= $product['price']; ?> $</p>
        <p>Stock: <?= $product['stock']; ?></p>

    </div>
</main>


<?php require_once 'app/resources/views/site/components/footer.php' ?>