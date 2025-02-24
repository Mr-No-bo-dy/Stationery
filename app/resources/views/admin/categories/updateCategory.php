<?php require_once 'app/resources/views/admin/components/header.php' ?>

    <main>
        <form action="updateCategory" method="post" class="categoryForm">
            <p class="formTitle">Edit category</p>
            <label>
                <p class="categoryLabel">New category name</p>
                <input type="text" name="title" value="<?= $_POST['title'] ?? $category['title'] ?>" class="categoryName categoryInput">
            </label>
            <label>
                <p class="categoryLabel">New category description</p>
                <textarea name="description" cols="30" rows="10" class="categoryDescription categoryInput"><?= $_POST['description'] ?? $category['description'] ?></textarea>
            </label>
            <input type="hidden" name="categoryId" value="<?= $_GET['id'] ?>">
            <input type="submit" value="update" class="categorySubmitButton">
            <a href="subcategory" class="cancelButton">Cancel</a>
        </form>
    </main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>