<?php require_once 'app/resources/views/site/components/header.php';?>
<main>
    <h1>Оформлення замовлення</h1>
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
                <?php foreach ($cartItems as $product) { ?>
                    <tr>
                        <td><?= $product["id"] ?></td>
                        <td><?= $product["title"] ?></td>
                        <td><?= $product["price"] ?> грн</td>
                        <td><?= $product["quantity"] ?></td>
                        <td><img src="<?= ($product["image"]) ?>" alt=""></td>
                    </tr>
                <?php } ?>
            </table>

            <ul class="categoriesButton">
                <?php foreach ($links as $link) { ?>
                    <li><a href="?page=<?= $link['page'] ?>"><?= $link['label'] ?></a></li>
                <?php } ?>
            </ul>
        <?php } ?>
    <form action="makeOrder" method="POST">
        <input type="text" name="name" placeholder="Ім'я"><br>
        <input type="text" name="phone" placeholder="Телефон"><br>
        <button type="submit">submit order</button>
        <br><br>
        <p><?= $error ?? "" ?></p>
    </form>
</main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>