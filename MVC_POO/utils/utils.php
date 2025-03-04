<?php

    function connect(){
        $bdd= new PDO("mysql:host=localhost; dbname=usersV2","root",'',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $bdd;
    }

    function sanitize($data){
        return htmlentities(strip_tags(stripslashes(trim($data))));
    }
    
?>