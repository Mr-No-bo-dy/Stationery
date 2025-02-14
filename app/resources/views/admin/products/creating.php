<?php require_once 'app/resources/views/admin/components/header.php' ?>


<form action="" method="POST" class="productForm">
    <input type="text" name="title" placeholder="title" required>
    <textarea id="description" name="description" placeholder="description" required></textarea>
    <input type="number" name="stock" placeholder="stock" required>
    <input type="number" name="price" placeholder="price" required>
    <input type="file" name="image" accept="image/*" required>
    <input type="number" name="subcategory_id" placeholder="subcategory_id" required>
    <input type="submit">
</form>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>