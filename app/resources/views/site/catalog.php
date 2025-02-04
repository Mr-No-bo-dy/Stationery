<?php require_once 'app/resources/views/site/components/header.php';

use app\vendor\Database;

$db = Database::connection();

$query = $db->query('SELECT * FROM products');
$results = $query->fetchAll();

?>
<main>
    <div class="catalog">
        <div class="productBlock">
            <?php
            foreach ($results as $i => $result) {
                if ($i > 0 && $i % 3 == 0) {
                    echo '</div><div class="productBlock">';
                }
            ?>
                <div class="productCard">
                    <a href="productCard?product=<?= str_replace(' ', '', $result['title']) ?>">
                        <h2><?= $result['title']; ?></h2>
                        <p><?= $result['description']; ?></p>
                        <p><?= $result['price']; ?> $</p>
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>