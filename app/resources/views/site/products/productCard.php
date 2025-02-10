<?php require_once 'app/resources/views/site/components/header.php';

use app\vendor\Database;
use app\models\Product;
use app\controllers\site\ProductsController;

?>
<main>
    <div class="productCard">
        <p>There was supposed to be a photo, but there will be text. <?= $product->fillable['image']; ?></p>
        <h2><?= $product->fillable['title']; ?></h2>
        <p><?= $product->fillable['description']; ?></p>
        <p><?= $product->fillable['price']; ?> $</p>
        <p>Stock: <?= $product->fillable['stock']; ?></p>

    </div>
</main>


<?php require_once 'app/resources/views/site/components/footer.php' ?>