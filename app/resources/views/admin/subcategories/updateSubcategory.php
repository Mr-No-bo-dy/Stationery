<?php require_once 'app/resources/views/admin/components/header.php' ?>

    <main>
        <form action="editSubcategory" method="post" class="categoryForm">
            <p class="formTitle">Edit subcategory</p>
            <label>
                <p class="categoryLabel">New subcategory name</p>
                <input type="text" name="title" value="<?= $subcategory['title'] ?>" class="categoryName categoryInput">
            </label>
            <label>
                <p class="categoryLabel">New category description</p>
                <textarea name="description" cols="30" rows="10" class="categoryDescription categoryInput"><?= $subcategory['description'] ?></textarea>
            </label>
            <input type="hidden" name="subcategoryId" value="<?= $_GET['id'] ?>">
            <input type="submit" value="update" class="categorySubmitButton">
        </form>
    </main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>