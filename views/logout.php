<?php

if (isset($_COOKIE['userid']) && isset($_COOKIE['username'])) {
    unset($_COOKIE['userid']); 
    unset($_COOKIE['username']); 
    setcookie('userid', '', -1, '/'); 
    setcookie('username', '', -1, '/'); 
    // return true;
    header("Location: ./login.php");
} else {
    return false;
}