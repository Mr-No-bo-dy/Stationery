<?php require_once 'app/resources/views/admin/components/header.php' ?>

<main>
    <form method="post" action="productUpdate" class="productCard cardForm">
        <img src="../app/resources/img/products/<?= (file_exists("../app/resources/img/products/" . $product['image']) ? $product['image'] : "product.jpg") ?> " alt="табурєтка">
        <label for="title">title:</label>
        <textarea id="title" name="title"><?= $product['title']; ?></textarea>
        <label for="description">description:</label>
        <textarea id="description" name="description"><?= $product['description']; ?></textarea>
        <label for="price">price:</label>
        <input value="<?= $product['price']; ?>" name="price" id="price" type="number">
        <label for="stock">Stock:</label>
        <input value="<?= $product['stock']; ?>" id="stock" name="stock" type="number">
        <input type="hidden" name="id" value="<?= $product["id"] ?>">
        <select name="subcategory_id">
            <?php foreach ($allSubcategories as $category) { ?>
                <option value="<?= $category["id"] ?>"><?= $category["title"] ?></option>
            <?php } ?>
        </select>
        <input type="submit">
    </form>
</main>


<?php require_once 'app/resources/views/admin/components/footer.php' ?>