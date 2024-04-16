<?php
include("../includes/header_top.php");
include("../config/session.php");
include("../config/config.php");

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
?>
<main>

    <!-- Personal details -->
    <div class="row mb-5">
        <div class="card">
            <div class="card-title">
                <h3 class="text-center">Personal details</h3>
            </div>
            <hr>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-lg-4 col-md-4 col-sm-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="<?= isset($about->fname) ? $about->fname : "" ?>">
                            <label for="firstName">First name</label>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="<?= isset($about->lname) ? $about->lname : "" ?>">
                            <label for="lastName">Last name</label>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="street" name="street" placeholder="" value="<?= isset($about->street) ? $about->street : "" ?>">
                            <label for="street">Street</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-4 col-md-4 col-sm-3">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="city" name="city" placeholder="" value="<?= isset($about->city) ? $about->city : "" ?>">
                            <label for="city">City</label>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="state" name="state" placeholder="" value="<?= isset($about->state) ? $about->state : "" ?>">
                            <label for="state">State</label>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="pincode" placeholder="" value="<?= isset($about->pincode) ? $about->pincode : "" ?>">
                            <label for="pincode">Pincode</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-4 col-md-4 col-sm-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="contact" name="contact" placeholder="" value="<?= isset($about->contact) ? $about->contact : "" ?>">
                            <label for="contact">Contact</label>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-9">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="" id="about-me" value="<?= isset($about->aboutMe) ? $about->aboutMe : "" ?>" style="min-height: 150px"><?= isset($about->aboutMe) ? $about->aboutMe : "" ?></textarea>
                            <label for="about-me">Tell us about yourself in 4-5 lines</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Social details -->
    <div class="row mb-5">
        <div class="card">
            <div class="card-title">
                <h3 class="text-center">Socials</h3>
            </div>
            <hr>
            <div class="row align-items-end mb-3">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="website" name="website" placeholder="" value="<?= isset($socials->website) ? $socials->website : "" ?>">
                        <label for="website" class="text-muted">Website link</label>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="instagram" name="instagram" placeholder="" value="<?= isset($socials->instagram) ? $socials->instagram : "" ?>">
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
                        <input type="text" class="form-control" id="twitter" name="twitter" placeholder="" value="<?= isset($socials->twitter) ? $socials->twitter : "" ?>">
                        <label for="twitter" class="text-muted">Twitter link</label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="" value="<?= isset($socials->linkedin) ? $socials->linkedin : "" ?>">
                        <label for="linkedin" class="text-muted">LinkedIn link</label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="github" name="github" placeholder="" value="<?= isset($socials->github) ? $socials->github : "" ?>">
                        <label for="github" class="text-muted">Github link</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- experience details -->
    <div class="row mb-5">
        <div class="card">
            <div class="card-title">
                <h3 class="text-center">Experience</h3>
                <!-- <small class="text-muted">Add the positions you have held</small> -->
            </div>
            <hr>
            <?php
            if (is_array($experience)) {
                $expCnt = 0;
                foreach ($experience as $exp) {
                    $expCnt++;
            ?>
                    <div class="card-body exp-card">
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
                    </div>
            <?php
                }
            }
            ?>
            <div class="mb-3" id="exp-before-div">
                <div class="col d-flex align-items-center justify-content-between p-3 border bg-light">
                    <span class="text-muted">Add an experience</span>
                    <button class="btn btn-primary btn-sm exp-btn"> <i class="fa fa-plus"></i> Add</button>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include("../includes/header_bottom.php");
?>