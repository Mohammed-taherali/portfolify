<?php
include("../includes/header_top.php");
include("../config/session.php");
include("../config/config.php");

if (isset($_GET['update']) && $_GET['update'] == "true") {
    $userid = $_COOKIE['userid'];
    $sql = "SELECT * from users where id = $userid";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $about = $row['about'] != "" ? json_decode($row['about']) : "";
        $education = $row['education'] != "" ? json_decode($row['education']) : "";
        $experience = $row['experience'] != "" ? json_decode($row['experience']) : "";
        $skills = $row['skills'] != "" ? json_decode($row['skills']) : "";
        $socials = $row['socials'] != "" ? json_decode($row['socials']) : "";
        $projects = $row['projects'] != "" ? json_decode($row['projects']) : "";
    }
}
?>

<script>
    document.title = "Update Details | Portfolify"
    detailsPage.classList.add("active")
    templatesPage.classList.remove("active")
    homePage.classList.remove("active")
</script>
<main id="user-about">

    <!-- personal details -->
    <div class="row mb-5">
        <div class="card">
            <div class="card-title">
                <h3 class="text-center">About yourself</h3>
            </div>
            <hr>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-lg-4 col-md-4 col-sm-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="John" value="<?= isset($about->fname) ? $about->fname : "" ?>">
                            <label for="firstName">First name</label>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Doe" value="<?= isset($about->lname) ? $about->lname : "" ?>">
                            <label for="lastName">Last name</label>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="street" name="street" placeholder="23, M.G Road" value="<?= isset($about->street) ? $about->street : "" ?>">
                            <label for="street">Street</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-4 col-md-4 col-sm-3">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="city" name="city" placeholder="Pune" value="<?= isset($about->city) ? $about->city : "" ?>">
                            <label for="city">City</label>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="state" name="state" placeholder="Maharashtra" value="<?= isset($about->state) ? $about->state : "" ?>">
                            <label for="state">State</label>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="pincode" placeholder="411048" value="<?= isset($about->pincode) ? $about->pincode : "" ?>">
                            <label for="pincode">Pincode</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-4 col-md-4 col-sm-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="contact" name="contact" placeholder="+9184632691XX" value="<?= isset($about->contact) ? $about->contact : "" ?>">
                            <label for="contact">Contact</label>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-9">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Tell us about yourself in 4-5 lines" id="about-me" style="height: 100px" value="<?= isset($about->aboutMe) ? $about->aboutMe : "" ?>"><?= isset($about->aboutMe) ? $about->aboutMe : "" ?></textarea>
                            <label for="about-me">Tell us about yourself in 4-5 lines</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- social details -->
    <div class="row mb-5">
        <div class="card">
            <div class="card-title">
                <h3 class="text-center">Socials</h3>
                <small class="text-muted">Enter the urls of your social media accounts</small>
            </div>
            <hr>
            <div class="row align-items-end mb-3">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="website" name="website" placeholder="John" value="<?= isset($socials->website) ? $socials->website : "" ?>">
                        <label for="website" class="text-muted">Website link</label>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="instagram" name="instagram" placeholder="John" value="<?= isset($socials->instagram) ? $socials->instagram : "" ?>">
                        <label for="instagram" class="text-muted">Instagram link</label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="facebook" name="facebook" placeholder="John" value="<?= isset($socials->facebook) ? $socials->facebook : "" ?>">
                        <label for="facebook" class="text-muted">Facebook link</label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Doe" value="<?= isset($socials->twitter) ? $socials->twitter : "" ?>">
                        <label for="twitter" class="text-muted">Twitter link</label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="23, M.G Road" value="<?= isset($socials->linkedin) ? $socials->linkedin : "" ?>">
                        <label for="linkedin" class="text-muted">LinkedIn link</label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="github" name="github" placeholder="23, M.G Road" value="<?= isset($socials->github) ? $socials->github : "" ?>">
                        <label for="github" class="text-muted">Github link</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- experience -->
    <div class="row mb-5">
        <div class="card">
            <div class="card-title">
                <h3 class="text-center">Experience</h3>
                <small class="text-muted">Add the positions you have held</small>
            </div>
            <hr>
            <div class="card-body exp-card">
                <?php
                if (isset($experience) && is_array($experience)) {
                    $expCnt = 0;
                    foreach ($experience as $exp) {
                        $expCnt++;
                ?>
                        <div class="exp-div">
                            <div class="row mb-3">
                                <div class="col-lg-4 col-md-4 col-sm-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="jobProfile<?= $expCnt ?>" name="jobProfile<?= $expCnt ?>" placeholder="" value="<?= isset($exp->jobProfile) ? $exp->jobProfile : "" ?>">
                                        <label for="jobProfile<?= $expCnt ?>">Job Profile</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="company<?= $expCnt ?>" name="company<?= $expCnt ?>" placeholder="" value="<?= isset($exp->company) ? $exp->company : "" ?>">
                                        <label for="company<?= $expCnt ?>">Company</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-3">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="start<?= $expCnt ?>" name="start<?= $expCnt ?>" placeholder="" value="<?= isset($exp->startDate) ? $exp->startDate : "" ?>">
                                        <label for="start<?= $expCnt ?>">Start date</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 align-items-end">
                                <div class="col-lg-4 col-md-4 col-sm-3 d-flex flex-column justify-content-between">
                                    <div>
                                        <input type="checkbox" class="mb-3 current-working" id="current-<?= $expCnt ?>" name="current-<?= $expCnt ?>" <?= (isset($exp->endDate) && $exp->endDate == "present") ? "checked" : "" ?>>
                                        <label for="current-<?= $expCnt ?>" class="text-muted">Currently working here</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="end<?= $expCnt ?>" name="end<?= $expCnt ?>" placeholder="" <?= (isset($exp->endDate) && $exp->endDate != "present") ? $exp->endDate : "" ?> <?= (isset($exp->endDate) && $exp->endDate == "present") ? "disabled" : "" ?>>
                                        <label for="end<?= $expCnt ?>">End date</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="city<?= $expCnt ?>" name="city<?= $expCnt ?>" placeholder="" value="<?= isset($exp->city) ? $exp->city : "" ?>">
                                        <label for="city<?= $expCnt ?>">City</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="country<?= $expCnt ?>" name="country<?= $expCnt ?>" placeholder="" value="<?= isset($exp->country) ? $exp->country : "" ?>">
                                        <label for="country<?= $expCnt ?>">Country</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Tell us about yourself in 4-5 lines" id="summ<?= $expCnt ?>" name="summ<?= $expCnt ?>" style="height: 100px" value="<?= isset($exp->summ) ? $exp->summ : "" ?>"> <?= isset($exp->summ) ? $exp->summ : "" ?></textarea>
                                        <label for="summ<?= $expCnt ?>">Write brief summary about your roles, responsibilites and technologies used</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                <?php
                    }
                }
                ?>
                <div class="row mb-3" id="exp-before-div">
                    <div class="col d-flex align-items-center justify-content-between p-3 border bg-light">
                        <span class="text-muted">Add an experience</span>
                        <button class="btn btn-primary btn-sm exp-btn"> <i class="fa fa-plus"></i> Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- educational details -->
    <div class="row mb-5">
        <div class="card">
            <div class="card-title">
                <h3 class="text-center">Education</h3>
                <small class="text-muted">Add information about your education</small>
            </div>
            <hr>
            <div class="card-body edu-card">
                <?php
                if (isset($education) && is_array($education)) {
                    $eduCnt = 0;
                    foreach ($education as $edu) {
                        $eduCnt++;
                ?>
                        <div class="edu-div">
                            <div class="row mb-3">
                                <div class="col-lg-4 col-md-4 col-sm-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="uni<?= $eduCnt ?>" name="uni<?= $eduCnt ?>" placeholder="" value="<?= isset($edu->university) ? $edu->university : "" ?>">
                                        <label for="uni<?= $eduCnt ?>">University / School name</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="deg<?= $eduCnt ?>" name="deg<?= $eduCnt ?>" placeholder="" value="<?= isset($edu->degree) ? $edu->degree : "" ?>">
                                        <label for="deg<?= $eduCnt ?>">Degree name</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="perc-edu<?= $eduCnt ?>" name="perc-edu<?= $eduCnt ?>" placeholder="" value="<?= isset($edu->perc) ? $edu->perc : "" ?>">
                                        <label for="perc-edu<?= $eduCnt ?>">Percentage / CGPA</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 align-items-end">
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="start-edu<?= $eduCnt ?>" name="start-edu<?= $eduCnt ?>" placeholder="" value="<?= isset($edu->startDate) ? $edu->startDate : "" ?>">
                                        <label for="start-edu<?= $eduCnt ?>">Start date</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="end-edu<?= $eduCnt ?>" name="end-edu<?= $eduCnt ?>" placeholder="" value="<?= isset($edu->endDate) ? $edu->endDate : "" ?>">
                                        <label for="end-edu<?= $eduCnt ?>">End date</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="city-edu<?= $eduCnt ?>" name="city-edu<?= $eduCnt ?>" placeholder="" value="<?= isset($edu->city) ? $edu->city : "" ?>">
                                        <label for="city-edu<?= $eduCnt ?>">City</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 align-items-start">
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="country-edu<?= $eduCnt ?>" name="country-edu<?= $eduCnt ?>" placeholder="" value="<?= isset($edu->country) ? $edu->country : "" ?>">
                                        <label for="country-edu<?= $eduCnt ?>">Country</label>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="" id="summ-edu<?= $eduCnt ?>" name="summ-edu<?= $eduCnt ?>" style="height: 100px" value="<?= isset($edu->summary) ? $edu->summary : "" ?>"><?= isset($edu->summary) ? $edu->summary : "" ?>"</textarea>
                                        <label for="summ-edu<?= $eduCnt ?>">Write in brief about your degree details and other accounts.</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                <?php
                    }
                }
                ?>
                <div class="row mb-3" id="edu-before-div">
                    <div class="col d-flex align-items-center justify-content-between p-3 border bg-light">
                        <span class="text-muted">Add education</span>
                        <button class="btn btn-primary btn-sm edu-btn"> <i class="fa fa-plus"></i> Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- projects details -->
    <div class="row mb-5">
        <div class="card">
            <div class="card-title">
                <h3 class="text-center">Projects</h3>
                <small class="text-muted">Add the projects you have made.</small>
            </div>
            <hr>
            <div class="card-body proj-card">
                <?php
                if (isset($projects) && is_array($projects)) {
                    $projCnt = 0;
                    foreach ($projects as $proj) {
                        $projCnt++;
                ?>
                        <div class="row mb-3 proj-div">
                            <h6>Project <?= $projCnt ?> details</h6>
                            <div class="col-lg-4 col-md-4 col-sm-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="projtitle<?= $projCnt ?>" name="projtitle<?= $projCnt ?>" placeholder="" value="<?= isset($proj->title) ? $proj->title : "" ?>">
                                    <label for="projtitle<?= $projCnt ?>">Project Title</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="repo-url<?= $projCnt ?>" name="repo-url<?= $projCnt ?>" placeholder="" value="<?= isset($proj->repoUrl) ? $proj->repoUrl : "" ?>">
                                    <label for="repo-url<?= $projCnt ?>">Project Repository URL</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="proj-url<?= $projCnt ?>" name="proj-url<?= $projCnt ?>" placeholder="" value="<?= isset($proj->projUrl) ? $proj->projUrl : "" ?>">
                                    <label for="proj-url<?= $projCnt ?>">Project URL</label>
                                </div>
                            </div>
                        </div>
                        <hr>
                <?php
                    }
                }
                ?>
                <div class="row mb-3" id="proj-before-div">
                    <div class="col d-flex align-items-center justify-content-between p-3 border bg-light">
                        <span class="text-muted">Add project</span>
                        <button class="btn btn-primary btn-sm proj-btn"> <i class="fa fa-plus"></i> Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- skills details -->
    <div class="row mb-5">
        <div class="card">
            <div class="card-title">
                <h3 class="text-center">Skills</h3>
                <small class="text-muted">Add your skills</small>
                <form onsubmit="addSkill(event)">
                    <div class="row align-items-center">
                        <div class="col-md-11 col-lg-11">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="skill" name="skill" placeholder="">
                                <label for="skill" class="text-muted">Skill</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-lg-1">
                            <button type="button" class="btn btn-sm btn-primary" id="skill-btn"><i class="fa fa-plus"></i> Add</button>
                        </div>
                    </div>
                </form>
            </div>
            <hr>
            <div class="card-body skills-card">
                <div class="row" id="my-grid-new">
                    <!-- <div class="my-grid"> -->
                    <?php
                    if (isset($skills) && is_array($skills)) {
                        $skillCnt = 0;
                        foreach ($skills as $skill) {
                            $skillCnt++;
                    ?>
                            <div class="col-lg-2 col-md-2 skill-div mb-4">
                                <!-- <div class="d-flex align-items-center skill-div"> -->
                                <span class="tag bg-info text-white rounded p-2">
                                    <span class="skill-name skill-<?= $skillCnt ?>"><?= $skill ?></span>
                                    <a onclick="$(this).closest('.skill-div').remove();"><i class="fa-solid fa-xmark"></i></a>
                                </span>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- agree checkbox div -->
    <div class="row">
        <div class="card">
            <div class="card-body edu-card">
                <div class="row align-items-center">
                    <div class="col-md-9 col-lg-9 text-center">
                        <input type="checkbox" name="confirmation" id="confirmation">
                        <label for="confirmation"> I agree that the above information is correct</label>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <button class="btn btn-sm btn-primary" id="save-details" onclick="saveDetails()" disabled>
                            Save details
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    let exps = <?= isset($expCnt) ? $expCnt : 0 ?>;
    let edus = <?= isset($eduCnt) ? $eduCnt : 0 ?>;
    let proj = <?= isset($projCnt) ? $projCnt : 0 ?>;
    let skills = <?= isset($skillCnt) ? $skillCnt : 0 ?>;

    $(function() {
        $('#confirmation').click(function() {
            if ($(this).is(':checked')) {
                $('#save-details').removeAttr('disabled');
            } else {
                $('#save-details').attr('disabled', 'disabled');
            }
        });
    });

    $(".exp-btn").on("click", function() {
        //increment no. of experiences
        exps++;

        // create new div to add experience
        appendExpDiv();
    })

    $(".edu-btn").on("click", function() {
        //increment no. of education
        edus++;

        // create new div to add education
        appendEduDiv();
    })

    $(".proj-btn").on("click", function() {
        //increment no. of projects
        proj++;

        // create new div to add education
        appendProjDiv();
    })

    $("#skill-btn").on("click", function() {
        //increment no. of skills
        skills++;
        // console.log("event listener skill", skills);

        // create new div to add skills
        appendSkillsDiv();
    })

    function addSkill(e) {
        e.preventDefault();
        skills++;
        // console.log("add skill func", skills);
        appendSkillsDiv();
    }

    function appendExpDiv() {
        let expDiv = `<div class="exp-div">
                    <div class="row mb-3">
                        <div class="col-lg-4 col-md-4 col-sm-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="jobProfile${exps}" name="jobProfile${exps}" placeholder="">
                                <label for="jobProfile${exps}">Job Profile</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="company${exps}" name="company${exps}" placeholder="">
                                <label for="company${exps}">Company</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-3">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="start${exps}" name="start${exps}" placeholder="">
                                <label for="start${exps}">Start date</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col-lg-4 col-md-4 col-sm-3 d-flex flex-column justify-content-between">
                            <div>
                                <input type="checkbox" class="mb-3 current-working" id="current-${exps}" name="current-${exps}">
                                <label for="current-${exps}" class="text-muted">Currently working here</label>
                            </div>
                            <div class="form-floating">
                                <input type="date" class="form-control" id="end${exps}" name="end${exps}" placeholder="">
                                <label for="end${exps}">End date</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="city${exps}" name="city${exps}" placeholder="">
                                <label for="city${exps}">City</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="country${exps}" name="country${exps}" placeholder="">
                                <label for="country${exps}">Country</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Tell us about yourself in 4-5 lines" id="summ${exps}" name="summ${exps}" style="height: 100px"></textarea>
                                <label for="summ${exps}">Write brief summary about your roles, responsibilites and technologies used</label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                `
        $(expDiv).insertBefore('#exp-before-div');

        $(".current-working").on("change", function(e) {
            let id = this.id.split("-")[1];
            if (id && this.checked) {
                $(`#end${id}`).prop("disabled", true)
                $(`#end${id}`).addClass("bg-light")
            } else {
                $(`#end${id}`).removeAttr("disabled")
                $(`#end${id}`).removeClass("bg-light")
            }

        })
    }

    function appendEduDiv() {
        let eduDiv = `<div class="edu-div">
                    <div class="row mb-3">
                        <div class="col-lg-4 col-md-4 col-sm-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="uni${edus}" name="uni${edus}" placeholder="">
                                <label for="uni${edus}">University / School name</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="deg${edus}" name="deg${edus}" placeholder="">
                                <label for="deg${edus}">Degree name</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="perc-edu${edus}" name="perc-edu${edus}" placeholder="">
                                <label for="perc-edu${edus}">Percentage / CGPA</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="start-edu${edus}" name="start-edu${edus}" placeholder="">
                                <label for="start-edu${edus}">Start date</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="end-edu${edus}" name="end-edu${edus}" placeholder="">
                                <label for="end-edu${edus}">End date</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="city-edu${edus}" name="city-edu${edus}" placeholder="">
                                <label for="city-edu${edus}">City</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-start">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="country-edu${edus}" name="country-edu${edus}" placeholder="">
                                <label for="country-edu${edus}">Country</label>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="" id="summ-edu${edus}" name="summ-edu${edus}" style="height: 100px"></textarea>
                                <label for="summ-edu${edus}">Write in brief about your degree details and other accounts.</label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                `
        $(eduDiv).insertBefore('#edu-before-div');
    }

    function appendProjDiv() {
        let projDiv = `
            <div class="row mb-3 proj-div">
                <h6>Project ${proj} details</h6>
                <div class="col-lg-4 col-md-4 col-sm-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="projtitle${proj}" name="projtitle${proj}" placeholder="">
                        <label for="projtitle${proj}">Project Title</label>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="repo-url${proj}" name="repo-url${proj}" placeholder="">
                        <label for="repo-url${proj}">Project Repository URL</label>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="proj-url${proj}" name="proj-url${proj}" placeholder="">
                        <label for="proj-url${proj}">Project URL</label>
                    </div>
                </div>
            </div>
            <hr>
        `;
        $(projDiv).insertBefore('#proj-before-div');
    }

    function appendSkillsDiv() {
        let skill = $("#skill").val().trim();
        if (skill == "") {
            return;
        }
        // <div class="d-flex align-items-center skill-div">
        let skillDiv = `
                    <div class="col-lg-2 col-md-2 skill-div mb-4">
                        <span class="tag bg-info text-white rounded p-2">
                            <span class="skill-name skill-${skills}">${skill}</span>
                            <a onclick="$(this).closest('.skill-div').remove();"><i class="fa-solid fa-xmark"></i></a>
                        </span>
                    </div>`
        $("#my-grid-new").append(skillDiv);
        // $(".my-grid").append(skillDiv);
        $("#skill").val("");
    }

    function getAboutData() {
        const data = {
            "fname": $("#firstName").val(),
            "lname": $("#lastName").val(),
            "street": $("#street").val(),
            "city": $("#city").val(),
            "state": $("#state").val(),
            "pincode": $("#pincode").val(),
            "contact": $("#contact").val(),
            "aboutMe": $("#about-me").val(),
        }

        for (var key of Object.keys(data)) {
            // console.log(key + " -> " + data[key])
            if (data[key] == "") {
                return false
            }
        }
        // console.log("about data: ", data);
        return data;
    }

    function getExpData() {
        let data = [];
        let expDivs = $(".exp-div");
        expDivs.each((i, d) => {
            let endInput = $(d).find(`#end${i + 1}`);
            let endDate = "";
            if (endInput.prop('disabled')) {
                endDate = "present"
            } else {
                endDate = $(d).find(`#end${i + 1}`).val()
            }
            let info = {
                "jobProfile": $(d).find(`#jobProfile${i + 1}`).val(),
                "company": $(d).find(`#company${i + 1}`).val(),
                "startDate": $(d).find(`#start${i + 1}`).val(),
                "city": $(d).find(`#city${i + 1}`).val(),
                "country": $(d).find(`#country${i + 1}`).val(),
                "endDate": endDate,
                "summ": $(d).find(`#summ${i + 1}`).val(),
            }
            data.push(info)
        })
        // console.log("exp data: ", data);
        return data;
    }

    function getEduData() {
        let data = [];
        let eduDivs = $(".edu-div");
        eduDivs.each((i, d) => {
            let info = {
                "university": $(d).find(`#uni${i + 1}`).val(),
                "degree": $(d).find(`#deg${i + 1}`).val(),
                "startDate": $(d).find(`#start-edu${i + 1}`).val(),
                "endDate": $(d).find(`#end-edu${i + 1}`).val(),
                "city": $(d).find(`#city-edu${i + 1}`).val(),
                "country": $(d).find(`#country-edu${i + 1}`).val(),
                "summary": $(d).find(`#summ-edu${i + 1}`).val(),
                "perc": $(d).find(`#perc-edu${i + 1}`).val(),
            }
            data.push(info)
        })
        // console.log("edu data", data);
        return data;
    }

    function getProjData() {
        let data = [];
        let projDivs = $(".proj-div");
        projDivs.each((i, d) => {
            let info = {
                "title": $(d).find(`#projtitle${i + 1}`).val(),
                "repoUrl": $(d).find(`#repo-url${i + 1}`).val(),
                "projUrl": $(d).find(`#proj-url${i + 1}`).val(),
            }
            data.push(info)
        })
        // console.log("proj data", data);
        return data;
    }

    function getSkillsData() {
        let data = [];
        let skillName = $(".skill-name");
        // console.log("skills ", skillName);
        if (skillName.length == 0) {
            return []
        }
        skillName.each((i, d) => {
            data.push($(d).text());
        })
        // console.log("skills ", data);
        return data;
    }

    function getSocialsData() {
        const data = {
            "website": $("#website").val(),
            "instagram": $("#instagram").val(),
            "facebook": $("#facebook").val(),
            "twitter": $("#twitter").val(),
            "linkedin": $("#linkedin").val(),
            "github": $("#github").val(),
        }
        // console.log("social data: ", data);
        return data;
    }

    async function showAlert(icon, text, title, showCancelButton) {
        const result = await Swal.fire({
            icon: icon,
            title: title,
            text: text,
            showCancelButton: showCancelButton,
            confirmButtonText: 'Okay',
            cancelButtonText: 'Cancel'
        })
        // console.log("res ", result.isConfirmed, result);
        return result.isConfirmed;
    }

    function saveDetails() {
        const aboutData = getAboutData();
        const expData = getExpData();
        const eduData = getEduData();
        const skillsData = getSkillsData();
        const socialsData = getSocialsData();
        const projData = getProjData();

        if (aboutData === false || expData === false || eduData === false || skillsData === false || socialsData === false || projData === false) {
            // showAlert('warning','Insufficient data', '')
        }

        const data = {
            "action": "savedetails",
            "about": aboutData,
            "socials": socialsData
        }

        if (expData.length != 0) {
            data['experience'] = expData;
        }

        if (eduData.length != 0) {
            data['education'] = eduData;
        }

        if (skillsData.length != 0) {
            data['skills'] = skillsData;
        }
        if (projData.length != 0) {
            data['projects'] = projData;
        }

        console.log("data", data);

        $.ajax({
            type: "POST",
            url: "../api/api_info.php",
            data: data,
            success: async function(d, s) {
                // console.log("resp ", d);
                const resp = JSON.parse(d)
                await Swal.fire({
                    title: 'Yay!',
                    text: 'Details saved successfully',
                    icon: 'success',
                    confirmButtonText: 'Okay'
                });
                if (resp['status'] == "success") {
                    window.location.href = "./home.php"
                }
            },
        });
    }
</script>
<?php
include("../includes/header_bottom.php");
?>