<?php require_once 'app/resources/views/admin/components/header.php'?>

<main>
    <div class="all-reviews-list">
        <h1>Orders list</h1>
        <form action="userFiltering" method="get">
            <p>Sorting by</p>
            <button style="font-size: 20px; padding: 5px" type="submit" name="sort" value="id">all</button>
            <button style="font-size: 20px; padding: 5px" type="submit" name="sort" value="userId">user_id</button>
            <button style="font-size: 20px; padding: 5px" type="submit" name="sort" value="desc">price desc</button>
            <button style="font-size: 20px; padding: 5px" type="submit" name="sort" value="asc">price asc</button>
            <p>User's orders filter</p>
            <input type="text" name="minPrice" placeholder="min total price" value="<?= $_GET['minPrice'] ?? '' ?>">
            <input type="text" name="maxPrice" placeholder="max total price" value="<?= $_GET['maxPrice'] ?? '' ?>">
            <input type="text" name="userid" placeholder="user id" value="<?= $_GET['userid'] ?? '' ?>">
            <button type="submit">Search</button>
        </form>
        <br>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Product ID</th>
                <th>User ID</th>
                <th>Count</th>
                <th>Total</th>
            </tr>
            <?php foreach($ordersItems as $order) { ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= $order['product_id'] ?></td>
                    <td><?= $order['user_id'] ?></td>
                    <td><?= $order['count'] ?></td>
                    <td><?= $order['total'] ?></td>
                </tr>
            <?php } ?>
        </table>
        <ul class="categoriesButton">
            <?php foreach ($links as $link) { ?>
                <li>
                    <a href="?page=<?= $link['page'] ?>
                        <?php
                        foreach ($filters as $key => $value) {
                            echo "&$key=" . urlencode($value);
                        }
                        ?>">
                        <?= $link['label'] ?>
                    </a>
                </li>
            <?php } ?>
        </ul>


    </div>
</main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>