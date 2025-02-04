<?php require_once 'app/resources/views/site/components/header.php';

use app\vendor\Database;
use App\models\Product;

$db = Database::connection();

$query = $db->query('SELECT * FROM products');
$results = $query->fetchAll();
$product = 0;


foreach ($results as $result) {
    if (str_replace(' ', '', $result['title'])  == $_GET["product"]) {
        $product = new Product(
            $result['id'],
            $result['title'],
            $result['description'],
            $result['price'],
            $result['stock'],
            $result['image']
        );
        break;
    } 
}

?>
<div class="productCard">
    <p>There was supposed to be a photo, but there will be text. <?= $product->image; ?></p>
    <h2><?= $product->title; ?></h2>
    <p><?= $product->description; ?></p>
    <p><?= $product->price; ?> $</p>  
    <p>Stock: <?= $product->stock?></p>
</div>

<?php require_once 'app/resources/views/site/components/footer.php' ?>