<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Login Panel</h2>
        <form class="login-form" action="login_action.php" method="post">
            <input type="text" placeholder="username" name="txtUsername" required>
            <input type="password" placeholder="password" name="txtPassword" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>