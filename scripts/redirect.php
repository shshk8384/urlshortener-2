<?php
    $url = $_GET["url"];
    
    if($url!=null){
        header("location:".$url);
    } else{
        header("location:..");
    }
?>