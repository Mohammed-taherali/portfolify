<?php

if (isset($_COOKIE['username'])) {
    header("Location: ./views/home.php");
} else {
    header("Location: ./views/login.php");
}
