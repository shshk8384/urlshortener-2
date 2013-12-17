<?php
    $code = $_GET["code"];
    $url = "http://localhost/urlshortener/".$code; // Replace with the name of the domain
?>

<html>
    <head>
        <meta charset="utf-8"/>
        <title>URL Shortener</title>
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:100" type="text/css"/>
        <link rel="stylesheet" href="../style/style.css" type="text/css"/>
    </head>
    <body>
        <h1 class="title">URL Shortener</h1>
        <p class="subtitle">Your URL shortened is:</p>
        <input type="url" class="urlshortened" value="<?php echo $url; ?>">
    </body>
</html>