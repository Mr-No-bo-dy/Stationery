<?php require_once 'app/resources/views/site/components/header.php' ?>

<main class="reviewsMain">
    <div class="wrapper">
        <table class="reviewsTable">
            <thead>
                <tr>
                    <td>name</td>
                    <td>rating</td>
                    <td>comment</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allReviews as $review) { ?>
                    <?php if ($review["product_id"] == $_GET["id"] && $review["is_active"] == 1) { ?>
                        <tr>
                            <td><?= $review['name'] ?></td>
                            <td><?= $review['rating'] ?></td>
                            <td><?= $review['comment'] ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
        <ul>
            <?php foreach ($links as $link) { ?>
                <li>
                    <?php if ((isset($_GET['page']) && $_GET['page'] == $link['page']) || (!isset($_GET['page']) && $link['page'] == 1)): ?>
                        <a class="active" href="?page=<?= $link['page'] ?><?= isset($_GET["id"]) ? "&id=".$_GET["id"] : "" ?>"><?= $link['label'] ?></a>
                    <?php else: ?>
                        <a href="?page=<?= $link['page'] ?><?= isset($_GET["id"]) ? "&id=".$_GET["id"] : "" ?>"><?= $link['label'] ?></a>
                    <?php endif; ?>
                </li>
            <?php } ?>
        </ul>
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