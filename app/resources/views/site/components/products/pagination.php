<ul  class="pageSelect">
    <?php foreach ($links as $link) { ?>
        <li><a href="?page=<?= $link['page'] ?><?= !empty($_GET["sort"]) ? "&sort=" . $_GET["sort"]: ""?><?= !empty($_GET["title"]) ? "&title=" . $_GET["title"]: "" ?><?= !empty($_GET["minPrice"]) ? "&minPrice=" . $_GET["minPrice"]: "" ?><?= !empty($_GET["maxPrice"]) ? "&maxPrice=" . $_GET["maxPrice"]: "" ?><?= !empty($_GET["subcategory_id"]) ? "&subcategory_id=" . $_GET["subcategory_id"]: "" ?>"><?= $link['label'] ?></a></li>
    <?php } ?>
</ul>