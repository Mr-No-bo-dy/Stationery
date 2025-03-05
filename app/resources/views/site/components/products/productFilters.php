<h2>Filters:</h2>
<form action="" method="get">
    <input type="text" name="title" value="<?= $_GET["title"] ?? "" ?>" placeholder="Name">
    <input type="number" name="minPrice" value="<?= $_GET["minPrice"] ?? "" ?>" placeholder="Min price">
    <input type="number" name="maxPrice" value="<?= $_GET["maxPrice"] ?? "" ?>" placeholder="Max price">
    <select name="subcategory_id">
        <option>All</option>
        <?php foreach ($subCategories as $subCatId => $subCat) { ?>
            <option value="<?= $subCatId ?>" <?= isset($_GET["subcategory_id"]) && $_GET["subcategory_id"] == $subCatId ? "selected" : "" ?>><?= $subCat ?></option>
        <?php } ?>
    </select>
    <?= !empty($_GET["sort"]) ? '<input type="hidden" name="sort" value="' . $_GET["sort"] . '">' : ""   ?>
    <input type="submit" value="Filter">
</form>
<a href="<?= $uri?>">Clear filters</a>