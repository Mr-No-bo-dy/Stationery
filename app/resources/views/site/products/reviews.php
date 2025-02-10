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
    <input type="range" name="rating" max="5">
    <input type="text" name="comment">
    <input type="submit" name="send" value="send">
</main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>