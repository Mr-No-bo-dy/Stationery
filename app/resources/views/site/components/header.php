<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Stationery" ?></title>
    <link rel="stylesheet" href="/stationery/app/resources/css/<?= !isset($_COOKIE['colorTheme']) || $_COOKIE['colorTheme'] == 'light' ? '' : 'dark' ?>styles.css">
</head>


<body>
<header>
    <nav>
        <ul class="head_menu">
            <?php if (isset($_SESSION['user'])) { ?>
                <li>
                    <a class="head_link profile_photo" href="profile"><img src="<?= 'app/resources/img/users/' . $_SESSION['user']['photo'] ?>" alt="profile photo"></a>
                </li>
            <?php } ?>
            <li>
                <form action="changeColorTheme" method="post">
                    <label class="head_link" for="changeColor"><?= !isset($_COOKIE['colorTheme']) || $_COOKIE['colorTheme'] == 'light' ? 'Dark' : 'Light' ?></label>
                    <input class="dn" type="submit" id="changeColor" name="uri" value="<?= $_SERVER['REQUEST_URI'] ?>">
                </form>
            </li>
        </ul>

        <ul class="head_menu">
            <li><a class="head_link <?= str_contains($_SERVER['REQUEST_URI'], '/home') ? 'active' : '' ?>" href="home">Home</a></li>
            <li><a class="head_link <?= str_contains($_SERVER['REQUEST_URI'], '/category') ? 'active' : '' ?>" href="category">Categories</a></li>
            <li><a class="head_link <?= str_contains($_SERVER['REQUEST_URI'], '/catalog') ? 'active' : '' ?>" href="catalog">Catalogue</a></li>
            <li><a class="head_link <?= str_contains($_SERVER['REQUEST_URI'], '/cart') ? 'active' : '' ?>" href="cart">Cart</a></li>

        </ul>
        <ul class="head_menu">
            <?php if (!isset($_SESSION['user'])) { ?>
                <li><a class="head_link <?= str_contains($_SERVER['REQUEST_URI'], '/registration') ? 'active' : '' ?>" href="registration">Register</a></li>
                <li><a class="head_link <?= str_contains($_SERVER['REQUEST_URI'], '/login') ? 'active' : '' ?>" href="login">Login</a></li>
            <?php } else { ?>
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
