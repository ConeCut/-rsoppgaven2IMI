<?php

global $pdo;
require_once '../login_system/PROPER_PHP_LogIN_SignUP_Form/includes/dbh.inc.php';
require_once '../login_system/PROPER_PHP_LogIN_SignUP_Form/includes/config_session.inc.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $cookie_score = $_POST["cookie_score"];
    $user_id = $_SESSION["user_id"];
    function get_cookie_score(object $pdo, string $cookie_score, int $user_id)
    {
        $query = "SELECT cookie_score FROM scores WHERE user_id = :user_id;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;

    }

    function is_score_there(object $pdo, string $cookie_score)
    {
        $user_id = $_SESSION['user_id'];
        if (get_cookie_score($pdo, $cookie_score, $user_id)) {
            return true;
        } else {
            return false;
        }
    }

    if (!is_score_there($pdo, $cookie_score)) {
        $query = "INSERT INTO scores (user_id, cookie_score) VALUES (:user_id, :cookie_score)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":cookie_score", $cookie_score);
        $stmt->bindParam(":user_id", $user_id);

        $stmt->execute();
    } else {
        $query = "UPDATE scores SET cookie_score = :cookie_score WHERE user_id = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":cookie_score", $cookie_score);
        $stmt->bindParam(":user_id", $user_id);

        $stmt->execute();
    }

}
header('Location: ../cookie_clicker/cookie_clicker.php');
// update the cookie score if it exists, insert if not

