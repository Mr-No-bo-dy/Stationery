<?php require_once 'app/resources/views/site/components/header.php';

use app\vendor\Database;

$db = Database::connection();

$query = $db->query('SELECT * FROM products');
$results = $query->fetchAll();
$product = 0;


foreach ($results as $result) {
    // echo "<pre>";
    // var_dump($result);
    if (str_replace(' ', '', $result['title'])  == $_GET["product"]) {
        $product = $result;
        break;
    } else {
        $product = "PIZDETS.";
    }
}

?>
<div class="productCard">
    <h2><?= $product["title"]; ?></h2>
    <p><?= $product['description']; ?></p>
    <p><?= $product['price']; ?> $</p>
</div>
<?php
?>