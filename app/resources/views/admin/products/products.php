<?php require_once 'app/resources/views/admin/components/header.php';



?>
<main>
    <div class="catalog">
        <a href="productCreating" class="productCreate">Create product</a>
            <table class="productBlock">
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Stock</th>
                    <th>Price</th>
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
                    <td><a href="productEdit?id=<?= $product['id'] ?>" id="<?= $product['id'] ?>">Edit</a></td>
                    <td><a href="productRemove?id=<?= $product['id'] ?>">Remove</a></td>
                    <!-- </a>     -->
                <?php } ?>
                </tr>
            </table>

    </div>
</main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>