<?php
    try
    {
        $pdo = new PDO("mysql:host=localhost;dbname=tech-news;charset=utf8","root","");

    }
    catch(PDOException $e)
    {
        die('erreur : '.$e->getMessage());
    }



?>