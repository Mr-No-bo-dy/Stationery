-<?php require_once 'app/resources/views/site/components/header.php' ?>

<main>
    <table>
        <tbody>
            <?php foreach ($allReviews as $review) { ?>
                <?php if (isset($_GET["id"])) { ?>
                    <?php if ($review["product_id"] == $_GET["id"]) { ?>
                        <tr>
                            <td><?= $review['name'] ?></td>
                            <td><?= $review['rating'] ?></td>
                            <td><?= $review['comment'] ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td><?= $review['name'] ?></td>
                        <td><?= $review['product_id'] ?></td>
                        <td><?= $review['rating'] ?></td>
                        <td><?= $review['comment'] ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
    <?php if (isset($_GET["id"])) { ?>
        <form action="<?= $url ?>" method="post" class="createReviewsForm">
            <input type="range" name="rating" min="1" max="5" value="5">
            <input type="text" name="comment">
            <input type="submit" name="send" value="">
        </form>
    <?php } ?>
</main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>