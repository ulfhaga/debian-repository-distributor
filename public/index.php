<?php
require 'bootstrap.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Upload Debian package</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<h1>
    Upload Debian package
</h1>
<body>
<p>
    This is a link to upload Debian package <a href="repository.php">Debtoox repository</a>.
    <br>
    An example with the program Curl to upload a Debian package: <br>
    <code>
    file=hello_1.0.0-1_all.deb; <br>
    curl -X POST -H "Content-Type: multipart/form-data;"-F "suit=unstable" -F "repotype=contrib" -F "package=@${file}" -F "formatter=json"
    <?php
    $host = $_SERVER['HTTP_HOST'];
    echo "$host/upload.php"
    ?>
    </code>
</p>
</body>
</html>

