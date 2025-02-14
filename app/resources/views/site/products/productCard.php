<?php require_once 'app/resources/views/site/components/header.php';

?>
<main>
    <div class="productCard">
        <img src="app/resources/img/products/<?= $product['image']; ?>" alt="табурєтка">
        <h2><?= $product['title']; ?></h2>
        <p><?= $product['description']; ?></p>
        <p><?= $product['price']; ?> $</p>
        <p>Stock: <?= $product['stock']; ?></p>
        <form action="addToCart" method="POST">
            <input type="hidden" name="id" value="<?= $product['id'] ?>">
            <button type="submit">Add to cart</button>
        </form>
    </div>
</main>


<?php require_once 'app/resources/views/site/components/footer.php' ?>