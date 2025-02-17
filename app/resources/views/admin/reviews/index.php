<?php require_once 'app/resources/views/admin/components/header.php' ?>

<main>
    <a class="adminReviewsButton" href="reviews?is_active=0">reviews only not active</a>
    <a class="adminReviewsButton" href="reviews?is_active=1">reviews only active</a>
    <table>
        <thead>
            <tr>
                <td><h2>id</h2></td>
                <td><h2>name</h2></td>
                <td><h2>product_id</h2></td>
                <td><h2>rating</h2></td>
                <td><h2>comment</h2></td>
                <td><h2>is_active</h2></td>
                <td><h2>approved</h2></td>
                <td><h2>not approved</h2></td>
            </tr>
        </thead>
        <tbody>
            <form action="reviews" method="post">
                <?php foreach ($allReviews as $review) { ?>
                    <?php if (isset($_GET["is_active"])) { ?>
                        <?php if ($review["is_active"] == $_GET["is_active"]) { ?>
                            <tr>
                                <td><?= $review['id'] ?></td>
                                <td><?= $review['name'] ?></td>
                                <td><?= $review['product_id'] ?></td>
                                <td><?= $review['rating'] ?></td>
                                <td><?= $review['comment'] ?></td>
                                <td><?= $review['is_active'] ?></td>
                                <td><input type="submit" value="approved" name="<?= $review['id'] ?>"></td>
                                <td><input type="submit" value="not approved" name="<?= $review['id'] ?>"></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td><?= $review['id'] ?></td>
                            <td><?= $review['name'] ?></td>
                            <td><?= $review['product_id'] ?></td>
                            <td><?= $review['rating'] ?></td>
                            <td><?= $review['comment'] ?></td>
                            <td><?= $review['is_active'] ?></td>
                            <td><input type="submit" value="approved" name="<?= $review['id'] ?>"></td>
                            <td><input type="submit" value="not approved" name="<?= $review['id'] ?>"></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </form>
        </tbody>
    </table>
</main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>