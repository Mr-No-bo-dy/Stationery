<div class="pageSelect">
    <?php foreach ($links as $link) { ?>
        <li><a href="?page=<?= $link['page'] ?>"><?= $link['label'] ?></a></li>
    <?php } ?>
</div>