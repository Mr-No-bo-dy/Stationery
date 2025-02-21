<?php require_once 'app/resources/views/admin/components/header.php' ?>

    <main>
        <form action="storeSubcategory" method="post" class="categoryForm">
            <p class="formTitle">Create subcategory</p>
            <label>
                <p class="categoryLabel">New subcategory name</p>
                <input type="text" name="title" class="categoryName categoryInput">
            </label>
            <label>
                <p class="categoryLabel">New subcategory description</p>
                <textarea name="description" cols="30" rows="10" class="categoryDescription categoryInput"></textarea>
            </label>
            <label>
                <p class="categoryLabel">Category</p>
                <select name="categoryTitle">
                    <?php foreach ($allCategoriesTitle as $category) { ?>
                        <option value="<?= $category['title'] ?>"><?= $category['title'] ?></option>
                    <?php } ?>
                </select>
            </label>
            <input type="submit" class="categorySubmitButton">
        </form>
    </main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>