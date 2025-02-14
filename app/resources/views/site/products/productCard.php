<?php require_once 'app/resources/views/site/components/header.php';

use app\vendor\Database;
use app\models\Product;
use app\controllers\site\ProductsController;

?>
<main>
    <div class="productCard">
        <p>There was supposed to be a photo, but there will be text. <?= $product['image']; ?></p>
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