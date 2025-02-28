<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Stationery' ?></title>
    <link rel="stylesheet" href="/stationery/app/resources/css/<?= !isset($_COOKIE['colorTheme']) || $_COOKIE['colorTheme'] == 'light' ? '' : 'dark' ?>styles.css">
</head>

<body>
    <header>
        <nav>
            <ul class="head_menu">
                <li>
                    <form action="changeColorTheme" method="post">
                        <label class="head_link" for="changeColor"><?= !isset($_COOKIE['colorTheme']) || $_COOKIE['colorTheme'] == 'light' ? 'Dark' : 'Light' ?></label>
                        <input class="dn" type="submit" id="changeColor" name="uri" value="<?= $_SERVER['REQUEST_URI'] ?>">
                    </form>
                </li>
            </ul>
            <ul class="head_menu">
                <li>
                    <a class="head_link <?= str_contains($_SERVER['REQUEST_URI'], '/home') ? 'active' : '' ?>" href="home">Dashboard</a>
                </li>
                <li>
                    <a class="head_link <?= str_contains($_SERVER['REQUEST_URI'], '/users') ? 'active' : '' ?>" href="users">Users</a>
                </li>
                <li>
                    <a class="head_link <?= str_contains($_SERVER['REQUEST_URI'], '/category') ? 'active' : '' ?>" href="category">Categories</a>
                </li>
                <li>
                    <a class="head_link <?= str_contains($_SERVER['REQUEST_URI'], '/subcategory') ? 'active' : '' ?>" href="subcategory">Subcategories</a>
                </li>
                <li>
                    <a class="head_link <?= str_contains($_SERVER['REQUEST_URI'], '/products') ? 'active' : '' ?>" href="products">Products</a>
                </li>
                <li>
                    <a class="head_link <?= str_contains($_SERVER['REQUEST_URI'], '/reviews') ? 'active' : '' ?>" href="reviews">Reviews</a>
                </li>
              <li>
                  <a class="head_link <?= str_contains($_SERVER['REQUEST_URI'], '/orders') ? 'active' : '' ?>" href="orders">Orders</a>
              </li>
            </ul>
            <ul class="head_menu">
                <li>
                    <a class="head_link" href="../home">Site</a>
                </li>
                <li>
                    <a class="head_link" href="logout">Logout</a>
                </li>
            </ul>
        </nav>
    </header>
