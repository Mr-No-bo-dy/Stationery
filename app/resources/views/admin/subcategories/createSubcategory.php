<?php require_once 'app/resources/views/admin/components/header.php' ?>

    <main>
        <form action="createSubcategory" method="post" class="categoryForm">
            <p class="formTitle">Create subcategory</p>
            <label>
                <p class="categoryLabel">New subcategory name</p>
                <input type="text" name="newSubcategoryName" class="categoryName categoryInput">
            </label>
            <label>
                <p class="categoryLabel">New subcategory description</p>
                <textarea name="newSubcategoryDescription" cols="30" rows="10" class="categoryDescription categoryInput"></textarea>
            </label>
            <input type="hidden" name="categoryId" value="<?= $_POST['categoryId'] ?>">
            <input type="submit" class="categorySubmitButton">
        </form>
    </main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>