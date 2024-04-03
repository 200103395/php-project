<?php
    session_start();
    $logged = false;
    $login = null;
    if( isset($_SESSION["login"])) {
        $login = $_SESSION["login"];
        $logged = true;
    }

