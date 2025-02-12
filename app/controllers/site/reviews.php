<?php require_once 'app/resources/views/site/components/header.php' ?>

<main>
    <table>
        <tbody>
            <?php foreach ($allReviews as $review) { ?>
                <tr>
                    <td><?= $review['name'] ?></td>
                    <td><?= $review['rating'] ?></td>
                    <td><?= $review['comment'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <form action="reviews" method="post">
        <input type="range" name="rating" min="1" max="5" value="5">
        <input type="text" name="comment">
        <input type="submit" name="send" value="send">
    </form>
</main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>