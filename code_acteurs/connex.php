<?php
    $servername = '127.0.0.1';
    $username = 'root';
    $password = '';
    $dbname = 'edl_acteurs';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);