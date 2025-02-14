<?php require_once 'app/resources/views/admin/components/header.php' ?>

    <main>
        <form action="updateCategory" method="post" class="categoryForm">
            <p class="formTitle">Edit category</p>
            <label>
                <p class="categoryLabel">New category name</p>
                <input type="text" name="newCategoryName" value="<?= $_POST['categoryName'] ?>" class="categoryName categoryInput">
            </label>
            <label>
                <p class="categoryLabel">New category description</p>
                <textarea name="newCategoryDescription" cols="30" rows="10" class="categoryDescription categoryInput"><?= $_POST['categoryDescription'] ?></textarea>
            </label>
            <input type="hidden" name="categoryId" value="<?= $_POST['categoryId'] ?>">
            <input type="submit" value="update" class="categorySubmitButton">
        </form>
    </main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>