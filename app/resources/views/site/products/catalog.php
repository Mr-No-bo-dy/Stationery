<?php require_once 'app/resources/views/site/components/header.php';

use app\vendor\Database;
use App\models\Product;


?>
<main>
    <div class="catalog">
        <div class="productBlock">
            <?php
            foreach ($products as $i => $result) {
                $product = new Product(
                    [
                        'id' => $result['id'],
                        'subcategory_id' => $result['subcategory_id'],
                        'title' => $result['title'],
                        'description' => $result['description'],
                        'price' => $result['price'],
                        'stock' => $result['stock'],
                        'image' => $result['image'],
                    ],
                );

                if ($i > 0 && $i % 3 == 0) {
                    echo '</div><div class="productBlock">';
                }
            ?>
                <form action="productCard" class="productCard">
                    <button class="productCardButt">
                        <p>There was supposed to be a photo, but there will be text. <br> <?= $product->fillable['image'] ?></p>
                        <h2><?= $product->fillable['title']; ?></h2>
                        <p><?= $product->fillable['description']; ?></p>
                        <p><?= $product->fillable['price']; ?> $</p>
                    </button>
                    <input type="hidden" name="title" value="<?= $product->fillable['title'] ?>">
                </form>
            <?php
            }
            ?>
        </div>
    </div>
</main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>