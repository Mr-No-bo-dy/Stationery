<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/stationery/app/resources/css/styles.css">
</head>
<body>
<nav>
    <ul>
        <li>
            <a href="home">home</a>
        </li>
        <?php if (isset($_SESSION['user'])): ?>
            <li>
                <a href="logout">Logout</a>
            </li>
            <?php if ($_SESSION['user']['role'] == 'admin'): ?>
                <li>
                    <a href="users">view all users</a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
    </ul>
</nav>
