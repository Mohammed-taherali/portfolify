<?php
include("../includes/header_top.php");
?>
<script>
    document.title = `Login | Portfolify`
</script>
<!-- Section: Design Block -->
<style>
    body {
        padding: 0 1em;
        margin-top: 1em;
    }
</style>
<section class="">
    <!-- Jumbotron -->
    <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%); min-height: 100vh">
        <div class="container">
            <div class="row gx-lg-5 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="my-5 display-3 fw-bold ls-tight">
                        Portfolify: <br />
                        <span class="text-primary" style="font-size: 2.5rem;">Your Professional Odyssey</span>
                    </h1>
                    <p style="color: hsl(217, 10%, 50.8%)">
                        Embark on your professional odyssey with Portfolify, the premier platform for IT professionals to showcase their expertise and accomplishments. Craft your personalized portfolio effortlessly and share your journey with the world.
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="card">
                        <div class="card-body py-5 px-md-5">
                            <h3 class="text-center mb-5">Login to Portfolify</h3>
                            <div id="emsg" style="display: none;" class="alert alert-danger"></div>
                            <form onsubmit="submitForm(event)">

                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="useremail">Email address<sup class="text-danger">*</sup></label>
                                    <input autocomplete="username" autofocus type="email" required id="useremail" class="form-control" />
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="password">Password<sup class="text-danger">*</sup></label>
                                    <input autocomplete="current-password" type="password" required id="password" class="form-control" />
                                </div>

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary btn-block mb-4">
                                    Login
                                </button>
                            </form>
                            <small><a href="./signup.php">New User? Sign up</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->
<script>
    function validEmail(email) {
        return String(email)
            .toLowerCase()
            .match(
                /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            );
    }

    function submitForm(e) {
        e.preventDefault();
        const email = $("#useremail").val();
        const pass = $("#password").val();

        if (!validEmail(email)) {
            $("#emsg").show();
            $("#emsg").text("Invalid email");
            setTimeout(() => {
                $("#emsg").hide();
            }, 3000);
            return;
        }

        const data = {
            action: "login",
            email: email,
            pass: pass
        }

        $.ajax({
            type: "POST",
            url: "../api/api_login.php",
            data: data,
            success: function(d, s) {
                const resp = JSON.parse(d)
                // console.log("res: ", resp['status']);
                if (resp['status'] == "success") {
                    window.location.href = "./home.php"
                }
                if (resp['status'] == "unauthorized" || resp['status'] == "failure") {
                    $("#emsg").show();
                    $("#emsg").text(resp['msg']);
                    setTimeout(() => {
                        $("#emsg").hide();
                    }, 3000);
                    return;
                }
            },
            // dataType: dataType
        });

    }
</script>
<?php
include("../includes/header_bottom.php");
?>