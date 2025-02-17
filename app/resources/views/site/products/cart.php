<?php require_once 'app/resources/views/site/components/header.php';?>
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
                <th colspan="3">Дії</th>
            </tr>

            <?php foreach (isset($_SESSION["cart"]) ? $_SESSION["cart"] : [] as $product) { ?>
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td><?= $product['title'] ?></td>
                    <td><?= $product['price'] ?> грн</td>
                    <td><?= $product['quantity'] ?></td>
                    <td><img src="<?= ($product['image']) ?>" alt=""></td>
                    <td>
                        <form action="plusItemToCart" method="POST">
                            <input type="hidden" name="id" value="<?= $product['id'] ?>">
                            <button type="submit">+</button>
                        </form>
                    </td>
                    <td>
                        <form action="minusItemFromCart" method="POST">
                            <input type="hidden" name="id" value="<?= $product['id'] ?>">
                            <button type="submit">-</button>
                        </form>
                    </td>
                    <td>
                        <form action="removeFromCart" method="POST">
                            <input type="hidden" name="id" value="<?= $product['id'] ?>">
                            <button type="submit">Видалити</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <h1>Оформлення замовлення</h1>
        <br>
        <form action="makeOrder" method="POST">
            <input type="hidden" name="id" value="<?=$_SESSION["user"]["id"]?>"><br>
            <input type="text" name="name" placeholder="Ім'я"><br>
            <input type="text" name="phone" placeholder="Телефон"><br>
            <button type="submit">Замовити</button>
        </form>


    <?php } ?>
    
</main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>