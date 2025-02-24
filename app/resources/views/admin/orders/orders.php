<?php require_once 'app/resources/views/admin/components/header.php' ?>

<main>
    <div class="all-reviews-list">
        <h1>Orders list</h1>
        <form action="ordersSorting" method="get">
            <p>Sorting by</p>
            <br>
            <button style="font-size: 20px; padding: 5px" type="submit" name="sort" value="">id</button>
            <button style="font-size: 20px; padding: 5px" type="submit" name="sort" value="desc">price desc</button>
            <button style="font-size: 20px; padding: 5px" type="submit" name="sort" value="asc">price asc</button>
        </form>
        <form action="userFiltering">
            <p>Search user's orders by ID</p>
            <input type="text" name="userid" placeholder="user id">
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
            <?php foreach($orders as $order) { ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= $order['product_id'] ?></td>
                    <td><?= $order['user_id'] ?></td>
                    <td><?= $order['count'] ?></td>
                    <td><?= $order['total'] ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>