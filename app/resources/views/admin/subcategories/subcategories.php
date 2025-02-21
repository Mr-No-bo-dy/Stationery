<?php require_once 'app/resources/views/admin/components/header.php' ?>

<main>
    <table class="subcategory">
        <tr>
            <td colspan="5" class="text-left">
                <a href="createSubcategory">Create subcategory</a>
            </td>
        </tr>
        <tr>
            <th>category title</th>
            <th>title</th>
            <th>description</th>
        </tr>
        <?php foreach ($allSubcategories as $subcategory) { ?>
            <tr>

                <td><?= $subcategory['category_title'] ?></td>
                <td><?= $subcategory['subcategory_title'] ?></td>
                <td><?= $subcategory['description'] ?></td>
                <td>
<!--                    <form action="updateSubcategory" method="post">-->
<!--                        <input type="hidden" name="subcategoryName" value="--><?php //= $subcategory['category_title'] ?><!--">-->
<!--                        <input type="hidden" name="subcategoryDescription" value="--><?php //= $subcategory['description'] ?><!--">-->
<!--                        <button type="submit" name="subcategoryId" value="--><?php //= $subcategory['id'] ?><!--">UPDATE</button>-->
<!--                    </form>-->
                    <a href="updateSubcategory?id=<?= $subcategory['id'] ?>">UPDATE</a>
                </td>
<!--                <td><form action="deleteSubcategory" method="post"><button type="submit" name="subcategoryId" value="--><?php //= $subcategory['id'] ?><!--" >DELETE</button></form></td>-->
                <td><a href="deleteSubcategory?id=<?= $subcategory['id'] ?>">DELETE</a></td>
            </tr>
        <?php } ?>
    </table>
</main>

<?php require_once 'app/resources/views/admin/components/footer.php' ?>