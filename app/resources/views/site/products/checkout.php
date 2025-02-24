<?php require_once 'app/resources/views/site/components/header.php';?>
<main>
    <h1>Оформлення замовлення</h1>
    <br>
    <form action="makeOrder" method="POST">
        <input type="hidden" name="id" value="<?=$_SESSION["user"]["id"]?>"><br>
        <input type="text" name="name" placeholder="Ім'я"><br>
        <input type="text" name="phone" placeholder="Телефон"><br>
        <button type="submit">Замовити</button>
        <?php
            if (isset($error)) {
                echo $error;
            }
        ?>
    </form>
</main>

<?php require_once 'app/resources/views/site/components/footer.php' ?>