<?php
    /*
        api.php has the same code as shorten.php, but instead of calling header("location:...") we call echo to return
        the shortened URL. This is useful for clients like mobile apps.
    */

    $chars = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',
                   'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
                   '1','2','3','4','5','6','7','8','9','0'); // chars to encode the URL

    $url = $_GET["url"];
    
    if($url==null){
        echo "";
    }else{
        if(strcmp(substr($url, 0, 7), "http://")!=0){
            $url = "http://".$url."/";
        }
        
        $host="localhost"; // Host name 
        $username="shortener"; // Mysql username 
        $pass_db="5h0rt3n3r"; // Mysql password 
        $db_name="shortener"; // Database name
        
        mysql_connect("$host", "$username", "$pass_db")or die("cannot connect"); 
        mysql_select_db("$db_name")or die("cannot select DB");
        
        $mysql_result = mysql_query("SELECT * FROM url ORDER BY id DESC LIMIT 0, 1");
        
        if(!$mysql_result) 
            die("MySQL error: ".mysql_error());
        
        if($max_id_row = mysql_fetch_array($mysql_result)){
            $last_code = $max_id_row["code"];
            for($i=strlen($last_code)-1; $i>=0; $i--){
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
            
            echo "http://localhost/urlshortener/".$last_code;
        } else{
            $code = "a";
            $mysql_result = mysql_query("INSERT INTO url (code, url) VALUES ('$code', '$url')");
            
            if(!$mysql_result) 
                die("MySQL error: ".mysql_error());
            
            echo "http://localhost/urlshortener/".$code;
        }
    }
?>