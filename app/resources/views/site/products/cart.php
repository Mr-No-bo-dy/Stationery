<?php require_once 'app/resources/views/site/components/header.php';

use app\vendor\Database;
use App\models\Product;
use App\models\Orders;


?>
<main>

    <?php if (empty(isset($_SESSION["cart"]) ? $_SESSION["cart"] : [])) { ?>
    <p>Кошик порожній</p>
    <?php } else { ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Назва</th>
                <th>Ціна</th>
                <th>Кількість</th>
                <th>Зображення</th>
            </tr>

            <?php foreach (isset($_SESSION["cart"]) ? $_SESSION["cart"] : [] as $product) { ?>
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td><?= $product['title'] ?></td>
                    <td><?= $product['price'] ?> грн</td>
                    <td><?= $product['quantity'] ?></td>
                    <td><img src="<?= ($product['image']) ?>" alt=""></td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>
    
</main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>