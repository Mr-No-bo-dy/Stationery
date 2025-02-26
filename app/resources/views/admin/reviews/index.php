<?php require_once 'app/resources/views/admin/components/header.php' ?>

<main class="reviewsMain">
    <div class="wrapper">
        <form class="adminReviewsButtonForm" action="reviews" method="post">    
            <?php if (isset($_SESSION["reviews"]["is_active"])) { ?>    
                <?php if ($_SESSION["reviews"]["is_active"] == "reviews only active") { ?>
                    <input class="adminReviewsButton" type="submit" name="is_active" value="all reviews">
                    <input class="adminReviewsButton" type="submit" name="is_active" value="reviews only not active">
                    <input disabled style="background: #ddd;" class="adminReviewsButton" type="submit" name="is_active" value="reviews only active">
                <?php } else { ?>
                    <input class="adminReviewsButton" type="submit" name="is_active" value="all reviews">
                    <input disabled style="background: #ddd;" class="adminReviewsButton" type="submit" name="is_active" value="reviews only not active">
                    <input class="adminReviewsButton" type="submit" name="is_active" value="reviews only active">
                <?php } ?>
            <?php } else { ?>
                <input disabled style="background: #ddd;" class="adminReviewsButton" type="submit" name="is_active" value="all reviews">
                <input class="adminReviewsButton" type="submit" name="is_active" value="reviews only not active">
                <input class="adminReviewsButton" type="submit" name="is_active" value="reviews only active">
            <?php } ?>
            <?php if (isset($_SESSION["reviews"]["sortBy"])) { ?>   
                <?php if ($_SESSION["reviews"]["sortBy"] == "sort by rating") { ?>
                    <input disabled style="background: #ddd;" class="adminReviewsButton" type="submit" name="sortBy" value="sort by rating">
                    <input class="adminReviewsButton" type="submit" name="sortBy" value="sort by id">
                    <input class="adminReviewsButton" type="submit" name="sortBy" value="sort by product id">
                <?php } else if ($_SESSION["reviews"]["sortBy"] == "sort by id") { ?>
                    <input class="adminReviewsButton" type="submit" name="sortBy" value="sort by rating">
                    <input disabled style="background: #ddd;" class="adminReviewsButton" type="submit" name="sortBy" value="sort by id">
                    <input class="adminReviewsButton" type="submit" name="sortBy" value="sort by product id">
                <?php } else { ?>
                    <input class="adminReviewsButton" type="submit" name="sortBy" value="sort by rating">
                    <input class="adminReviewsButton" type="submit" name="sortBy" value="sort by id">
                    <input disabled style="background: #ddd;" class="adminReviewsButton" type="submit" name="sortBy" value="sort by product id">
                <?php } ?>
            <?php } else { ?>
                <input class="adminReviewsButton" type="submit" name="sortBy" value="sort by rating">
                <input disabled style="background: #ddd;" class="adminReviewsButton" type="submit" name="sortBy" value="sort by id">
            <?php } ?>
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