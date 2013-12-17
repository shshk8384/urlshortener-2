<?php
    $param = $_GET["url"];
    
    /*
        If user wants to shorten a link $param will be null, then we show the web. Otherwise we search for the code
        of the shortened URL in the database, if we find a match we take the user to the desired URL.
    */
    if($param!=null){
        $host="localhost"; // Host name 
        $username="shortener"; // Mysql username 
        $pass_db="5h0rt3n3r"; // Mysql password 
        $db_name="shortener"; // Database name
        
        mysql_connect("$host", "$username", "$pass_db")or die("cannot connect"); 
        mysql_select_db("$db_name")or die("cannot select DB");
        
        $mysql_result = mysql_query("SELECT url FROM url WHERE code='$param'");
    
        if(!$mysql_result) 
            die("MySQL error: ".mysql_error());
        
        if($row = mysql_fetch_array($mysql_result))
            header("location:scripts/redirect.php?url=".$row["url"]);
    }
?>

<html>
    <head>
        <meta charset="utf-8"/>
        <title>URL Shortener</title>
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:100" type="text/css"/>
        <link rel="stylesheet" href="style/style.css" type="text/css"/>
    </head>
    <body>
        <h1 class="title">URL Shortener</h1>
        <p class="subtitle">Insert here your URL:</p>
        <form action="scripts/shorten.php" method="get">
            <ul>
                <li><input type="text" name="url" class="url"></li>
                <li><input type="submit" value="Shorten!" class="btn"></li>
            </ul>
            <div class="clear"></div>
        </form>
    </body>
</html>