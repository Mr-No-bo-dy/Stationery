<?php require_once 'app/resources/views/admin/components/header.php' ?>

    <main>
        <form action="updateCategory" method="post">
            <label>
                <p>New category name</p>
                <input type="text" name="newCategoryName">
            </label>
            <label>
                <p>New category description</p>
                <textarea name="newCategoryDescription" cols="30" rows="10"></textarea>
            </label>
            <input type="hidden" name="categoryId" value="<?= $_POST['categoryId'] ?>">
            <input type="submit" value="update">
        </form>
    </main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>