<?php

global $pdo;
require_once '../login_system/PROPER_PHP_LogIN_SignUP_Form/includes/dbh.inc.php';
require_once '../login_system/PROPER_PHP_LogIN_SignUP_Form/includes/config_session.inc.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $snake_score = $_POST["snake_score"];
    $user_id = $_SESSION["user_id"];
    function get_snake_score(object $pdo, string $snake_score, int $user_id)
    {
        $query = "SELECT snake_score FROM scores WHERE user_id = :user_id;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;

    }

    function is_score_there(object $pdo, string $snake_score)
    {
        $user_id = $_SESSION['user_id'];
        if (get_snake_score($pdo, $snake_score, $user_id)) {
            return true;
        } else {
            return false;
        }
    }

    if (!is_score_there($pdo, $snake_score)) {
        $query = "INSERT INTO scores (user_id, snake_score) VALUES (:user_id, :snake_score)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":snake_score", $snake_score);
        $stmt->bindParam(":user_id", $user_id);

        $stmt->execute();
    } else {
        $query = "UPDATE scores SET snake_score = :snake_score WHERE user_id = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":snake_score", $snake_score);
        $stmt->bindParam(":user_id", $user_id);

        $stmt->execute();
    }

}
header('Location: ../snake/snake.php');
// update the snake score if it exists, insert if not

