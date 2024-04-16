<?php
include_once("../config/config.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'signup') {
        $email = $_POST['email'];
        $pass = base64_encode($_POST['pass']);
        // id, email, password, about, experience, skills, contact, custom1, custom2, custom3
        $sql = "INSERT into users (email, password) VALUES ('$email', '$pass')";
        if (mysqli_query($conn, $sql)) {
            // Registration successful
            $last_id = mysqli_insert_id($conn);
            setcookie("username", $email, time() + (21600), "/");
            setcookie("userid", $last_id, time() + (21600), "/");
            echo json_encode(array("status" => "success", "msg" => "Registration success"));
            return;
        } else {
            // Error handling
            echo json_encode(array("status" => "failure", "msg" => "Could not register. Please try after some time", "error" => mysqli_error($conn)));
            return;
        }
    }
}
