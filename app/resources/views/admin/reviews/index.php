<?php require_once 'app/resources/views/admin/components/header.php' ?>

<main class="reviewsMain">
    <div class="wrapper">
        <form class="adminReviewsButtonForm" action="reviews" method="post">    
            <?php if (isset($_SESSION["reviews"]["is_active"])) { ?>    
                <?php if ($_SESSION["reviews"]["is_active"] == "reviews only active") { ?>
                    <input class="adminReviewsButton" type="submit" name="is_active" value="all reviews">
                    <input class="adminReviewsButton" type="submit" name="is_active" value="reviews only not active">
                    <input style="background: #ddd;" class="adminReviewsButton" type="submit" name="is_active" value="reviews only active">
                <?php } else { ?>
                    <input class="adminReviewsButton" type="submit" name="is_active" value="all reviews">
                    <input style="background: #ddd;" class="adminReviewsButton" type="submit" name="is_active" value="reviews only not active">
                    <input class="adminReviewsButton" type="submit" name="is_active" value="reviews only active">
                <?php } ?>
            <?php } else { ?>
                <input style="background: #ddd;" class="adminReviewsButton" type="submit" name="is_active" value="all reviews">
                <input class="adminReviewsButton" type="submit" name="is_active" value="reviews only not active">
                <input class="adminReviewsButton" type="submit" name="is_active" value="reviews only active">
            <?php } ?>
            <?php if (isset($_SESSION["reviews"]["sortBy"])) { ?>   
                <?php if ($_SESSION["reviews"]["sortBy"] == "sort by rating") { ?>
                    <input style="background: #ddd;" class="adminReviewsButton" type="submit" name="sortBy" value="sort by rating">
                    <input class="adminReviewsButton" type="submit" name="sortBy" value="sort by id">
                <?php } else { ?>
                    <input class="adminReviewsButton" type="submit" name="sortBy" value="sort by rating">
                    <input style="background: #ddd;" class="adminReviewsButton" type="submit" name="sortBy" value="sort by id">
                <?php } ?>
            <?php } else { ?>
                <input class="adminReviewsButton" type="submit" name="sortBy" value="sort by rating">
                <input style="background: #ddd;" class="adminReviewsButton" type="submit" name="sortBy" value="sort by id">
            <?php } ?>
        </form>
        <table class="reviewsTable">
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
                        <?php if (isset($_SESSION["reviews"]["is_active"])) { ?>
                            <?php if ($review["is_active"] == $isOnlyActive) { ?>
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
    </div>
</main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>