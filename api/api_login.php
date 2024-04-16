<?php
include_once("../config/config.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'login') {
        $email = $_POST['email'];
        $pass = base64_encode($_POST['pass']);
        // id, email, password, about, experience, skills, contact, custom1, custom2, custom3
        $selectsql = "SELECT id, password from users where email = '$email';";
        $res = mysqli_query($conn, $selectsql);

        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($row['password'] == $pass) {
                setcookie("username", $email, time() + (21600), "/");
                setcookie("userid", $row['id'], time() + (21600), "/");
                echo json_encode(array("status" => "success", "msg" => "Successfully logged in"));
                return;
            } else {
                echo json_encode(array("status" => "unauthorized", "msg" => "Invalid username or password"));
                return;
            }
        } else {
            echo json_encode(array("status" => "failure", "msg" => "No user found"));
            return;
        }
    }
}
