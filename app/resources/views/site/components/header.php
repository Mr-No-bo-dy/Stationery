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
            <?php if (isset($_SESSION['user'])): ?>
                <li><a href="logout">logout</a></li>
                <li><a href="profile">profile</a></li>

            <?php else: ?>
                <li><a href="register">Register</a></li>
                <li><a href="login">login</a></li>
            <?php endif; echo '<pre>'; var_dump($_SESSION); ?>
        </ul>
    </nav>
</wrapper>