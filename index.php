<?php
require_once 'login_system/PROPER_PHP_LogIN_SignUP_Form/includes/config_session.inc.php';
require_once 'login_system/PROPER_PHP_LogIN_SignUP_Form/includes/signup_view.inc.php';
require_once 'login_system/PROPER_PHP_LogIN_SignUP_Form/includes/login_view.inc.php';
?>

<!DOCTYPE html>
<html class="index_html" lang="en">
<head>
    <link href="snake/style.css" type="text/css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Hall Of Games</title>
</head>
<body class="index_body">
<h1>WELCOME to the Hall of Games</h1>
<h2 style="text-align: center">
<?php

output_username();

?>
</h2>
<h2>(The Hall of Games is still a project under development)</h2>
<div class="mainContainer">
<div class="gameContainer" id="game1" onclick="window.location.href='shooter_game/shooting_range.html'"></div>
<div class="gameContainer" id="game2" onclick="window.location.href='falling_ball/falling_ball_game.php'"></div>
<div class="gameContainer" id="game3" onclick="window.location.href='Car_Game/car_racing.html'"></div>
</div>
<div class="mainContainer" style="margin-top: 8vh;">
    <div class="gameContainer" id="game4" onclick="window.location.href='snake/snake.php'" style="background-image: url('https://www.coolmathgames.com/sites/default/files/Snake_OG-logo.jpg'); background-size: cover; background-repeat: no-repeat"></div>
    <div class="gameContainer" id="game5" onclick="window.location.href='cookie_clicker/cookie_clicker.php'" style="background-image: url('cookie_clicker/Cookie_Main.png'); background-size: contain;"></div>
</div>

<script src="snake/script.js"></script>
</body>
</html>