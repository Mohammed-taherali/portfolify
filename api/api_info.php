<?php
include_once("../config/config.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'savedetails') {
        $about = isset($_POST['about']) ? json_encode($_POST['about']) : "";
        $experience = isset($_POST['experience']) ? json_encode($_POST['experience']) : json_encode(array());
        $education = isset($_POST['education']) ? json_encode($_POST['education']) : json_encode(array());
        $skills = isset($_POST['skills']) ? json_encode($_POST['skills']) : json_encode(array());
        $socials = isset($_POST['socials']) ? json_encode($_POST['socials']) : json_encode(array());
        $projects = isset($_POST['projects']) ? json_encode($_POST['projects']) : json_encode(array());

        //escape the data
        $about = mysqli_real_escape_string($conn, $about);
        $experience = mysqli_real_escape_string($conn, $experience);
        $education = mysqli_real_escape_string($conn, $education);
        $skills = mysqli_real_escape_string($conn, $skills);
        $socials = mysqli_real_escape_string($conn, $socials);
        $projects = mysqli_real_escape_string($conn, $projects);

        $user_id = $_COOKIE['userid'];
        $first = true;

        $sql = "UPDATE users set ";
        if ($about != "") {
            $first = false;
            $sql .= " about = '$about'";
        }

        if (!$first && $experience) {
            $sql .= ", experience = '$experience'";   
        } else if ($first && $experience) {
            $first = false;
            $sql .= " experience = '$experience' ";   
        }
        
        if (!$first && $education) {
            $sql .= ", education = '$education'";   
        } else if ($first && $education) {
            $first = false;
            $sql .= " education = '$education' ";   
        }

        if (!$first && $skills) {
            $sql .= ", skills = '$skills'";   
        } else if ($first && $skills) {
            $first = false;
            $sql .= " skills = '$skills'";   
        }

        if (!$first && $socials) {
            $sql .= ", socials = '$socials'";   
        } else if ($first && $socials) {
            $first = false;
            $sql .= " socials = '$socials'";   
        }

        if (!$first && $projects) {
            $sql .= ", projects = '$projects'";   
        } else if ($first && $projects) {
            $first = false;
            $sql .= " projects = '$projects'";   
        }

        $sql .= " where id = $user_id;";

        // $sql = "UPDATE users set about = '$about', experience = '$experience', education = '$education', skills = '$skills', socials = '$socials', projects = '$projects' where id = $user_id;";
        // echo $sql;

        if (mysqli_query($conn, $sql)) {
            // Registration successful
            echo json_encode(array("status" => "success", "msg" => "Registration success"));
            return;
        } else {
            // Error handling
            echo json_encode(array("status" => "failure", "msg" => "Could not register. Please try after some time", "error" => mysqli_error($conn)));
            return;
        }
    }
}
