<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="app/resources/css/styles.css">
</head>
<body>
<wrapper>
    <nav>
        <ul>
            <li><a href="<?=HOME?>">Home</a></li>
            <li><a href="<?=REGISTER?>">Register</a></li>
            <li>
                <a href="<?= isset($_SESSION['user']) ? LOGOUT : LOGIN?>"><?= isset($_SESSION['user']) ? "Logout" : "Login" ?></a>
            </li>

        </ul>
    </nav>
</wrapper>