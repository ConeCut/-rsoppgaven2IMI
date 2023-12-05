<?php

global $pdo;
require_once '../login_system/PROPER_PHP_LogIN_SignUP_Form/includes/dbh.inc.php';
require_once '../login_system/PROPER_PHP_LogIN_SignUP_Form/includes/config_session.inc.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $shooting_range_score = $_POST["shooter_score"];
    $user_id = $_SESSION["user_id"];
    function get_shooter_score(object $pdo, string $shooting_range_score, int $user_id)
    {
        $query = "SELECT shooting_range_score FROM scores WHERE user_id = :user_id;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;

    }

    function is_score_there(object $pdo, string $shooting_range_score)
    {
        $user_id = $_SESSION['user_id'];
        if (get_shooter_score($pdo, $shooting_range_score, $user_id)) {
            return true;
        } else {
            return false;
        }
    }

    if (!is_score_there($pdo, $shooting_range_score)) {
        $query = "INSERT INTO scores (user_id, shooting_range_score) VALUES (:user_id, :shooting_range_score)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":shooting_range_score", $shooting_range_score);
        $stmt->bindParam(":user_id", $user_id);

        $stmt->execute();
    } else {
        $query = "UPDATE scores SET shooting_range_score = :shooting_range_score WHERE user_id = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":shooting_range_score", $shooting_range_score);
        $stmt->bindParam(":user_id", $user_id);

        $stmt->execute();
    }

}
header('Location: ../shooter_game/shooting_range.html');
// update the cookie score if it exists, insert if not

