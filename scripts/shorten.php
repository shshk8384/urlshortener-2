<?php
    $chars = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',
                   'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
                   '1','2','3','4','5','6','7','8','9','0'); // chars to encode the URL

    $url = $_GET["url"];
    
    if($url==null){
        header("location:..");
    }
    
    // We have to use URL as "http://domain/", to avoid using them as a local path when using header("location:...")
    if(strcmp(substr($url, 0, 7), "http://")!=0){
        $url = "http://".$url."/";
    }
    
    $host="localhost"; // Host name 
    $username="shortener"; // Mysql username 
    $pass_db="5h0rt3n3r"; // Mysql password 
    $db_name="shortener"; // Database name
    
    mysql_connect("$host", "$username", "$pass_db")or die("cannot connect"); 
    mysql_select_db("$db_name")or die("cannot select DB");
    
    $mysql_result = mysql_query("SELECT * FROM url ORDER BY id DESC LIMIT 0, 1"); // We get the id of the last URL in the database
    
    if(!$mysql_result) 
        die("MySQL error: ".mysql_error());
    
    if($max_id_row = mysql_fetch_array($mysql_result)){ // If there's at least one row in the database...
        $last_code = $max_id_row["code"];
        for($i=strlen($last_code)-1; $i>=0; $i--){ // We set the next code to the new URL
            $n = array_search($last_code[$i], $chars)+1;
            if($n==62){
                $last_code[$i] = 'a';
                if($i==0){
                    $last_code = 'a'.$last_code;
                }
            }
            else{
                $last_code[$i] = $chars[$n];
                break;
            }
        }
        
        $mysql_result = mysql_query("INSERT INTO url (code, url) VALUES ('$last_code', '$url')");
        
        if(!$mysql_result) 
            die("MySQL error: ".mysql_error());
        
        header("location:shortened.php?code=".$last_code); // We take the user to shortened.php to show the shortened URL
    } else{ // If there isn't any row in the database we create the first row (code a)
        $code = "a";
        $mysql_result = mysql_query("INSERT INTO url (code, url) VALUES ('$code', '$url')");
        
        if(!$mysql_result) 
            die("MySQL error: ".mysql_error());
        
        header("location:shortened.php?code=a");
    }
?>