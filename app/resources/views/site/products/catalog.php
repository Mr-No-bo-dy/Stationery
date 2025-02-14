<?php require_once 'app/resources/views/site/components/header.php';



?>
<main>
    <div class="catalog">
        <div class="productBlock">
            <?php
            foreach ($products as $i => $result) {
                if ($i > 0 && $i % 3 == 0) {
                    echo '</div><div class="productBlock">';
                }
            ?>
                <a class="productCard" href="productCard?id=<?= $result['id'] ?>">
                    <p>There was supposed to be a photo, but there will be text. <br> <?= $result['image'] ?></p>
                    <h2><?= $result['title']; ?></h2>
                    <p><?= $result['description']; ?></p>
                    <p><?= $result['price']; ?> $</p>
                </a>
            <?php
            }
            ?>
        </div>
    </div>
</main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>