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
            <li><a href="home">Home</a></li>
            <?php if (!isset($_SESSION['user'])): ?>
                <li><a href="register">Register</a></li>
            <?php endif; ?>
            <li>
                <a href="<?= isset($_SESSION['user']) ? 'logout' : 'login'?>"><?= isset($_SESSION['user']) ? "Logout" : "Login" ?></a>
            </li>

        </ul>
    </nav>
</wrapper>