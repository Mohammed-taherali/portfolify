<?php
include("../includes/header_top.php");
include("../config/session.php");
include("../config/config.php");

if (!isset($_GET['id'])) {
    header("Location: ./home.php");
    exit;
}
?>
<input hidden type="text" name="temp_id" id="temp_id" value="<?php echo $_GET['id'] ?>">
<script>
    const id = document.getElementById('temp_id').value
    document.title = `Details for template ${id}`
</script>
<?php
// echo $_GET['id'];
// questions for template 1
if ($_GET['id'] == "1") {
?>
    <div>
        question 1
    </div>
<?php
}
// questions for template 2
else if ($_GET['id'] == "2") {
?>
    <section id="temp2">
        <div class="row mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="userimg" class="mb-2">Upload your profile photo</label>
                            <input type="file" accept="image/*" name="userimg" id="userimg" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-end">
            <button class="btn btn-sm btn-success" onclick="generate_2()">Generate my porfolio!</button>
        </div>
    </section>
<?php
}
// }
// questions for template 6
else if ($_GET['id'] == "6" || $_GET['id'] == "5") {
    $user_id = $_COOKIE['userid'];
    // id, email, password, about, experience, skills, contact, custom1, custom2, custom3, education
    $sql = "SELECT skills, projects from users where id = $user_id";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $skills = isset($row['skills']) ? json_decode($row['skills']) : "";
        $projects = isset($row['projects']) ? json_decode($row['projects']) : "";
    }

?>
    <section id="temp2">
        <div class="row mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-end mb-3">
                        <h3>Social data</h3>
                        <p>Please upload your profile image</p>
                        <hr>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="userimg" class="mb-2">Profile photo</label>
                            <input type="file" accept="image/*" name="userimg" id="userimg" class="form-control text-muted">
                        </div>
                    </div>
                    <?php
                    if ($_GET['id'] == "5") {
                    ?>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="current_desig" name="current_desig" placeholder="">
                                    <label for="current_desig">Current designation</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="dob" name="dob" placeholder="">
                                    <label for="dob">Date of birth</label>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <hr>
                    <h3>Skills Data</h3>
                    <p>Please enter the percent of expertise in each of your skills</p>
                    <hr>
                    <div class="row">
                        <?php
                        if (is_array($skills)) {
                            foreach ($skills as $skill) {
                        ?>
                                <div class="col-lg-3 col-md-3 col-sm-3 skill-cnt mb-3">
                                    <div class="form-floating">
                                        <input type="number" min="0" max="100" class="form-control skill-value" id="<?= $skill ?>" name="<?= $skill ?>" placeholder="">
                                        <label for="<?= $skill ?>" class="text-muted"><?= $skill ?></label>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <h3>Projects data</h3>
                    <p>Add header images of your projects</p>
                    <div class="card-body proj-card">
                        <div class="row mb-3" id="proj-before-div">
                            <?php
                            if (is_array($projects)) {
                                $projCnt = 0;
                                foreach ($projects as $proj) {
                                    $projCnt++;
                            ?>
                                    <div class="col-md-3 col-lg-3 proj-detail-div">
                                        <input type="text" hidden value="<?= $proj->repoUrl ?>" id="repo<?= $projCnt ?>">
                                        <input type="text" hidden value="<?= $proj->projUrl ?>" id="url<?= $projCnt ?>">
                                        <input type="text" hidden value="<?= $proj->title ?>" id="projTitle<?= $projCnt ?>">
                                        <label for="<?= $proj->title ?>" class="mb-2"><?= $proj->title ?></label>
                                        <input type="file" accept="image/*" name="<?= $proj->title ?>" id="projImg<?= $projCnt ?>" class="form-control text-muted proj-img">
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-end">
            <button class="btn btn-sm btn-success" onclick="generate_5_and_6()">Generate my porfolio!</button>
        </div>
    </section>
<?php
}
?>
<script>
    function getBase64(file) {
        return new Promise((resolve, reject) => {
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function() {
                resolve(reader.result.split(',')[1]); // Resolve with base64 value excluding data URL scheme
            };
            reader.onerror = function(error) {
                console.log('Error: ', error);
                reject(error);
            };
        });
    }

    // var file = document.querySelector('#files > input[type="file"]').files[0];
    // getBase64(file);

    async function generate_2() {
        let file = document.getElementById("userimg").files[0];
        let file_base_64 = "";
        if (file) {
            file_base_64 = await getBase64(file)
            file_base_64 = file_base_64.substr(file_base_64.indexOf(",") + 1);
            // console.log("file blob: ", file_base_64);
        } else {
            // console.log("no file");
        }
        const data = {
            "img": file_base_64,
            // "temp_id": $("#temp_id").val(),
            // "facebook": $("#facebook").val(),
            // "twitter": $("#twitter").val(),
            // "linkedin": $("#linkedin").val(),
            // "github": $("#github").val(),
        }

        $.ajax({
            type: "POST",
            url: "../api/api_details.php?tempid=2",
            data: data,
            success: function(d, s, xhr) {
                // console.log("resp ", d);
                const resp = JSON.parse(d);
                if (resp['status'] === "success") {
                    window.location.href = "../api/api_details.php?action=downloadfile"
                }
            },
        });
    }

    function getSkillsData_6() {
        let data = [];
        let skillValue = $(".skill-value");
        // console.log("skills ", skillValue);
        if (skillValue.length == 0) {
            return []
        }
        skillValue.each((i, d) => {
            data.push({
                "skill": $(d).prop("id"),
                "value": $(d).val()
            });
        })
        console.log("skills ", data);
        return data;
    }

    function getProjData_6() {
        let d = [];
        let images = [];
        let fileDiv = $(".proj-detail-div")
        if (fileDiv.length == 0) {
            return []
        }
        fileDiv.each(async (index, data) => {
            const projTitle = $(data).find(`#projTitle${index + 1}`).val();
            const repoUrl = $(data).find(`#repo${index + 1}`).val();
            const projUrl = $(data).find(`#url${index + 1}`).val();
            d.push({
                "projName": projTitle,
                "repoUrl": repoUrl,
                "projUrl": projUrl,
            })
        })
        // console.log("data ", d);
        return d
    }

    function getProjData_images_6() {
        let images = [];
        let fileDiv = $(".proj-detail-div")
        console.log("file divs: ", fileDiv);
        if (fileDiv.length == 0) {
            return []
        }
        fileDiv.each(async (index, data) => {
            const file = $(data).find(`#projImg${index + 1}`)[0].files[0]
            let file_base_64 = "";
            if (file) {
                file_base_64 = await getBase64(file)
                file_base_64 = file_base_64.substr(file_base_64.indexOf(",") + 1);
                images.push(file_base_64)
            }
        })
        // console.log("data ", d);
        return images
    }

    async function generate_5_and_6() {
        const temp_id = $("#temp_id").val()
        // console.log("temp id", temp_id, typeof temp_id);
        let desig, dob;
        if (temp_id == "5") {
            // console.log("inside if");
            desig = $("#current_desig").val()
            dob = $("#dob").val()
        }
        let file = document.getElementById("userimg").files[0];
        let file_base_64 = "";
        if (file) {
            file_base_64 = await getBase64(file)
            file_base_64 = file_base_64.substr(file_base_64.indexOf(",") + 1);
            // console.log("file blob: ", file_base_64);
        }
        const skillsData = getSkillsData_6();
        let projData = getProjData_6();
        let projImg = getProjData_images_6();
        console.log("proj img: ", projImg);
        const data = {
            "img": file_base_64,
            "temp_id": $("#temp_id").val(),
            "skills": skillsData,
            "projects": projData,
            "desig": desig,
            "dob": dob
        }
        console.log("293 final data ", data);

        $.ajax({
            type: "POST",
            url: `../api/api_details.php?tempid=${temp_id}`,
            // url: "../api/api_details.php?tempid=6",
            data: data,
            success: function(d, s, xhr) {
                console.log("d ", d);

                const resp = JSON.parse(d);
                if (resp['status'] === "success") {
                    let imgData = {
                        "images": projImg,
                    }
                    console.log("projimg", projImg);
                    if (projImg.length > 0) {
                        if (temp_id == "5") {
                            // 'base_path': "../temporary/assets/images/projects/"
                            imgData['base_path'] = "../temporary/img/gallery/"
                            imgData['abs_path'] = "img/gallery/"
                            imgData['temp_id'] = "5"
                        } else if (temp_id == "6") {
                            imgData['base_path'] = "../temporary/assets/images/projects/"
                            imgData['abs_path'] = "assets/images/projects/"
                            imgData['temp_id'] = "6"
                        }
                        $.ajax({
                            type: "POST",
                            url: "../api/api_details.php?action=save_proj_images",
                            data: imgData,
                            success: function(d) {
                                let r = JSON.parse(d);
                                if (r['status'] === "success") {
                                    window.location.href = "../api/api_details.php?action=downloadfile"
                                }
                            },
                        });
                    } else {
                        window.location.href = "../api/api_details.php?action=downloadfile"
                    }
                }
            },
        });
    }
</script>
<?php
include("../includes/header_bottom.php");
?>

<!-- test code -->
<!-- // let proj = 0;
    // $("#add-proj_6").on("click", function() {
    //     //increment no. of projects
    //     proj++;

    //     // create new div to add projects
    //     appendProjDiv_6();
    // })

    // function appendProjDiv_6() {
    //     let projDiv = `
    //         <div class="row align-items-end mb-3 proj-div">
    //             <div class="col-lg-3 col-md-3 col-sm-3">
    //                 <label for="projimg" class="mb-2">Upload image of project ${proj}</label>
    //                 <input type="file" accept="image/*" name="projimg${proj}" id="projimg${proj}" class="form-control text-muted">
    //             </div>
    //             <div class="col-lg-3 col-md-3 col-sm-3">
    //                 <div class="form-floating">
    //                     <input type="text" class="form-control" id="project${proj}" name="project${proj}" placeholder="John">
    //                     <label for="project${proj}" class="text-muted">Project name</label>
    //                 </div>
    //             </div>
    //             <div class="col-lg-3 col-md-3 col-sm-3">
    //                 <div class="form-floating">
    //                     <input type="text" class="form-control" id="githublink${proj}" name="githublink${proj}" placeholder="John">
    //                     <label for="githublink${proj}" class="text-muted">Project repository link</label>
    //                 </div>
    //             </div>
    //             <div class="col-lg-3 col-md-3 col-sm-3">
    //                 <div class="form-floating">
    //                     <input type="text" class="form-control" id="livelink${proj}" name="livelink${proj}" placeholder="23, M.G Road">
    //                     <label for="livelink${proj}" class="text-muted">Project url link</label>
    //                 </div>
    //             </div>
    //         </div>
    //         <hr>
    //     `;
    //     $(projDiv).insertBefore('#proj-before-div');
    // } -->