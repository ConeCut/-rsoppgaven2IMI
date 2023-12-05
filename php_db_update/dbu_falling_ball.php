<?php

global $pdo;
require_once '../login_system/PROPER_PHP_LogIN_SignUP_Form/includes/dbh.inc.php';
require_once '../login_system/PROPER_PHP_LogIN_SignUP_Form/includes/config_session.inc.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $falling_ball_score = $_POST["falling_score"];
    $user_id = $_SESSION["user_id"];
    function get_falling_score(object $pdo, string $falling_ball_score, int $user_id)
    {
        $query = "SELECT falling_ball_score FROM scores WHERE user_id = :user_id;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;

    }

    function is_score_there(object $pdo, string $falling_ball_score)
    {
        $user_id = $_SESSION['user_id'];
        if (get_falling_score($pdo, $falling_ball_score, $user_id)) {
            return true;
        } else {
            return false;
        }
    }

    if (!is_score_there($pdo, $falling_ball_score)) {
        $query = "INSERT INTO scores (user_id, falling_ball_score) VALUES (:user_id, :falling_ball_score)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":falling_ball_score", $falling_ball_score);
        $stmt->bindParam(":user_id", $user_id);

        $stmt->execute();
    } else {
        $query = "UPDATE scores SET falling_ball_score = :falling_ball_score WHERE user_id = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":falling_ball_score", $falling_ball_score);
        $stmt->bindParam(":user_id", $user_id);

        $stmt->execute();
    }

}
header('Location: ../falling_ball/falling_ball_game.php');
die();
// update the cookie score if it exists, insert if not

