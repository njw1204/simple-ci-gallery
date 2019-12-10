<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/static/css/reboot.css">
    <link rel="stylesheet" href="/static/css/main.css">
    <title>Index</title>
</head>

<body>
    <div class="container">
        <header class="gallery-header">
            <h1 class="gallery-title"><a href="/">CI Gallery</a></h1>
            <?php if (isset($user) && $user): ?>
                <strong class="username"><?= htmlspecialchars($user->username) ?></strong>
                <a href="/new-post"><button class="top-menu-button" type="button">New Post</button></a>
                <a href="/logout"><button class="top-menu-button" type="button">Logout</button></a>
            <?php else: ?>
                <a href="/login"><button class="top-menu-button" type="button">Login</button></a>
                <a href="/signup"><button class="top-menu-button" type="button">Sign up</button></a>
            <?php endif; ?>
        </header>

        <?php foreach ($posts as $post): ?>
            <article class="responsive">
                <?php if (isset($user) && $user && $user->id === $post->user_id): ?>
                    <form method="POST" action="/remove-post">
                        <input type="hidden" name="post_id" value="<?= $post->id ?>">
                        <button class="gallery-remove-button" type="submit">X</button>
                    </form>
                <?php endif; ?>
                <div class="gallery">
                    <div class="gallery-image">
                        <a target="_blank" href="<?= htmlspecialchars($post->photo_url) ?>">
                            <img src="<?= htmlspecialchars($post->photo_url) ?>" alt="Image">
                        </a>
                    </div>
                    <div class="desc"><?= htmlspecialchars($post->description) ?></div>
                </div>
            </article>
        <?php endforeach; ?>

        <div class="clearfix"></div>
    </div>
    <?php include "util/message.php" ?>
</body>

</html>
