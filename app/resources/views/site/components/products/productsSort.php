<form action="" method="get">
    <label>Sort by</label>
    <?= !empty($_GET["title"]) ? '<input type="hidden" name="title" value="' . $_GET["title"] . '">' : ""   ?>
    <?= !empty($_GET["minPrice"]) ? '<input type="hidden" name="minPrice" value="' . $_GET["minPrice"] . '">' : ""   ?>
    <?= !empty($_GET["minPrice"]) ? '<input type="hidden" name="minPrice" value="' . $_GET["minPrice"] . '">' : ""   ?>
    <?= !empty($_GET["maxPrice"]) ? '<input type="hidden" name="maxPrice" value="' . $_GET["maxPrice"] . '">' : ""   ?>
    <?= !empty($_GET["subcategory_id"]) ? '<input type="hidden" name="subcategory_id" value="' . $_GET["subcategory_id"] . '">' : ""   ?>
    <input type="submit" name="sort" value="title">
    <input type="submit" name="sort" value="<?= $defaultSort ?> " checked>
    <input type="submit" name="sort" value="price growth">
    <input type="submit" name="sort" value="price downward">
</form>