<?php require_once 'app/resources/views/admin/components/header.php' ?>

<main>
    <form action="createCategory" method="post" class="categoryForm">
        <p class="formTitle">Create category</p>
        <label>
            <p class="categoryLabel">New category name</p>
            <input type="text" name="newCategoryName" class="categoryName categoryInput">
        </label>
        <label>
            <p class="categoryLabel">New category description</p>
            <textarea name="newCategoryDescription" cols="30" rows="10" class="categoryDescription categoryInput"></textarea>
        </label>
        <input type="submit" class="categorySubmitButton">
    </form>
</main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>