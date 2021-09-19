<?php
    $pdo = new PDO('mysql:host=localhost;dbname=pixels26_db_blog', 'pixels26_pixel', 'Gabriel@38099163');
    $pdo->exec("set names utf8");