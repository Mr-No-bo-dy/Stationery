<?php require_once 'app/resources/views/admin/components/header.php' ?>

<main class="reviewsMain">
    <div class="wrapper">
        <form class="adminReviewsButtonForm" action="reviews" method="post">    
            <input class="adminReviewsButton" type="submit" value="drop filters" name="sessDrop">
        </form>
        <form class="adminReviewsButtonForm" action="reviews" method="post">    
            <div class="reviews_block">
                <p>is_active:</p>
                <div class="reviews_inputs-flex">
                    <input class="adminReviewsButton" type="submit" name="is_active" value="yes" 
                        <?= isset($_SESSION["reviews"]["filters"]["is_active"]) && $_SESSION["reviews"]["filters"]["is_active"] == "yes" ? "disabled style='background: #ddd;'" : "" ?>>
                    <input class="adminReviewsButton" type="submit" name="is_active" value="no" 
                        <?= isset($_SESSION["reviews"]["filters"]["is_active"]) && $_SESSION["reviews"]["filters"]["is_active"] == "no" ? "disabled style='background: #ddd;'" : "" ?>>
                    <input class="adminReviewsButton" type="submit" name="is_active" value="all" 
                        <?= isset($_SESSION["reviews"]["filters"]["is_active"]) ? "" : "disabled style='background: #ddd;'" ?>>
                </div>
            </div>
            <div class="reviews_block">
                <p>sort by:</p>
                <div class="reviews_inputs-flex">
                    <input class="adminReviewsButton" type="submit" name="sortBy" value="rating" 
                        <?= isset($_SESSION["reviews"]["sortBy"]) && $_SESSION["reviews"]["sortBy"] == "rating" ? "disabled style='background: #ddd;'" : "" ?>>
                    <input class="adminReviewsButton" type="submit" name="sortBy" value="id" 
                        <?= $_SESSION["reviews"]["sortBy"] == "id" ? "disabled style='background: #ddd;'" : "" ?>>
                    <input class="adminReviewsButton" type="submit" name="sortBy" value="product id" 
                        <?= isset($_SESSION["reviews"]["sortBy"]) && $_SESSION["reviews"]["sortBy"] == "product id" ? "disabled style='background: #ddd;'" : "" ?>>
                </div>
            </div>
        </form>
        <form class="adminReviewsButtonForm" action="reviews" method="post">    
            <div class="reviews_block">
                <p>product_id:</p>
                <div class="reviews_inputs-flex">
                    <select name="product_id">
                        <option value="">all</option>
                        <?php foreach ($allProductsWithReviews as $id => $pr) { ?>
                            <option value="<?= $id ?>" <?= isset($_SESSION["reviews"]["filters"]["product_id"]) && $_SESSION["reviews"]["filters"]["product_id"] == $id ? "selected" : "" ?>><?= $id ?>. <?= $pr ?></option>
                        <?php } ?>
                    </select>
                    <input type="submit" value="send">
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
        <ul>
            <?php foreach ($links as $link) { ?>
                <li>
                    <?php if ((isset($_GET['page']) && $_GET['page'] == $link['page']) || (!isset($_GET['page']) && $link['page'] == 1)): ?>
                        <a class="active" href="?page=<?= $link['page'] ?>"><?= $link['label'] ?></a>
                    <?php else: ?>
                        <a href="?page=<?= $link['page'] ?>"><?= $link['label'] ?></a>
                    <?php endif; ?>
                </li>
            <?php } ?>
        </ul>
    </div>
</main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>