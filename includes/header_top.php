<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <!-- font awesome CDN - start -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- font awesome CDN - END -->

    <!-- bootstrap CDN - start -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- bootstrap CDN - END -->

    <!-- JQuery CDN - start -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- JQuery CDN - END -->

    <!-- sweetalert cdn -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <link rel="stylesheet" href="../css/styles.css">

    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">

    <title>Sign up | Portfolify</title>
</head>

<body id="body-pd">
    <?php
    if (isset($_COOKIE['userid'])) {
    ?>
        <header class="header" id="header">
            <div class="header_toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>
            <div class="d-flex align-items-center">
                <?php
                echo $_COOKIE['username'];
                ?>
                <div class="header_img" style="align-items: center;">
                    <!-- <img src="https://i.imgur.com/hczKIze.jpg" alt=""> -->
                    <i class="fa-solid fa-user-large"></i>
                </div>
            </div>
        </header>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="#" class="nav_logo">
                        <!-- <i class='bx bx-layer nav_logo-icon'></i> -->
                        <i class="fa-solid fa-peseta-sign nav_logo-icon"></i>
                        <span class="nav_logo-name">Portfolify</span>
                    </a>
                    <div class="nav_list">
                        <a href="./home.php" class="nav_link active" id="h-p">
                        <!-- <a href="./home.php" class="nav_link active" id="home-page"> -->
                            <!-- <i class='bx bx-grid-alt '></i> -->
                            <i class="fa-solid fa-house nav_icon"></i>
                            <span class="nav_name">Home</span>
                        </a>
                        <a href="./templates.php" class="nav_link" id="t-p">
                        <!-- <a href="./templates.php" class="nav_link" id="templates-page"> -->
                            <!-- <i class='bx bx-user nav_icon'></i> -->
                            <i class="fa-solid fa-folder-open nav_icon"></i>
                            <span class="nav_name">My portfolios</span>
                        </a>
                        <a href="./info.php?update=true" class="nav_link" id="d-p">
                        <!-- <a href="./info.php?update=true" class="nav_link" id="details-page"> -->
                        <!-- <a href="./edit.php?update=true" class="nav_link"> -->
                            <i class='fa-solid fa-user-pen nav_icon'></i>
                            <span class="nav_name">Update details</span>
                        </a>
                    </div>
                </div>
                <a href="./logout.php" class="nav_link">
                    <i class='bx bx-log-out nav_icon'></i>
                    <span class="nav_name">SignOut</span>
                </a>
            </nav>
        </div>
        <script>
            const homePage = document.getElementById("h-p")
            const templatesPage = document.getElementById("t-p")
            const detailsPage = document.getElementById("d-p")
        </script>
    <?php
    }
    ?>