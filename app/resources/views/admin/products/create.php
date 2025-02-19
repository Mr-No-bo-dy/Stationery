<?php require_once 'app/resources/views/admin/components/header.php' ?>


<form action="" method="POST" class="productForm" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="title" required>
    <textarea id="description" name="description" placeholder="description" required></textarea>
    <input type="number" name="stock" placeholder="stock" required>
    <input type="number" name="price" placeholder="price" required>
    <input type="file" name="image">
     <select name="subcategory_id">
        <?php foreach($allSubcategories as $category){ ?>
        <option value="<?= $category["id"] ?>"><?= $category["title"] ?></option>
        <?php } ?>
     </select>
    <input type="submit">
</form>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>