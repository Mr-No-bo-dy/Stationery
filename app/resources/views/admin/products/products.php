<?php require_once 'app/resources/views/admin/components/header.php';



?>
<main>
<?php require_once 'app/resources/views/site/components/products/productsSort.php'; ?>
    <?php require_once 'app/resources/views/site/components/products/productFilters.php'; ?>

    <a href="productCreating" class="productCreate">Create product</a>
    <div class="catalog wrapper">
        <table class="productBlock">
            <tr>
                <th>Id</th>
                <th>Image</th>
                <th>Title</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Subcategory</th>
                <th colspan="2">Actions</th>
            </tr>
            <?php foreach ($products as $product) { ?>
                <tr></tr>
                <!-- <a class="card" href="> -->
                <td><?= $product['id'] ?></td>
                <td><img class="adminProductImg" src="../app/resources/img/products/<?= (file_exists("app/resources/img/products/" . $product['image']) ? $product['image'] : "product.jpg") ?> " alt="<?= $product['title'] ?>"></td>
                <!-- Checking for a file. If the file does not exist, we use the prepared photo, if we use the file that we actually checked. -->
                <td><a href="../card?id=<?= $product['id'] ?>"><?= $product['title']; ?></a></td>
                <td><?= $product['stock']; ?></td>
                <td><?= $product['price']; ?> $</td>
                <td><?= $subCategories[$product['subcategory_id']] ?></td>
                <td><a href="productEdit?id=<?= $product['id'] ?>" id="<?= $product['id'] ?>">Edit</a></td>
                <td>
                    <form action="productRemove" method="post">
                        <button type="submit" value="<?= $product['id'] ?>" name="remove">Remove</button>
                    </form>
                </td>
                <!-- </a>     -->
            <?php } ?>
            </tr>
        </table>
        <?php require_once 'app/resources/views/site/components/products/pagination.php' ?>
    </div>
</main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>