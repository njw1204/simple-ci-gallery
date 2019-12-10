<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/static/css/reboot.css">
    <link rel="stylesheet" href="/static/css/main.css">
    <title>Sign up</title>
</head>

<body>
    <div class="form-body">
        <div class="card">
            <h1 class="form-title"><a href="/">CI Gallery</a></h1>
            <form class="form" method="POST">
                <input type="text" name="username" placeholder="Username" maxlength="100" required>
                <input type="password" name="password" placeholder="Password" maxlength="100" required>
                <input type="password" name="password2" placeholder="Confirm Password" maxlength="100" required>
                <button type="submit">Sign up</button>
            </form>
        </div>
    </div>
    <?php include "util/message.php" ?>
</body>

</html>
