<?php

declare(strict_types=1);


// All you need to do to check if user is logged in is to use an if function to see if the session ID is set or not, then you can freely change contents on the website
function output_username(){
    if (isset($_SESSION["user_id"])){
        echo "Your are logged in as " . $_SESSION["user_username"];
    } else{
        echo "You are not logged in!";
    }
}

function check_login_errors(){
    if (isset($_SESSION["errors_login"])){
        $errors = $_SESSION["errors_login"];

        echo '<br>';

        foreach ($errors as $error){
            echo '<p class="form-error">' . $error . '</p>';
        }

        unset($_SESSION["errors_login"]);
    }
    else if (isset($_GET['login']) && $_GET['login'] === 'success'){

    }
}