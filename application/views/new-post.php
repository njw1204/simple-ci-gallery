<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/static/css/reboot.css">
    <link rel="stylesheet" href="/static/css/main.css">
    <title>Create new post</title>
</head>

<body>
    <div class="form-body">
        <div class="card">
            <h1 class="form-title"><a href="/">CI Gallery</a></h1>
            <form class="form" method="POST" enctype="multipart/form-data">
                <label for="file">Upload your photo</label>
                <input type="file" id="file" name="file" accept=".gif, .jpg, .png" required>
                <textarea name="description" rows="10" maxlength="100" placeholder="Describe about your photo..." required></textarea>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
    <?php include "util/message.php" ?>
</body>

</html>
