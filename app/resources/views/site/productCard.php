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
            [
                'subcategory_id' => $result['subcategory_id'],
                'title' => $result['title'],
                'description' =>$result['description'],
                'price' => $result['price'],
                'stock' => $result['stock'],
                'image' => $result['image'],
            ]
        );
        break;
    } 
}

?>
<div class="productCard">
    <p>There was supposed to be a photo, but there will be text. <?= $product->fillable['image']; ?></p>
    <h2><?= $product->fillable['title']; ?></h2>
    <p><?= $product->fillable['description']; ?></p>
    <p><?= $product->fillable['price']; ?> $</p>  
    <p>Stock: <?= $product->fillable['stock']?></p>
</div>

<?php require_once 'app/resources/views/site/components/footer.php' ?>