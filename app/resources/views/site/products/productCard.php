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
        <a class="reviews" href="reviews?id=<?= $product['id'] ?>">
            <p>reviews</p>
        </a>
    </div>
</main>


<?php require_once 'app/resources/views/site/components/footer.php' ?>