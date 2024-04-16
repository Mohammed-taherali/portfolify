<?php
include_once("../config/config.php");

function removeDir(string $dir): void
{
    $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
    $files = new RecursiveIteratorIterator(
        $it,
        RecursiveIteratorIterator::CHILD_FIRST
    );
    foreach ($files as $file) {
        if ($file->isDir()) {
            rmdir($file->getPathname());
        } else {
            unlink($file->getPathname());
        }
    }
    rmdir($dir);
}

function createZipFolder()
{
    $zipName = "Resume.zip";
    // Get real path for our folder
    if (isset($_GET['template'])) {
        $user_id = $_COOKIE['userid'];
        $template = $_GET['template'];
        $rootPath = realpath("../users/$user_id/$template");
    } else {
        $rootPath = realpath('../temporary');
    }

    // Initialize archive object
    $zip = new ZipArchive();
    $zip->open($zipName, ZipArchive::CREATE | ZipArchive::OVERWRITE);

    // Create recursive directory iterator
    /** @var SplFileInfo[] $files */
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($rootPath),
        RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $file) {
        // Skip directories (they would be added automatically)
        if (!$file->isDir()) {
            // Get real and relative path for current file
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($rootPath) + 1);

            // Add current file to archive
            $zip->addFile($filePath, $relativePath);
        }
    }

    // Zip archive will be created only after closing object
    $zip->close();

    # send the file to the browser as a download
    header('Content-type: application/zip');
    header("Content-disposition: attachment; filename=$zipName");
    header("Content-Length: " . filesize($zipName));
    ob_clean();
    readfile($zipName);

    if (!isset($_GET['template'])) {
        removeDir("../temporary");
    }

    // ########### Old version ###########
    // # create new zip opbject
    // $zip = new ZipArchive();

    // # create a temp file & open it
    // $tmp_file = tempnam('.', '');
    // unlink($tmp_file);
    // $zip->open($tmp_file, ZipArchive::CREATE);

    // # loop through each file
    // foreach ($files as $file) {

    //     # download file
    //     $download_file = file_get_contents($file);
    //     // echo "file: " . $file. "\n\n\n contents: \n\n\n\n". $download_file;

    //     #add it to the zip
    //     $zip->addFromString(pathinfo($file, PATHINFO_BASENAME), $download_file);
    //     // $zip->addFromString(basename($file), $download_file);
    // }

    // # close zip
    // $zip->close();

    // # send the file to the browser as a download
    // header('Content-type: application/zip');
    // header('Content-disposition: attachment; filename=Resumes.zip');
    // header("Content-Length: " . filesize($tmp_file));
    // ob_clean();
    // // ob_end_flush();
    // readfile($tmp_file);
    // exit;
}

function copyDirectory($source, $destination, &$file_list)
{
    if (!is_dir($destination)) {
        mkdir($destination, 0755, true);
    }
    $files = scandir($source);
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            $sourceFile = $source . '/' . $file;
            $destinationFile = $destination . '/' . $file;
            if (is_dir($sourceFile)) {
                copyDirectory($sourceFile, $destinationFile, $file_list);
            } else {
                copy($sourceFile, $destinationFile);
                $file_list[] = $destinationFile;
            }
        }
    }
}

function saveProjImages()
{
    // echo json_encode($_POST['images']);
    $user_id = $_COOKIE['userid'];
    $images = $_POST['images'];
    $base_path = $_POST['base_path'];
    $abs_path = $_POST['abs_path'];
    $temp_id = $_POST['temp_id'];
    $imgCnt = 0;
    foreach ($images as $img) {
        if ($img != "") {
            $imgCnt++;
            file_put_contents($base_path . "p" . $imgCnt . ".jpg", base64_decode($img));
            file_put_contents("../users/" . $user_id . "/temp" . $temp_id . "/" . $abs_path . "p" . $imgCnt . ".jpg", base64_decode($img));
        }
    }
    echo json_encode(array("status" => "success"));
}

function generate_portfolio_1()
{
}

function generate_portfolio_2()
{
    $user_id = $_COOKIE['userid'];
    global $conn;
    $img = $_POST['img'];
    // $facebook = $_POST['facebook'];
    // $twitter = $_POST['twitter'];
    // $linkedin = $_POST['linkedin'];
    // $github = $_POST['github'];

    $sql = "SELECT email, about, experience, skills, education, socials from users where id=$user_id";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);

        $about = $row['about'] != "" ? json_decode($row['about']) : "";
        $education = $row['education'] != "" ? json_decode($row['education']) : "";
        $experience = $row['experience'] != "" ? json_decode($row['experience']) : "";
        $skills = $row['skills'] != "" ? json_decode($row['skills']) : "";
        $socials = $row['socials'] != "" ? json_decode($row['socials']) : "";

        $temp = "
            <!DOCTYPE html>
            <html lang='en'>

              <head>

                <meta charset='utf-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
                <meta name='description' content=''>
                <meta name='author' content=''>

                <title></title>
                <link href='https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:100,200,300,400,500,600,700,800,900' rel='stylesheet'>
                <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i' rel='stylesheet'>
                <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css' integrity='sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==' crossorigin='anonymous' referrerpolicy='no-referrer' />
                <link rel='stylesheet'
                        href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.min.css'
                        integrity='sha512-ZbJOe0eaEsNwXGE3U+k2NrTAb/jIp8vqEYBADqvTMjYdpPzoAlgySX705E0WESDAs49YIMFd4lZGqf9qARbV7w=='
                        crossorigin='anonymous' referrerpolicy='no-referrer' />
                <link href='css/resume.min.css' rel='stylesheet'>

              </head>

              <body id='page-top'>

                <nav class='navbar navbar-expand-lg navbar-dark bg-primary fixed-top' id='sideNav'>
                  <a class='navbar-brand js-scroll-trigger' href='#page-top'>
                    <span class='d-block d-lg-none'>$about->fname $about->lname</span>
                    <span class='d-none d-lg-block'>
                      <img class='img-fluid img-profile rounded-circle mx-auto mb-2' src='./img/user.jpg' alt=''>
                    </span>
                  </a>
                  <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                  </button>
                  <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                    <ul class='navbar-nav'>
                      <li class='nav-item'>
                        <a class='nav-link js-scroll-trigger' href='#about'>About</a>
                      </li>
                      <li class='nav-item'>
                        <a class='nav-link js-scroll-trigger' href='#experience'>Experience</a>
                      </li>
                      <li class='nav-item'>
                        <a class='nav-link js-scroll-trigger' href='#education'>Education</a>
                      </li>
                      <li class='nav-item'>
                        <a class='nav-link js-scroll-trigger' href='#skills'>Skills</a>
                      </li>
                    </ul>
                  </div>
                </nav>

                <div class='container-fluid p-0'>
                <section class='resume-section p-3 p-lg-5 d-flex d-column' id='about'>
                    <div class='my-auto'>
                        <h1 class='mb-0'>$about->fname
                        <span class='text-primary'>$about->lname</span>
                        </h1>
                        <div class='subheading mb-5'>$about->street · $about->city, $about->state $about->pincode · $about->contact ·
                        <a href='mailto:$row[email]'> $row[email] </a>
                        </div>
                        <p class='mb-5' style='white-space: pre-line'> $about->aboutMe </p>
                        <ul class='list-inline list-social-icons mb-0'>
                        ";
        if (isset($socials->facebook) && $socials->facebook != "") {
            $temp .= "
                            <li class='list-inline-item'>
                                <a href='$socials->facebook'>
                                <span class='fa-stack fa-lg'>
                                    <i class='fa fa-circle fa-stack-2x'></i>
                                    <i class='fab fa-facebook fa-stack-1x fa-inverse'></i>
                                </span>
                                </a>
                            </li>
                        ";
        }
        if (isset($socials->twitter) && $socials->twitter != "") {
            $temp .= "
                            <li class='list-inline-item'>
                                <a href='$socials->twitter'>
                                <span class='fa-stack fa-lg'>
                                    <i class='fa fa-circle fa-stack-2x'></i>
                                    <i class='fab fa-twitter fa-stack-1x fa-inverse'></i>
                                </span>
                                </a>
                            </li>
                            ";
        }
        if (isset($socials->linkedin) && $socials->linkedin != "") {
            $temp .= "
                            <li class='list-inline-item'>
                                <a href='$socials->linkedin'>
                                <span class='fa-stack fa-lg'>
                                    <i class='fa fa-circle fa-stack-2x'></i>
                                    <i class='fab fa-linkedin fa-stack-1x fa-inverse'></i>
                                </span>
                                </a>
                            </li>
                            ";
        }
        if (isset($socials->github) && $socials->github != "") {
            $temp .= "
                            <li class='list-inline-item'>
                                <a href='$socials->github'>
                                <span class='fa-stack fa-lg'>
                                    <i class='fa fa-circle fa-stack-2x'></i>
                                    <i class='fab fa-github fa-stack-1x fa-inverse'></i>
                                </span>
                                </a>
                            </li>
                ";
        }

        $temp .= "
                        </ul>
                    </div>
                </section>
            ";
        // about section end

        // experience section start
        $expSection = "
            <section class='resume-section p-3 p-lg-5 d-flex flex-column' id='experience'>
                <div class='my-auto'>
                    <h2 class='mb-5'>Experience</h2>
            ";
        foreach ($experience as $exp) {
            $start = date('M Y', strtotime($exp->startDate));
            if ($exp->endDate !== "present") {
                $end = date('M Y', strtotime($exp->endDate));
            } else {
                $end = "Present";
            }
            $expDiv = "
                <div class='resume-item d-flex flex-column flex-md-row mb-5'>
                    <div class='resume-content mr-auto'>
                        <h3 class='mb-0'>$exp->jobProfile</h3>
                        <div class='subheading mb-3'>$exp->company</div>
                        <p style='white-space: pre-line'>$exp->summ</p>
                    </div>
                    <div class='resume-date text-md-right'>
                        <span class='text-primary'>$start - $end</span>
                    </div>
                </div>
                ";

            $expSection .= $expDiv;
        }
        $expSection .= "
                </div>
            </section>
            ";

        $temp .= $expSection;
        // experience section end

        // education section start
        $eduSection = "
            <section class='resume-section p-3 p-lg-5 d-flex flex-column' id='education'>
                <div class='my-auto'>
                    <h2 class='mb-5'>Education</h2>
            ";
        foreach ($education as $edu) {
            $start = date('M Y', strtotime($edu->startDate));
            $end = date('M Y', strtotime($edu->endDate));
            $eduDiv = "
                <div class='resume-item d-flex flex-column flex-md-row mb-5'>
                    <div class='resume-content mr-auto'>
                        <h3 class='mb-0'>$edu->university</h3>
                        <div class='subheading mb-3'>$edu->degree</div>
                        <p>Percentage / GPA: $edu->perc</p>
                    </div>
                    <div class='resume-date text-md-right'>
                        <span class='text-primary'>$start - $end</span>
                    </div>
                </div>
                ";

            $eduSection .= $eduDiv;
        }
        $eduSection .= "
                </div>
            </section>
            ";

        $temp .= $eduSection;
        // education section end

        // skills section - start
        $skillSection = "
            <section class='resume-section p-3 p-lg-5 d-flex flex-column' id='skills'>
                <div class='my-auto'>
                    <h2 class='mb-5'>Skills</h2>

                    <div class='subheading mb-3'>Programming Languages &amp; Tools</div>
                    <div class='row'>
            ";
        foreach ($skills as $skill) {
            $skillSection .= "<div class='col-md-3 col-lg-3 mb-3'>$skill</div>";
        }
        $skillSection .= "
                    </div>
                </div>
            </section>
            ";

        $temp .= $skillSection;
        // skills section - end

        $temp .= "
                    </div>
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'
                        integrity='sha512-3P8rXCuGJdNZOnUx/03c1jOTnMn3rP63nBip5gOP2qmUh5YAdVAvFZ1E+QLZZbC1rtMrQb+mah3AfYW11RUrWA=='
                        crossorigin='anonymous' referrerpolicy='no-referrer'></script>
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/js/bootstrap.bundle.min.js'
                        integrity='sha512-iK40H6FrXMa4VY6I6y2MHnzDCcMibPQD3mwT/3+7M1YrkW4uvTLDEzjFva0c0qyuEbWG/13obA6bIomIaySdcQ=='
                        crossorigin='anonymous' referrerpolicy='no-referrer'></script>
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'
                        integrity='sha512-ahmSZKApTDNd3gVuqL5TQ3MBTj8tL5p2tYV05Xxzcfu6/ecvt1A0j6tfudSGBVuteSoTRMqMljbfdU0g2eDNUA=='
                        crossorigin='anonymous' referrerpolicy='no-referrer'></script>
                    <script src='js/resume.min.js'></script>
                </body>
            </html>
            ";

        $sourceDirectory = '../templates/temp2';
        $destinationDirectory = '../temporary';
        $files = array();
        copyDirectory($sourceDirectory, $destinationDirectory, $files);
        file_put_contents("../temporary/index.html", $temp);
        
        if ($img != "") {
            file_put_contents("../temporary/img/user.jpg", base64_decode($img));
        }
        $files_2 = array();
        $dest_for_users = "../users/" . $user_id . "/temp2";
        copyDirectory("../temporary", $dest_for_users , $files_2);

        echo json_encode(array("status" => "success"));

        // createZipFolder($files);
    }
}

function generate_portfolio_3()
{
}

function generate_portfolio_4()
{
}

function generate_portfolio_5()
{
    $user_id = $_COOKIE['userid'];
    $current_desig = $_POST['desig'];
    $dob = $_POST['dob'];
    $formattedDate = "";
    if ($dob && $dob != "") {
        $timestamp = strtotime($dob);
        $formattedDate = date('d F Y', $timestamp);
    }
    $skillData = $_POST['skills'];
    global $conn;
    $img = $_POST['img'];

    $sql = "SELECT email, about, experience, skills, education, socials from users where id=$user_id";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $email = $row['email'];
        $about = $row['about'] != "" ? json_decode($row['about']) : "";
        $education = $row['education'] != "" ? json_decode($row['education']) : "";
        $experience = $row['experience'] != "" ? json_decode($row['experience']) : "";
        $skills = $row['skills'] != "" ? json_decode($row['skills']) : "";
        $socials = $row['socials'] != "" ? json_decode($row['socials']) : "";

        $temp = "
            <!doctype html>
            <html lang='en'>

            <head>
                <meta charset='utf-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
                <link rel='icon' href='img/favicon.png' type='image/png'>
                <title>MeetMe Personal</title>
                <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'
                    integrity='sha512-iQQV+nXtBlmS3XiDrtmL+9/Z+ibux+YuowJjI4rcpO7NYgTzfTOiFNm09kWtfZzEB9fQ6TwOVc8lFVWooFuD/w=='
                    crossorigin='anonymous' referrerpolicy='no-referrer' />
                <link rel='stylesheet' href='vendors/linericon/style.css'>
                <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css'
                    integrity='sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=='
                    crossorigin='anonymous' referrerpolicy='no-referrer' />
                <link rel='stylesheet' href='css/style.css'>
                <link rel='stylesheet' href='css/responsive.css'>
            </head>

            <body>
                <header class='header_area'>
                    <div class='main_menu'>
                        <nav class='navbar navbar-expand-lg navbar-light'>
                            <div class='container box_1620'>
                                <a class='navbar-brand logo_h custom-title' href='index.html'>
                                    $about->fname
                                </a>
                                <button class='navbar-toggler' type='button' data-toggle='collapse'
                                    data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent'
                                    aria-expanded='false' aria-label='Toggle navigation'>
                                    <span class='icon-bar'></span>
                                    <span class='icon-bar'></span>
                                    <span class='icon-bar'></span>
                                </button>
                                <div class='collapse navbar-collapse offset' id='navbarSupportedContent'>
                                    <ul class='nav navbar-nav menu_nav ml-auto'>
                                        <li class='nav-item'><a class='nav-link' onclick='scrollToSection(\"about\")'>About</a></li>
                                        <li class='nav-item'><a class='nav-link' onclick='scrollToSection(\"education\")'>Education</a></li>
                                        <li class='nav-item'><a class='nav-link' onclick='scrollToSection(\"projects\")'>Projects</a></li>
                                        <li class='nav-item'><a class='nav-link' onclick='scrollToSection(\"experience\")'>Experience</a></li>
                                        <li class='nav-item'><a class='nav-link' onclick='scrollToSection(\"contact\")'>Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </header>

                <section class='home_banner_area'>
                    <div class='container box_1620'>
                        <div class='banner_inner d-flex align-items-center'>
                            <div class='banner_content'>
                                <div class='media'>
                                    <div class='d-flex' style='width: 50%'>
                                        <img src='img/personal.jpg' alt='' style='width: 100%'>
                                    </div>
                                    <div class='media-body'>
                                        <div class='personal_text'>
                                            <h6>Hello Everybody, i am</h6>
                                            <h3>$about->fname $about->lname</h3>
                                            <h4>$current_desig</h4>
                                            <ul class='list basic_info'>
                                                <li><a href='#'><i class='lnr lnr-calendar-full'></i> $formattedDate</a></li>
                                                <li><a href='#'><i class='lnr lnr-phone-handset'></i> $about->contact</a></li>
                                                <li><a href='#'><i class='lnr lnr-envelope'></i> $email</a></li>
                                                <li><a href='#'><i class='lnr lnr-home'></i> $about->city $about->state $about->pincode</a></li>
                                            </ul>
                                            <ul class='list personal_social'>

        ";

        if (isset($socials->facebook) && $socials->facebook != "") {
            $temp .= "<li><a href='$socials->facebook'><i class='fab fa-facebook'></i></a></li>";
        }
        if (isset($socials->instagram) && $socials->instagram != "") {
            $temp .= "<li><a href='$socials->instagram'><i class='fab fa-instagram'></i></a></li>";
        }
        if (isset($socials->twitter) && $socials->twitter != "") {
            $temp .= "<li><a href='$socials->twitter'><i class='fab fa-twitter'></i></a></li>";
        }
        if (isset($socials->linkedin) && $socials->linkedin != "") {
            $temp .= "<li><a href='$socials->linkedin'><i class='fab fa-linkedin'></i></a></li>";
        }
        if (isset($socials->github) && $socials->github != "") {
            $temp .= "<li><a href='$socials->github'><i class='fab fa-github'></i></a></li>";
        }

        $temp .= "
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
        ";

        // about section start
        $aboutSection = "
            <section class='welcome_area p_120' id='about'>
                <div class='container'>
                    <div class='row welcome_inner'>
                        <div class='col-lg-6'>
                            <div class='welcome_text'>
                                <h4>About Myself</h4>
                                <p>$about->aboutMe</p>
                            </div>
                        </div>
                        <div class='col-lg-6'>
                            <div class='tools_expert'>
                                <div class='skill_main'>
        ";

        foreach ($skillData as $skill) {
            $aboutSection .= "
                <div class='skill_item'>
                    <h4>$skill[skill] <span class='counter'>$skill[value]</span>%</h4>
                    <div class='progress_br'>
                        <div class='progress'>
                            <div class='progress-bar' role='progressbar' aria-valuenow='$skill[value]'
                                aria-valuemin='0' aria-valuemax='100'></div>
                        </div>
                    </div>
                </div>
            ";
        }

        $aboutSection .= "
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        ";

        $temp .= $aboutSection;
        // about section end

        // education section starts

        $eduSection = "
            <section class='mytabs_area p_120' id='education'>
                <div class='container'>
                    <div class='tabs_inner'>
                        <ul class='nav nav-tabs' id='myTab' role='tablist'>
                            <li class='nav-item'>
                                <a class='nav-link active' id='profile-tab' data-toggle='tab' href='#profile' role='tab'
                                    aria-controls='profile' aria-selected='false'>My Education</a>
                            </li>
                        </ul>
                        <div class='tab-content' id='myTabContent'>
                            <div class='tab-pane fade show active' id='profile' role='tabpanel' aria-labelledby='profile-tab'>
                                <ul class='list'>
        ";

        foreach ($education as $eduData) {
            $start = strtotime($eduData->startDate);
            $end = strtotime($eduData->endDate);
            $start = date('F Y', $start);
            $end = date('F Y', $end);
            $eduSection .= "
                <li>
                    <span></span>
                    <div class='media'>
                        <div class='d-flex'>
                            <p>$start to $end</p>
                        </div>
                        <div class='media-body'>
                            <h4>$eduData->degree</h4>
                            <p>$eduData->university <br />$eduData->city, $eduData->country</p>
                        </div>
                    </div>
                </li>
            ";
        }

        $eduSection .= "
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        ";
        $temp .= $eduSection;
        // education section ends

        // project section starts
        $projSection = "
            <section class='home_gallery_area p_120' id='projects'>
                <div class='container'>
                    <div class='main_title'>
                        <h2>My Projects</h2>
                        <p>These demonstrate my skills and expertise.</p>
                    </div>
                </div>
                <div class='container'>
                    <div class='gallery_f_inner row imageGallery1'>
        ";

        $projData = $_POST['projects'];
        $projCnt = 0;
        if (is_array($projData)) {
            foreach ($projData as $proj) {
                $projCnt++;
                $projSection .= "
                    <div class='col-lg-4 col-md-4 col-sm-6 brand manipul design print'>
                        <div class='h_gallery_item'>
                            <div class='g_img_item'>
                                <img class='img-fluid custom-height' src='img/gallery/p$projCnt.jpg' alt=''>
                                <a class='light' href='img/gallery/p$projCnt.jpg'><img src='img/gallery/icon.png'
                                        alt=''></a>
                            </div>
                            <div class='g_item_text'>
                                <h4>$proj[projName]</h4>
                            </div>
                            <div class='d-flex align-items-center justify-content-between'>
                                <a href='$proj[projUrl]'>
                                    <button class='btn btn-primary btn-sm mt-1'>
                                    View project
                                    </button>
                                </a>
                                <a href='$proj[repoUrl]'>
                                    <button class='btn btn-success btn-sm mt-1'>View Code</button>
                                </a>
                            </div>
                        </div>
                    </div>
            ";
            }
        }

        $projSection .= "
                    </div>
                </div>
            </section>
        ";

        $temp .= $projSection;
        // project section ends

        // experience section starts
        $expSection = "
            <section class='mytabs_area p_120' id='experience'>
                <div class='container'>
                    <div class='tabs_inner'>
                        <ul class='nav nav-tabs' id='myTab' role='tablist'>
                            <li class='nav-item'>
                                <a class='nav-link active' id='home-tab' data-toggle='tab' href='#home' role='tab'
                                    aria-controls='home' aria-selected='true'>My Experiences</a>
                            </li>
                        </ul>
                        <div class='tab-content' id='myTabContent'>
                            <div class='tab-pane fade show active' id='home' role='tabpanel' aria-labelledby='home-tab'>
                                <ul class='list'>
        ";

        foreach ($experience as $expData) {
            $start = date('M Y', strtotime($expData->startDate));
            if ($expData->endDate !== "present") {
                $end = date('M Y', strtotime($expData->endDate));
            } else {
                $end = "Present";
            }
            $expSection .= "
                <li>
                    <span></span>
                    <div class='media'>
                        <div class='d-flex'>
                            <p>$start to $end</p>
                        </div>
                        <div class='media-body'>
                            <h4>$expData->jobProfile</h4>
                            <p>$expData->company<br />$expData->city, $expData->country</p>
                        </div>
                    </div>
                </li>
            ";
        }

        $expSection .= "
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        ";

        $temp .= $expSection;
        // experience section end

        // footer section start
        $temp .= "
            <section class='contact_area p_120' id='contact'>
                <div class='container'>
                    <div class='row'>
                        <div class='col-lg-3'>
                            <div class='contact_info'>
                                <div class='info_item'>
                                    <i class='lnr lnr-home'></i>
                                    <h6>$about->city, $about->state - $about->pincode</h6>
                                    <p></p>
                                </div>
                                <div class='info_item'>
                                    <i class='lnr lnr-phone-handset'></i>
                                    <h6><a href='#'>$about->contact</a></h6>
                                    <p></p>
                                </div>
                                <div class='info_item'>
                                    <i class='lnr lnr-envelope'></i>
                                    <h6><a href='#'>$email</a></h6>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-9'>
                            <form class='row contact_form' onsubmit='submitForm(event)' method='post' id='contactForm'
                                novalidate='novalidate'>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <input type='text' class='form-control' id='name' name='name'
                                            placeholder='Enter your name'>
                                    </div>
                                    <div class='form-group'>
                                        <input type='email' class='form-control' id='email' name='email'
                                            placeholder='Enter email address'>
                                    </div>
                                    <div class='form-group'>
                                        <input type='text' class='form-control' id='subject' name='subject'
                                            placeholder='Enter Subject'>
                                    </div>
                                </div>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <textarea class='form-control' name='message' id='message' rows='1'
                                            placeholder='Enter Message'></textarea>
                                    </div>
                                </div>
                                <div class='col-md-12 text-right'>
                                    <button type='submit' value='submit' class='btn submit_btn'>Send Message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            
            <script src='js/jquery-3.3.1.min.js'></script>
            <script src='js/popper.js'></script>
            <script src='js/bootstrap.min.js'></script>
            <script src='js/stellar.js'></script>
            <script src='vendors/lightbox/simpleLightbox.min.js'></script>
            <script src='vendors/nice-select/js/jquery.nice-select.min.js'></script>
            <script src='vendors/counter-up/jquery.waypoints.min.js'></script>
            <script src='vendors/counter-up/jquery.counterup.min.js'></script>
            <script src='js/theme.js'></script>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            
            <script src='https://cdnjs.cloudflare.com/ajax/libs/progressbar.js/1.0.1/progressbar.js'
                integrity='sha512-fFBIpoROdetOyuTxcYaXo/KQ2WAOp8/yi3sl3syGZK+qqfUUsPbIAe61hgJlg8aEkm9x9Zi2r4ldRZr0ZK1o+A=='
                crossorigin='anonymous' referrerpolicy='no-referrer'></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-appear/0.1/jquery.appear.js'
                integrity='sha512-gmlF0Cjvx6n5XCLF9NNN+rZwS3X0Xn1vwuk+K0L3B4qve4UI+RVbNt0VynWadl//O0VQ8X47GH55KF9j3kVdUw=='
                crossorigin='anonymous' referrerpolicy='no-referrer'></script>
            
            <script>
                async function submitForm(e) {
                    e.preventDefault()
                    console.log('form submitted');
                    await Swal.fire({
                        title: 'Form submitted successfully!',
                        text: 'We will shortly get back to you!',
                        icon: 'success',
                        confirmButtonText: 'Okay'
                    });
                }
            
                function scrollToSection(id) {
                    console.log('scroll called');
                    const elem = document.getElementById(id)
                    if (elem) {
                        elem.scrollIntoView({ behavior: 'smooth' })
                    }
            
                }
            </script>
            </body>
            
            </html>
        ";
        // footer section end

        // echo $temp;

        $sourceDirectory = '../templates/temp5';
        $destinationDirectory = '../temporary';
        $files = array();
        copyDirectory($sourceDirectory, $destinationDirectory, $files);
        file_put_contents("../temporary/index.html", $temp);

        if ($img != "") {
            file_put_contents("../temporary/img/personal.jpg", base64_decode($img));
        }

        $files_2 = array();
        $dest_for_users = "../users/" . $user_id . "/temp5";
        copyDirectory("../temporary", $dest_for_users , $files_2);

        echo json_encode(array("status" => "success"));
    }
}

function generate_portfolio_6()
{
    $user_id = $_COOKIE['userid'];
    global $conn;
    $img = $_POST['img'];

    $sql = "SELECT email, about, experience, skills, education, socials from users where id=$user_id";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $email = $row['email'];
        $about = $row['about'] != "" ? json_decode($row['about']) : "";
        $education = $row['education'] != "" ? json_decode($row['education']) : "";
        $experience = $row['experience'] != "" ? json_decode($row['experience']) : "";
        $skills = $row['skills'] != "" ? json_decode($row['skills']) : "";
        $socials = $row['socials'] != "" ? json_decode($row['socials']) : "";

        $temp = "
            <!DOCTYPE html>
            <html class='no-js' lang='en'>

            <head>
                <meta charset='utf-8' />
                <meta http-equiv='X-UA-Compatible' content='IE=edge' />
                <meta name='viewport' content='width=device-width, initial-scale=1' />

                <link
                    href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&amp;subset=devanagari,latin-ext'
                    rel='stylesheet' />

                <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css'
                    integrity='sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=='
                    crossorigin='anonymous' referrerpolicy='no-referrer' />

                <title>$about->fname Portfolio</title>

                <link rel='shortcut icon' type='image/icon' href='#' />

                <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css'
                    integrity='sha512-pli9aKq758PMdsqjNA+Au4CJ7ZatLCCXinnlSfv023z4xmzl8s+Jbj2qNR7RI8DsxFp5e8OvbYGDACzKntZE9w=='
                    crossorigin='anonymous' referrerpolicy='no-referrer' />

                <link rel='stylesheet' href='assets/css/style.css' />
            </head>

            <body>

                <header class='top-area'>
                    <div class='header-area'>
                        <nav class='navbar navbar-default bootsnav navbar-fixed dark no-background'>
                            <div class='container'>
                                <div class='navbar-header'>
                                    <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#navbar-menu'>
                                        <i class='fa fa-bars'></i>
                                    </button>
                                    <a class='navbar-brand' href='index.html'>$about->fname</a>
                                </div>

                                <div class='collapse navbar-collapse menu-ui-design' id='navbar-menu'>
                                    <ul class='nav navbar-nav navbar-right' data-in='fadeInDown' data-out='fadeOutUp'>
                                        <li class='smooth-menu'></li>
                                        <li class='smooth-menu active'>
                                            <a href='#about'>about</a>
                                        </li>
                                        <li class='smooth-menu'>
                                            <a href='#education'>education</a>
                                        </li>
                                        <li class='smooth-menu'>
                                            <a href='#skills'>skills</a>
                                        </li>
                                        <li class='smooth-menu'>
                                            <a href='#experience'>experience</a>
                                        </li>
                                        <li class='smooth-menu'>
                                            <a href='#projects'>projects</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>

                    <div class='clearfix'></div>
                </header>
        ";

        // about section start
        $aboutSection = "
            <section id='about' class='about'>
                <div class='container'>
                    <div class='about-content'>
                        <div class='row'>
                            <div class='col-sm-6'>
                                <div class='single-about-txt'>
                                    <h1 class='hero-title'>
                                        Hi, I am
                                        <span class='purple-colored'>$about->fname $about->lname</span>.
                                        <br />
                                    </h1>
                                    <p style='white-space: pre-line'>
                                        $about->aboutMe
                                    </p>
                                    <div class='row'>
                                        <div class='col-sm-4'>
                                            <div class='single-about-add-info'>
                                                <h3>phone</h3>
                                                <p>$about->contact</p>
                                            </div>
                                        </div>
                                        <div class='col-sm-4'>
                                            <div class='single-about-add-info'>
                                                <h3>email</h3>
                                                <p>$email</p>
                                            </div>
                                        </div>
                                        <div class='col-sm-4'>
                                            <div class='single-about-add-info'>
                                                <h3>website</h3>
                                                <p>$socials->website</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-sm-offset-1 col-sm-5'>
                                <div class='single-about-img'>
                                    <img src='assets/images/about/profile_image.jpg' alt='profile_image' class='user-img' />
        ";

        $links = "<div class='about-list-icon'>
                    <ul>";
        if (isset($socials->facebook) && $socials->facebook != "") {
            $links .= "
            <li>
                <a href='$socials->facebook'>
                    <i class='fab fa-facebook' aria-hidden='true'></i>
                </a>
            </li>
            ";
        }
        if (isset($socials->instagram) && $socials->instagram != "") {
            $links .= "
            <li>
                <a href='$socials->instagram'>
                    <i class='fab fa-instagram' aria-hidden='true'></i>
                </a>
            </li>
            ";
        }
        if (isset($socials->twitter) && $socials->twitter != "") {
            $links .= "
            <li>
                <a href='$socials->twitter'>
                    <i class='fab fa-twitter' aria-hidden='true'></i>
                </a>
            </li>
            ";
        }
        if (isset($socials->linkedin) && $socials->linkedin != "") {
            $links .= "
            <li>
                <a href='$socials->linkedin'>
                    <i class='fab fa-linkedin' aria-hidden='true'></i>
                </a>
            </li>
            ";
        }
        if (isset($socials->github) && $socials->github != "") {
            $links .= "
            <li>
                <a href='$socials->github'>
                    <i class='fab fa-github' aria-hidden='true'></i>
                </a>
            </li>
            ";
        }

        $links .= "
                    </ul>
                </div>
                ";

        $aboutSection .= $links;

        $aboutSection .= "
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        ";
        $temp .= $aboutSection;
        // about section end

        // echo $temp;

        // education section start
        $eduSection = "
            <section id='education' class='education'>
                <div class='section-heading text-center'>
                    <h2>education</h2>
                </div>
                <div class='container'>
        ";

        $eduChunks = array_chunk($education, 3);

        foreach ($eduChunks as $eduChunk) {
            $eduTemp = "
                <div class='education-horizontal-timeline'>
                    <div class='row'>
            ";
            foreach ($eduChunk as $eduData) {
                // Start year
                $start = $eduData->startDate;
                $startDate = new DateTime($start);
                $startYear = $startDate->format('Y');

                // end year
                $end = $eduData->endDate;
                $endDate = new DateTime($end);
                $endYear = $endDate->format('Y');
                $eduTemp .= "
                    <div class='col-sm-4'>
                        <div class='single-horizontal-timeline'>
                            <div class='experience-time'>
                                <h2>$startYear - $endYear</h2>
                                <h3>
                                    $eduData->degree
                                </h3>
                            </div>
                            <div class='timeline-horizontal-border'>
                                <i class='fa fa-circle' aria-hidden='true'></i>
                                <span class='single-timeline-horizontal'></span>
                            </div>
                            <div class='timeline'>
                                <div class='timeline-content'>
                                    <h4 class='title'>
                                        $eduData->university
                                    </h4>
                                    <h5>$eduData->city, $eduData->country</h5>
                                    <p class='description'>
                                        $eduData->summary
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                ";
            }
            $eduTemp .= "
                    </div>
                </div>
            ";
            $eduSection .= $eduTemp;
        }

        $eduSection .= "
                </div>
            </section>
        ";
        $temp .= $eduSection;
        // education section ends


        // skills section start
        $skillSection = "
            <section id='skills' class='skills'>
                <div class='skill-content'>
                    <div class='section-heading text-center'>
                        <h2>skills</h2>
                    </div>
                    <div class='container'>
                        <div class='row'>
        ";

        // Split the array into two chunks 
        $skillChunks = array_chunk($_POST['skills'], ceil(count($_POST['skills']) / 2));

        // Iterate through each chunk
        foreach ($skillChunks as $skillChunk) {
            $skillSection .= "
                <div class='col-md-6'>
                    <div class='single-skill-content'>
            ";
            foreach ($skillChunk as $skillData) {
                $skillSection .= "
                    <div class='barWrapper'>
                        <span class='progressText'>$skillData[skill]</span>
                        <div class='single-progress-txt'>
                            <div class='progress'>
                                <div class='progress-bar' role='progressbar' aria-valuenow='$skillData[value]' aria-valuemin='10'
                                    aria-valuemax='100' style=''></div>
                            </div>
                            <h3>$skillData[value]%</h3>
                        </div>
                    </div>
                ";
            }
            $skillSection .= "
                    </div>
                </div>
            ";
        }

        $skillSection .= "
                        </div>
                    </div>
                </div>
            </section>
        ";
        $temp .= $skillSection;
        // skills section end


        // experience section start
        $expSection = "
            <section id='experience' class='experience'>
                <div class='section-heading text-center'>
                    <h2>experience</h2>
                </div>
                <div class='container'>
                    <div class='experience-content'>
                        <div class='main-timeline'>
                            <ul>
        ";

        foreach ($experience as $expData) {
            $start = date('M Y', strtotime($expData->startDate));
            if ($expData->endDate !== "present") {
                $end = date('M Y', strtotime($expData->endDate));
            } else {
                $end = "Present";
            }
            $expSection .= "
                <li>
                    <div class='single-timeline-box fix'>
                        <div class='row'>
                            <div class='col-md-5'>
                                <div class='experience-time text-right'>
                                    <h2>$start - $end</h2>
                                    <h3>$expData->jobProfile</h3>
                                </div>
                            </div>
                            <div class='col-md-offset-1 col-md-5'>
                                <div class='timeline'>
                                    <div class='timeline-content'>
                                        <h4 class='title'>
                                            <span><i class='fa fa-circle' aria-hidden='true'></i></span>
                                            $expData->company
                                        </h4>
                                        <h5>$expData->city, $expData->country</h5>
                                        <p class='description' style='white-space: pre-line'>
                                            $expData->summ
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            ";
        }

        $expSection .= "
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        ";

        $temp .= $expSection;
        // experience section end

        // echo "exp end";
        // // return;

        // projects section start
        $projSection = "
            <section id='projects' class='portfolio'>
                <div class='portfolio-details'>
                    <div class='section-heading text-center'>
                        <h2>projects</h2>
                    </div>
                    <div class='container'>
                        <div class='portfolio-content'>
                            <div class='isotope'>
                                <div class='row'>
        ";

        $projData = $_POST['projects'];

        $projCnt = 0;
        foreach ($projData as $proj) {
            $projCnt++;
            $projSection .= "
                <div class='col-sm-4'>
                    <div class='item'>
                        <img src='assets/images/projects/p$projCnt.jpg' alt='portfolio image' />
                        <div class='d-flex align-items-center justify-content-between'>
                            <a href='$proj[projUrl]'>
                                <button class='btn btn-primary btn-sm mt-1'>
                                View project
                                </button>
                            </a>
                            <a href='$proj[repoUrl]'>
                                <button class='btn btn-success btn-sm mt-1'>View Code</button>
                            </a>
                        </div>
                    </div>
                </div>
            ";
        }

        $projSection .= "
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        ";

        $temp .= $projSection;
        // projects section end

        // footer section start
        $temp .= "
            <footer id='footer-copyright' class='footer-copyright'>
                <div class='container'>
                    <div class='hm-footer-copyright text-center'>
                        <p>
                            &copy; copyright Portfolify. design and developed by
                            <a href='#'>Portfolify</a>
                        </p>
                    </div>
                </div>

                <div id='scroll-Top'>
                    <div class='return-to-top'>
                        <i class='fa fa-angle-up' id='scroll-top'></i>
                    </div>
                </div>
            </footer>

            <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.js'
                integrity='sha512-OKuL2kpi8zfeXcqSXnGbL6tKc9JxWmppJY4mOSn1EsngRb7fx1N5+7wOTGqu2bI5OAYL3Og7/Beg7EsWG2OBKA=='
                crossorigin='anonymous' referrerpolicy='no-referrer'></script>

            <script src='https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js'></script>

            <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'
                integrity='sha512-iztkobsvnjKfAtTNdHkGVjAYTrrtlC7mGp/54c40wowO7LhURYl3gVzzcEqGl/qKXQltJ2HwMrdLcNUdo+N/RQ=='
                crossorigin='anonymous' referrerpolicy='no-referrer'></script>

            <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.js'
                integrity='sha512-p+GPBTyASypE++3Y4cKuBpCA8coQBL6xEDG01kmv4pPkgjKFaJlRglGpCM2OsuI14s4oE7LInjcL5eAUVZmKAQ=='
                crossorigin='anonymous' referrerpolicy='no-referrer'></script>


            <script src='https://cdnjs.cloudflare.com/ajax/libs/progressbar.js/1.0.1/progressbar.js'
                integrity='sha512-fFBIpoROdetOyuTxcYaXo/KQ2WAOp8/yi3sl3syGZK+qqfUUsPbIAe61hgJlg8aEkm9x9Zi2r4ldRZr0ZK1o+A=='
                crossorigin='anonymous' referrerpolicy='no-referrer'></script>

            <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-appear/0.1/jquery.appear.js'
                integrity='sha512-gmlF0Cjvx6n5XCLF9NNN+rZwS3X0Xn1vwuk+K0L3B4qve4UI+RVbNt0VynWadl//O0VQ8X47GH55KF9j3kVdUw=='
                crossorigin='anonymous' referrerpolicy='no-referrer'></script>


            <script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.0/owl.carousel.min.js'
                integrity='sha512-yG5avRhg8AWY1BsP/N//3vL3l74jbsQHivqAXOx7KB3agFQzFbeubQr9zYBinQ8+Iwsebv2s2+muvA9fMw/Ebg=='
                crossorigin='anonymous' referrerpolicy='no-referrer'></script>

            <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js'></script>

            <script src='assets/js/custom.js'></script>
            </body>

            </html>
        ";
        // footer section end

        $sourceDirectory = '../templates/temp6';
        $destinationDirectory = '../temporary';
        $files = array();
        copyDirectory($sourceDirectory, $destinationDirectory, $files);
        file_put_contents("../temporary/index.html", $temp);

        if ($img != "") {
            file_put_contents("../temporary/assets/images/about/profile_image.jpg", base64_decode($img));
        }

        $files_2 = array();
        $dest_for_users = "../users/" . $user_id . "/temp6";
        copyDirectory("../temporary", $dest_for_users , $files_2);

        echo json_encode(array("status" => "success"));

        // createZipFolder($files);
    }
}


if (isset($_GET['tempid'])) {
    switch ($_GET['tempid']) {
        case '1':
            generate_portfolio_1();
            break;
        case '2':
            generate_portfolio_2();
            break;
        case '3':
            generate_portfolio_3();
            break;
        case '4':
            generate_portfolio_4();
            break;
        case '5':
            generate_portfolio_5();
            break;
        case '6':
            generate_portfolio_6();
            break;
        default:
            break;
    }
}

if (isset($_GET['action']) && $_GET['action'] == "downloadfile") {
    createZipFolder();
}

if (isset($_GET['action']) && $_GET['action'] == "save_proj_images") {
    saveProjImages();
}




// test code

// original code - 1 - start

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     if (isset($_POST['action']) && $_POST['action'] == 'createtemplate') {
//         // echo "data received";
//         $user_id = $_COOKIE['userid'];
//         if (isset($_POST['temp_id']) && $_POST['temp_id'] == "2") {

//             $img = $_POST['img'];
//             $facebook = $_POST['facebook'];
//             $twitter = $_POST['twitter'];
//             $linkedin = $_POST['linkedin'];
//             $github = $_POST['github'];

//             $sql = "SELECT email, about, experience, skills, education from users where id=$user_id";
//             $res = mysqli_query($conn, $sql);

//             if (mysqli_num_rows($res) > 0) {
//                 $row = mysqli_fetch_assoc($res);

//                 // echo json_encode($row);
//                 $about = $row['about'] != "" ? json_decode($row['about']) : "";
//                 $education = $row['education'] != "" ? json_decode($row['education']) : "";
//                 $experience = $row['experience'] != "" ? json_decode($row['experience']) : "";
//                 $skills = $row['skills'] != "" ? json_decode($row['skills']) : "";

//                 $temp = "
//                 <!DOCTYPE html>
//                 <html lang='en'>

//                   <head>

//                     <meta charset='utf-8'>
//                     <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
//                     <meta name='description' content=''>
//                     <meta name='author' content=''>

//                     <title></title>
//                     <link href='https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:100,200,300,400,500,600,700,800,900' rel='stylesheet'>
//                     <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i' rel='stylesheet'>
//                     <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css' integrity='sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==' crossorigin='anonymous' referrerpolicy='no-referrer' />
//                     <link rel='stylesheet'
//                         href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.min.css'
//                         integrity='sha512-ZbJOe0eaEsNwXGE3U+k2NrTAb/jIp8vqEYBADqvTMjYdpPzoAlgySX705E0WESDAs49YIMFd4lZGqf9qARbV7w=='
//                         crossorigin='anonymous' referrerpolicy='no-referrer' />
//                     <link href='css/resume.min.css' rel='stylesheet'>

//                   </head>

//                   <body id='page-top'>

//                     <nav class='navbar navbar-expand-lg navbar-dark bg-primary fixed-top' id='sideNav'>
//                       <a class='navbar-brand js-scroll-trigger' href='#page-top'>
//                         <span class='d-block d-lg-none'>$about->fname $about->lname</span>
//                         <span class='d-none d-lg-block'>
//                           <img class='img-fluid img-profile rounded-circle mx-auto mb-2' src='./img/user.jpg' alt=''>
//                         </span>
//                       </a>
//                       <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
//                         <span class='navbar-toggler-icon'></span>
//                       </button>
//                       <div class='collapse navbar-collapse' id='navbarSupportedContent'>
//                         <ul class='navbar-nav'>
//                           <li class='nav-item'>
//                             <a class='nav-link js-scroll-trigger' href='#about'>About</a>
//                           </li>
//                           <li class='nav-item'>
//                             <a class='nav-link js-scroll-trigger' href='#experience'>Experience</a>
//                           </li>
//                           <li class='nav-item'>
//                             <a class='nav-link js-scroll-trigger' href='#education'>Education</a>
//                           </li>
//                           <li class='nav-item'>
//                             <a class='nav-link js-scroll-trigger' href='#skills'>Skills</a>
//                           </li>
//                         </ul>
//                       </div>
//                     </nav>

//                     <div class='container-fluid p-0'>
//                     <section class='resume-section p-3 p-lg-5 d-flex d-column' id='about'>
//                         <div class='my-auto'>
//                             <h1 class='mb-0'>$about->fname
//                             <span class='text-primary'>$about->lname</span>
//                             </h1>
//                             <div class='subheading mb-5'>$about->street · $about->city, $about->state $about->pincode · $about->contact ·
//                             <a href='mailto:$row[email]'> $row[email] </a>
//                             </div>
//                             <p class='mb-5' style='white-space: pre-line'> $about->aboutMe </p>
//                             <ul class='list-inline list-social-icons mb-0'>
//                             ";
//                 if ($facebook != "") {
//                     $temp .= "
//                                 <li class='list-inline-item'>
//                                     <a href='$facebook'>
//                                     <span class='fa-stack fa-lg'>
//                                         <i class='fa fa-circle fa-stack-2x'></i>
//                                         <i class='fab fa-facebook fa-stack-1x fa-inverse'></i>
//                                     </span>
//                                     </a>
//                                 </li>
//                             ";
//                 }
//                 if ($twitter != "") {
//                     $temp .= "
//                                 <li class='list-inline-item'>
//                                     <a href='$twitter'>
//                                     <span class='fa-stack fa-lg'>
//                                         <i class='fa fa-circle fa-stack-2x'></i>
//                                         <i class='fab fa-twitter fa-stack-1x fa-inverse'></i>
//                                     </span>
//                                     </a>
//                                 </li>
//                                 ";
//                 }
//                 if ($linkedin != "") {
//                     $temp .= "
//                                 <li class='list-inline-item'>
//                                     <a href='$linkedin'>
//                                     <span class='fa-stack fa-lg'>
//                                         <i class='fa fa-circle fa-stack-2x'></i>
//                                         <i class='fab fa-linkedin fa-stack-1x fa-inverse'></i>
//                                     </span>
//                                     </a>
//                                 </li>
//                                 ";
//                 }
//                 if ($github != "") {
//                     $temp .= "
//                                 <li class='list-inline-item'>
//                                     <a href='$github'>
//                                     <span class='fa-stack fa-lg'>
//                                         <i class='fa fa-circle fa-stack-2x'></i>
//                                         <i class='fab fa-github fa-stack-1x fa-inverse'></i>
//                                     </span>
//                                     </a>
//                                 </li>
//                     ";
//                 }

//                 $temp .= "
//                             </ul>
//                         </div>
//                     </section>
//                 ";
//                 // about section end
//                 // echo $temp;

//                 // experience section start
//                 $expSection = "
//                 <section class='resume-section p-3 p-lg-5 d-flex flex-column' id='experience'>
//                     <div class='my-auto'>
//                         <h2 class='mb-5'>Experience</h2>
//                 ";
//                 foreach ($experience as $exp) {
//                     $start = date('M Y', strtotime($exp->startDate));
//                     if ($exp->endDate !== "present") {
//                         $end = date('M Y', strtotime($exp->endDate));
//                     } else {
//                         $end = "Present";
//                     }
//                     $expDiv = "
//                     <div class='resume-item d-flex flex-column flex-md-row mb-5'>
//                         <div class='resume-content mr-auto'>
//                             <h3 class='mb-0'>$exp->jobProfile</h3>
//                             <div class='subheading mb-3'>$exp->company</div>
//                             <p>$exp->summ</p>
//                         </div>
//                         <div class='resume-date text-md-right'>
//                             <span class='text-primary'>$start - $end</span>
//                         </div>
//                     </div>
//                     ";

//                     $expSection .= $expDiv;
//                 }
//                 $expSection .= "
//                     </div>
//                 </section>
//                 ";

//                 $temp .= $expSection;
//                 // experience section end

//                 // education section start
//                 $eduSection = "
//                 <section class='resume-section p-3 p-lg-5 d-flex flex-column' id='education'>
//                     <div class='my-auto'>
//                         <h2 class='mb-5'>Education</h2>
//                 ";
//                 foreach ($education as $edu) {
//                     $start = date('M Y', strtotime($edu->startDate));
//                     $end = date('M Y', strtotime($edu->endDate));
//                     $eduDiv = "
//                     <div class='resume-item d-flex flex-column flex-md-row mb-5'>
//                         <div class='resume-content mr-auto'>
//                             <h3 class='mb-0'>$edu->university</h3>
//                             <div class='subheading mb-3'>$edu->degree</div>
//                             <p>Percentage / GPA: $edu->perc</p>
//                         </div>
//                         <div class='resume-date text-md-right'>
//                             <span class='text-primary'>$start - $end</span>
//                         </div>
//                     </div>
//                     ";

//                     $eduSection .= $eduDiv;
//                 }
//                 $eduSection .= "
//                     </div>
//                 </section>
//                 ";

//                 $temp .= $eduSection;

//                 // echo $temp;
//                 // education section end

//                 // skills section - start
//                 $skillSection = "
//                 <section class='resume-section p-3 p-lg-5 d-flex flex-column' id='skills'>
//                     <div class='my-auto'>
//                         <h2 class='mb-5'>Skills</h2>

//                         <div class='subheading mb-3'>Programming Languages &amp; Tools</div>
//                         <div class='row'>
//                 ";
//                 foreach ($skills as $skill) {
//                     $skillSection .= "<div class='col-md-3 col-lg-3 mb-3'>$skill</div>";
//                 }

//                 $skillSection .= "
//                         </div>
//                     </div>
//                 </section>
//                 ";

//                 $temp .= $skillSection;
//                 // skills section - end
//                 // echo $temp;

//                 $temp .= "
//                         </div>
//                         <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'
//                             integrity='sha512-3P8rXCuGJdNZOnUx/03c1jOTnMn3rP63nBip5gOP2qmUh5YAdVAvFZ1E+QLZZbC1rtMrQb+mah3AfYW11RUrWA=='
//                             crossorigin='anonymous' referrerpolicy='no-referrer'></script>
//                         <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/js/bootstrap.bundle.min.js'
//                             integrity='sha512-iK40H6FrXMa4VY6I6y2MHnzDCcMibPQD3mwT/3+7M1YrkW4uvTLDEzjFva0c0qyuEbWG/13obA6bIomIaySdcQ=='
//                             crossorigin='anonymous' referrerpolicy='no-referrer'></script>
//                         <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'
//                             integrity='sha512-ahmSZKApTDNd3gVuqL5TQ3MBTj8tL5p2tYV05Xxzcfu6/ecvt1A0j6tfudSGBVuteSoTRMqMljbfdU0g2eDNUA=='
//                             crossorigin='anonymous' referrerpolicy='no-referrer'></script>
//                         <script src='js/resume.min.js'></script>
//                     </body>
//                 </html>
//                 ";

//                 $sourceDirectory = './templates/temp2';
//                 $destinationDirectory = './temporary';
//                 $files = array();
//                 copyDirectory($sourceDirectory, $destinationDirectory, $files);
//                 // echo json_encode($files);
//                 file_put_contents("./temporary/index.html", $temp);

//                 if ($img != "") {
//                     file_put_contents("./temporary/img/user.jpg", base64_decode($img));
//                 }

//                 // createZipFolder();
//             }
//         }
//     }
// }

// original code - 1 - end

// original code - start

// if (isset($_GET['action']) && $_GET['action'] == "actual_download") {
//     $user_id = $_COOKIE['userid'];
//     // if (isset($_GET['temp_id']) && $_GET['temp_id'] == "2") {
//     $img = "";
//     $facebook = "";
//     $twitter = "";
//     $linkedin = "";
//     $github = "";

//     $sql = "SELECT email, about, experience, skills, education from users where id=$user_id";
//     $res = mysqli_query($conn, $sql);

//     if (mysqli_num_rows($res) > 0) {
//         $row = mysqli_fetch_assoc($res);

//         // echo json_encode($row);
//         $about = $row['about'] != "" ? json_decode($row['about']) : "";
//         $education = $row['education'] != "" ? json_decode($row['education']) : "";
//         $experience = $row['experience'] != "" ? json_decode($row['experience']) : "";
//         $skills = $row['skills'] != "" ? json_decode($row['skills']) : "";

//         // echo json_encode($about);
//         // echo json_encode($education);
//         // echo json_encode($experience);
//         // echo json_encode($skills);

//         // echo $about->fname;

//         $temp = "
//             <!DOCTYPE html>
//             <html lang='en'>

//               <head>

//                 <meta charset='utf-8'>
//                 <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
//                 <meta name='description' content=''>
//                 <meta name='author' content=''>

//                 <title></title>
//                 <link href='https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:100,200,300,400,500,600,700,800,900' rel='stylesheet'>
//                 <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i' rel='stylesheet'>
//                 <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css' integrity='sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==' crossorigin='anonymous' referrerpolicy='no-referrer' />
//                 <link rel='stylesheet'
//                     href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.min.css'
//                     integrity='sha512-ZbJOe0eaEsNwXGE3U+k2NrTAb/jIp8vqEYBADqvTMjYdpPzoAlgySX705E0WESDAs49YIMFd4lZGqf9qARbV7w=='
//                     crossorigin='anonymous' referrerpolicy='no-referrer' />
//                 <link href='css/resume.min.css' rel='stylesheet' />

//               </head>

//               <body id='page-top'>

//                 <nav class='navbar navbar-expand-lg navbar-dark bg-primary fixed-top' id='sideNav'>
//                   <a class='navbar-brand js-scroll-trigger' href='#page-top'>
//                     <span class='d-block d-lg-none'>$about->fname $about->lname</span>
//                     <span class='d-none d-lg-block'>
//                       <img class='img-fluid img-profile rounded-circle mx-auto mb-2' src='./img/user.jpg' alt=''>
//                     </span>
//                   </a>
//                   <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
//                     <span class='navbar-toggler-icon'></span>
//                   </button>
//                   <div class='collapse navbar-collapse' id='navbarSupportedContent'>
//                     <ul class='navbar-nav'>
//                       <li class='nav-item'>
//                         <a class='nav-link js-scroll-trigger' href='#about'>About</a>
//                       </li>
//                       <li class='nav-item'>
//                         <a class='nav-link js-scroll-trigger' href='#experience'>Experience</a>
//                       </li>
//                       <li class='nav-item'>
//                         <a class='nav-link js-scroll-trigger' href='#education'>Education</a>
//                       </li>
//                       <li class='nav-item'>
//                         <a class='nav-link js-scroll-trigger' href='#skills'>Skills</a>
//                       </li>
//                     </ul>
//                   </div>
//                 </nav>

//                 <div class='container-fluid p-0'>
//                 <section class='resume-section p-3 p-lg-5 d-flex d-column' id='about'>
//                     <div class='my-auto'>
//                         <h1 class='mb-0'>$about->fname
//                         <span class='text-primary'>$about->lname</span>
//                         </h1>
//                         <div class='subheading mb-5'>$about->street · $about->city, $about->state $about->pincode · $about->contact ·
//                         <a href='mailto:$row[email]'> $row[email] </a>
//                         </div>
//                         <p class='mb-5' style='white-space: pre-line'> $about->aboutMe </p>
//                         <ul class='list-inline list-social-icons mb-0'>
//                         ";
//         if ($facebook != "") {
//             $temp .= "
//                             <li class='list-inline-item'>
//                                 <a href='$facebook'>
//                                 <span class='fa-stack fa-lg'>
//                                     <i class='fa fa-circle fa-stack-2x'></i>
//                                     <i class='fab fa-facebook fa-stack-1x fa-inverse'></i>
//                                 </span>
//                                 </a>
//                             </li>
//                         ";
//         }
//         if ($twitter != "") {
//             $temp .= "
//                             <li class='list-inline-item'>
//                                 <a href='$twitter'>
//                                 <span class='fa-stack fa-lg'>
//                                     <i class='fa fa-circle fa-stack-2x'></i>
//                                     <i class='fab fa-twitter fa-stack-1x fa-inverse'></i>
//                                 </span>
//                                 </a>
//                             </li>
//                             ";
//         }
//         if ($linkedin != "") {
//             $temp .= "
//                             <li class='list-inline-item'>
//                                 <a href='$linkedin'>
//                                 <span class='fa-stack fa-lg'>
//                                     <i class='fa fa-circle fa-stack-2x'></i>
//                                     <i class='fab fa-linkedin fa-stack-1x fa-inverse'></i>
//                                 </span>
//                                 </a>
//                             </li>
//                             ";
//         }
//         if ($github != "") {
//             $temp .= "
//                             <li class='list-inline-item'>
//                                 <a href='$github'>
//                                 <span class='fa-stack fa-lg'>
//                                     <i class='fa fa-circle fa-stack-2x'></i>
//                                     <i class='fab fa-github fa-stack-1x fa-inverse'></i>
//                                 </span>
//                                 </a>
//                             </li>
//                 ";
//         }
//         $temp .= "
//                         </ul>
//                     </div>
//                 </section>
//         ";
//         // about section end
//         // echo $temp;

//         // experience section start
//         $expSection = "
//             <section class='resume-section p-3 p-lg-5 d-flex flex-column' id='experience'>
//                 <div class='my-auto'>
//                     <h2 class='mb-5'>Experience</h2>
//             ";
//         foreach ($experience as $exp) {
//             $start = date('M Y', strtotime($exp->startDate));
//             if ($exp->endDate !== "present") {
//                 $end = date('M Y', strtotime($exp->endDate));
//             } else {
//                 $end = "Present";
//             }
//             $expDiv = "
//                 <div class='resume-item d-flex flex-column flex-md-row mb-5'>
//                     <div class='resume-content mr-auto'>
//                         <h3 class='mb-0'>$exp->jobProfile</h3>
//                         <div class='subheading mb-3'>$exp->company</div>
//                         <p>$exp->summ</p>
//                     </div>
//                     <div class='resume-date text-md-right'>
//                         <span class='text-primary'>$start - $end</span>
//                     </div>
//                 </div>
//                 ";

//             $expSection .= $expDiv;
//         }
//         $expSection .= "
//                 </div>
//             </section>
//             ";

//         $temp .= $expSection;
//         // experience section end

//         // education section start
//         $eduSection = "
//             <section class='resume-section p-3 p-lg-5 d-flex flex-column' id='education'>
//                 <div class='my-auto'>
//                     <h2 class='mb-5'>Education</h2>
//             ";
//         foreach ($education as $edu) {
//             $start = date('M Y', strtotime($edu->startDate));
//             $end = date('M Y', strtotime($edu->endDate));
//             $eduDiv = "
//                 <div class='resume-item d-flex flex-column flex-md-row mb-5'>
//                     <div class='resume-content mr-auto'>
//                         <h3 class='mb-0'>$edu->university</h3>
//                         <div class='subheading mb-3'>$edu->degree</div>
//                         <p>Percentage / GPA: $edu->perc</p>
//                     </div>
//                     <div class='resume-date text-md-right'>
//                         <span class='text-primary'>$start - $end</span>
//                     </div>
//                 </div>
//                 ";

//             $eduSection .= $eduDiv;
//         }
//         $eduSection .= "
//                 </div>
//             </section>
//             ";

//         $temp .= $eduSection;

//         // echo $temp;
//         // education section end

//         // skills section - start
//         $skillSection = "
//             <section class='resume-section p-3 p-lg-5 d-flex flex-column' id='skills'>
//                 <div class='my-auto'>
//                     <h2 class='mb-5'>Skills</h2>

//                     <div class='subheading mb-3'>Programming Languages &amp; Tools</div>
//                     <div class='row'>
//             ";
//         foreach ($skills as $skill) {
//             $skillSection .= "<div class='col-md-3 col-lg-3 mb-3'>$skill</div>";
//         }

//         $skillSection .= "
//                     </div>
//                 </div>
//             </section>
//             ";

//         $temp .= $skillSection;
//         // skills section - end
//         // echo $temp;

//         $temp .= "
//                     </div>
//                     <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'
//                         integrity='sha512-3P8rXCuGJdNZOnUx/03c1jOTnMn3rP63nBip5gOP2qmUh5YAdVAvFZ1E+QLZZbC1rtMrQb+mah3AfYW11RUrWA=='
//                         crossorigin='anonymous' referrerpolicy='no-referrer'></script>
//                     <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/js/bootstrap.bundle.min.js'
//                         integrity='sha512-iK40H6FrXMa4VY6I6y2MHnzDCcMibPQD3mwT/3+7M1YrkW4uvTLDEzjFva0c0qyuEbWG/13obA6bIomIaySdcQ=='
//                         crossorigin='anonymous' referrerpolicy='no-referrer'></script>
//                     <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'
//                         integrity='sha512-ahmSZKApTDNd3gVuqL5TQ3MBTj8tL5p2tYV05Xxzcfu6/ecvt1A0j6tfudSGBVuteSoTRMqMljbfdU0g2eDNUA=='
//                         crossorigin='anonymous' referrerpolicy='no-referrer'></script>      
//                     <script src='js/resume.min.js'></script>
//                 </body>
//             </html>
//             ";

//         $sourceDirectory = './templates/temp2';
//         $destinationDirectory = './temporary';
//         $files = array();
//         copyDirectory($sourceDirectory, $destinationDirectory, $files);
//         // echo json_encode($files);
//         file_put_contents("./temporary/index.html", $temp);

//         if ($img != "") {
//             file_put_contents("./temporary/img/user.jpg", base64_decode($img));
//         }

//         createZipFolder($files);
//         // createZipV2();
//         // createZipHelloWorld();
//     }
//     // }
// }

// function createZipV2()
// {
//     // Get real path for our folder
//     $rootPath = realpath('./temporary');

//     // Initialize archive object
//     $zip = new ZipArchive();
//     $zip->open('file.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

//     // Create recursive directory iterator
//     /** @var SplFileInfo[] $files */
//     $files = new RecursiveIteratorIterator(
//         new RecursiveDirectoryIterator($rootPath),
//         RecursiveIteratorIterator::LEAVES_ONLY
//     );

//     foreach ($files as $file) {
//         // Skip directories (they would be added automatically)
//         if (!$file->isDir()) {
//             // Get real and relative path for current file
//             $filePath = $file->getRealPath();
//             $relativePath = substr($filePath, strlen($rootPath) + 1);

//             // Add current file to archive
//             $zip->addFile($filePath, $relativePath);
//         }
//     }

//     // Zip archive will be created only after closing object
//     $zip->close();

//     # send the file to the browser as a download
//     header('Content-type: application/zip');
//     header('Content-disposition: attachment; filename=Resumes.zip');
//     header("Content-Length: " . filesize('file.zip'));
//     ob_clean();
//     // ob_end_flush();
//     readfile('file.zip');
// }

// function createZipHelloWorld()
// {
//     // Create a file with 'hello world' content
//     $filename = 'hello.txt';
//     $content = 'hello world';
//     file_put_contents($filename, $content);

//     // Create a new zip object
//     $zip = new ZipArchive();

//     // Create a temporary zip file
//     $tmp_zip_file = tempnam('.', '');
//     unlink($tmp_zip_file);
//     $zip->open($tmp_zip_file, ZipArchive::CREATE);

//     // Add the file to the zip archive
//     $zip->addFromString($filename, $content);

//     // Close the zip archive
//     $zip->close();

//     // Set headers to force download
//     header('Content-Type: application/zip');
//     header('Content-Disposition: attachment; filename="hello.zip"');

//     // Read and output the contents of the temporary zip file
//     readfile($tmp_zip_file);

//     // Delete temporary files
//     unlink($filename);
//     unlink($tmp_zip_file);
// }

// original code - end
