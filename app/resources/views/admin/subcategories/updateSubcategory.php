<?php require_once 'app/resources/views/admin/components/header.php' ?>

    <main>
        <form action="updateSubcategory" method="post" class="categoryForm">
            <p class="formTitle">Edit subcategory</p>
            <label>
                <p class="categoryLabel">New subcategory name</p>
                <input type="text" name="newSubcategoryName" value="<?= $_POST['subcategoryName'] ?>" class="categoryName categoryInput">
            </label>
            <label>
                <p class="categoryLabel">New category description</p>
                <textarea name="newSubcategoryDescription" cols="30" rows="10" class="categoryDescription categoryInput"><?= $_POST['subcategoryDescription'] ?></textarea>
            </label>
            <input type="hidden" name="subcategoryId" value="<?= $_POST['subcategoryId'] ?>">
            <input type="submit" value="update" class="categorySubmitButton">
        </form>
    </main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>