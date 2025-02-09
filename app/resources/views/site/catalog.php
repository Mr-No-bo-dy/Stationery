<?php require_once 'app/resources/views/site/components/header.php';

use app\vendor\Database;
use App\models\Product;

$db = Database::connection();

$query = $db->query('SELECT * FROM products');
$results = $query->fetchAll();

?>
<main>
    <div class="catalog">
        <div class="productBlock">
            <?php
            foreach ($results as $i => $result) {
                $product = new Product(
                    $result['id'],
                    [
                        'subcategory_id' => $result['subcategory_id'],
                        'title' => $result['title'],
                        'description' =>$result['description'],
                        'price' => $result['price'],
                        'stock' => $result['stock'],
                        'image' => $result['image'],
                    ]
                );

                if ($i > 0 && $i % 3 == 0) {
                    echo '</div><div class="productBlock">';
                }
            ?>
                <div class="productCard">
                    <a href="productCard?product=<?= str_replace(' ', '', $product->fillable['title']) ?>">
                        <p>There was supposed to be a photo, but there will be text. <br> <?= $product->fillable['image'] ?></p>
                        <h2><?= $product->fillable['title']; ?></h2>
                        <p><?= $product->fillable['description']; ?></p>
                        <p><?= $product->fillable['price']; ?> $</p>
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>