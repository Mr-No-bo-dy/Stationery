<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/stationery/app/resources/css/styles.css">
</head>


<body>
<header>
    <nav>
        <ul class="head_menu">
            <li><a class="head_link" href="home">Home</a></li>
            <li><a class="head_link" href="category">Categories</a></li>
            <li><a class="head_link" href="catalog">Catalogue</a></li>
            <li><a class="head_link" href="reviews">Reviews</a></li>
            <li><a class="head_link" href="cart">Cart</a></li>
            <?php if (!isset($_SESSION['user'])) { ?>
                <li><a class="head_link" href="registration">Register</a></li>
                <li><a class="head_link" href="login">Login</a></li>
            <?php } else { ?>
                <li>
                    <a class="head_link profile_photo" href="profile"><img src="<?= 'app/resources/img/users/' . $_SESSION['user']['photo'] ?>" alt="profile photo"></a>
                </li>
                <?php if ($_SESSION['user']['role'] == 'admin' || $_SESSION['user']['role'] == 'SuperAdmin'): ?>
                    <li>
                        <a class="head_link" href="admin/home">Admin</a>
                    </li>
                <?php endif; ?>
                <li><a class="head_link" href="logout">Logout</a></li>
            <?php } ?>
        </ul>
    </nav>
</header>
