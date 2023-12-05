<?php

session_start();
session_unset();
session_destroy();

header("Location: ../login_signup_form.php");
die();
