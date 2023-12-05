<?php

$host = 'localhost';
$dbname = 'hog_users_db';
$dbusername = 'root';
$dbpassword = 'Admin';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    die('Connection failed: ' . $e->getMessage());
}