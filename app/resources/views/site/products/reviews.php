<?php require_once 'app/resources/views/site/components/header.php' ?>

<main class="reviewsMain">
    <div class="wrapper">
        <table class="reviewsTable">
            <thead>
                <?php if (isset($_GET["id"])) { ?>
                    <tr>
                        <td>name</td>
                        <td>rating</td>
                        <td>comment</td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td>name</td>
                        <td>product_id</td>
                        <td>rating</td>
                        <td>comment</td>
                    </tr>
                <?php } ?>
            </thead>
            <tbody>
                <?php foreach ($allReviews as $review) { ?>
                    <?php if (isset($_GET["id"])) { ?>
                        <?php if ($review["product_id"] == $_GET["id"] && $review["is_active"] == 1) { ?>
                            <tr>
                                <td><?= $review['name'] ?></td>
                                <td><?= $review['rating'] ?></td>
                                <td><?= $review['comment'] ?></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <?php if ($review["is_active"] == 1) { ?>
                            <tr>
                                <td><?= $review['name'] ?></td>
                                <td><?= $review['product_id'] ?></td>
                                <td><?= $review['rating'] ?></td>
                                <td><?= $review['comment'] ?></td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
        <?php if (isset($_GET["id"])) { ?>
            <form action="reviews?id=<?= $_GET["id"] ?>" method="post" class="createReviewsForm">
                <div class="range-star">
                    <input type="range" name="rating" id="rating" min="1" max="5" value="5">
                    <span class="star" id="star"></span>
                    <span class="star" id="star"></span>
                    <span class="star" id="star"></span>
                    <span class="star" id="star"></span>
                    <span class="star" id="star"></span>
                </div>
                <textarea name="comment" cols="90"></textarea>
                <input type="submit" name="send" value="">
            </form>
        <?php } ?>
    </div>
</main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>