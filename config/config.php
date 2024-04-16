<?php

define("SERVER", "localhost");
define("USER", "root");
define("PASSWORD", "password");
define("DBNAME", "portfolio");

$conn = new mysqli(SERVER, USER, PASSWORD, DBNAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
