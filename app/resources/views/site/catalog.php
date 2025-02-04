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
                    $result['subcategory_id'],
                    $result['title'],
                    $result['description'],
                    $result['price'],
                    $result['stock'],
                    $result['image'],
                );

                if ($i > 0 && $i % 3 == 0) {
                    echo '</div><div class="productBlock">';
                }
            ?>
                <div class="productCard">
                    <a href="productCard?product=<?= str_replace(' ', '', $product->title) ?>">
                        <p>There was supposed to be a photo, but there will be text. <br> <?=  $product->image ?></p>
                        <h2><?= $product->title; ?></h2>
                        <p><?= $product->description; ?></p>
                        <p><?= $product->price; ?> $</p>
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>