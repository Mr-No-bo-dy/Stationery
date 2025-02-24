<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>ERROR #404</h1>
    <p><?= $error ?></p>
    <?php if (preg_match('#^/?sportsware/admin#i', $_SERVER['REQUEST_URI'])) { ?>
        <p><a href="../home">Return to main page</a></p>
    <?php } else { ?>
        <p><a href="home">Return to main page</a></p>
    <?php } ?>
</body>
</html>