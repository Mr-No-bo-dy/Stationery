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
    <ul class="head_menu">
        <li>
            <a class="head_link" href="home">Home</a>
        </li>
        <?php if (isset($_SESSION['user'])): ?>
            <?php if ($_SESSION['user']['role'] == 'admin' || $_SESSION['user']['role'] == 'SuperAdmin'): ?>
                <li>
                    <a class="head_link" href="users">Moderate Users</a>
                </li>
                <li>
                    <a class="head_link" href="category">Veiw categories</a>
                </li>
            <?php endif; ?>
            <li>
                <a class="head_link" href="logout">Logout</a>
            </li>
            <li>
                <a href="reviews">reviews</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
