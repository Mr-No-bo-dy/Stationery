<?php require_once 'app/resources/views/admin/components/header.php' ?>

<main class="reviewsMain">
    <div class="wrapper">
        <form class="adminReviewsButtonForm" action="reviews" method="post">    
        <div class="reviews_block">
                <p>is_active:</p>
                <div class="reviews_inputs-flex">
                    <?php if (isset($_SESSION["reviews"]["is_active"])) { ?>    
                        <?php if ($_SESSION["reviews"]["is_active"] == "yes") { ?>
                            <input class="adminReviewsButton" type="submit" name="is_active" value="all">
                            <input class="adminReviewsButton" type="submit" name="is_active" value="no">
                            <input disabled style="background: #ddd;" class="adminReviewsButton" type="submit" name="is_active" value="yes">
                        <?php } else { ?>
                            <input class="adminReviewsButton" type="submit" name="is_active" value="all">
                            <input disabled style="background: #ddd;" class="adminReviewsButton" type="submit" name="is_active" value="no">
                            <input class="adminReviewsButton" type="submit" name="is_active" value="yes">
                        <?php } ?>
                    <?php } else { ?>
                        <input disabled style="background: #ddd;" class="adminReviewsButton" type="submit" name="is_active" value="all">
                        <input class="adminReviewsButton" type="submit" name="is_active" value="no">
                        <input class="adminReviewsButton" type="submit" name="is_active" value="yes">
                    <?php } ?>
                </div>
            </div>
            <div class="reviews_block">
                <p>sort by:</p>
                <div class="reviews_inputs-flex">
                    <?php if (isset($_SESSION["reviews"]["sortBy"])) { ?>   
                        <?php if ($_SESSION["reviews"]["sortBy"] == "rating") { ?>
                            <input disabled style="background: #ddd;" class="adminReviewsButton" type="submit" name="sortBy" value="rating">
                            <input class="adminReviewsButton" type="submit" name="sortBy" value="id">
                            <input class="adminReviewsButton" type="submit" name="sortBy" value="product id">
                        <?php } else if ($_SESSION["reviews"]["sortBy"] == "id") { ?>
                            <input class="adminReviewsButton" type="submit" name="sortBy" value="rating">
                            <input disabled style="background: #ddd;" class="adminReviewsButton" type="submit" name="sortBy" value="id">
                            <input class="adminReviewsButton" type="submit" name="sortBy" value="product id">
                        <?php } else { ?>
                            <input class="adminReviewsButton" type="submit" name="sortBy" value="rating">
                            <input class="adminReviewsButton" type="submit" name="sortBy" value="id">
                            <input disabled style="background: #ddd;" class="adminReviewsButton" type="submit" name="sortBy" value="product id">
                        <?php } ?>
                    <?php } else { ?>
                        <input class="adminReviewsButton" type="submit" name="sortBy" value="rating">
                        <input disabled style="background: #ddd;" class="adminReviewsButton" type="submit" name="sortBy" value="id">
                        <input class="adminReviewsButton" type="submit" name="sortBy" value="product id">
                    <?php } ?>
                </div>
            </div>
        </form>
        <table class="reviewsTable">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>product_id</th>
                    <th>rating</th>
                    <th>comment</th>
                    <th>is_active</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <form action="reviews" method="post">
                    <?php foreach ($allReviews as $review) { ?>
                        <tr>
                            <td><a href="../reviews?id=<?= $review['product_id'] ?>"><?= $review['id'] ?></a></td>
                            <td><a href="edit?id=<?= $review['user_id'] ?>"><?= $review['name'] ?></a></td>
                            <td><a href="productEdit?id=<?= $review['product_id'] ?>"><?= $review['product_id'] ?></a></td>
                            <td><?= $review['rating'] ?></td>
                            <td><?= $review['comment'] ?></td>
                            <?php if ($review["is_active"]) { ?>
                                <td>yes</td>
                                <td><input type="submit" value="not approve" name="<?= $review['id'] ?>"></td>
                            <?php } else { ?>
                                <td>no</td>
                                <td><input type="submit" value="approve" name="<?= $review['id'] ?>"></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </form>
            </tbody>
        </table>
    </div>
</main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>