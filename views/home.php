<?php
include("../includes/header_top.php");
include("../config/session.php");
?>
<script>
    document.title = "Home | Portfolify"
    homePage.classList.add("active")
    templatesPage.classList.remove("active")
    detailsPage.classList.remove("active")
</script>

<main id="home-page">
    <div class="container-fluid">
        <h3 class="mb-3">Browse all the templates and use any you like!</h3>
        <div class="row mb-5">
            <div class="col-md-4 col-lg-4 co sm-2">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="../images/temp6.png" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Template 1</h5>
                        <!-- <p class="card-text"></p> -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a target="_blank" href="../templates/temp6/" class="btn btn-primary">View</a>
                            <!-- <a target="_blank" href="../details.php?id=6" class="btn btn-primary">Use</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 co sm-2">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="../images/temp2.png" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Template 2</h5>
                        <!-- <p class="card-text"></p> -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a target="_blank" href="../templates/temp2/" class="btn btn-primary">View</a>
                            <!-- <a target="_blank" href="../details.php?id=2" class="btn btn-primary">Use</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 co sm-2">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="../images/temp5.png" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Template 3</h5>
                        <!-- <h5 class="card-title">Template 5</h5> -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a target="_blank" href="../templates/temp5/" class="btn btn-primary">View</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-4 col-lg-4 co sm-2">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="../images/temp1.png" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Template 4</h5>
                        <!-- <p class="card-text"></p> -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a target="_blank" href="../templates/temp1/" class="btn btn-primary">View</a>
                            <!-- <a target="_blank" href="../details.php?id=1" class="btn btn-primary">Use</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 co sm-2">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="../images/temp3.png" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Template 5</h5>
                        <!-- <p class="card-text"></p> -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a target="_blank" href="../templates/temp3/" class="btn btn-primary">View</a>
                            <!-- <a target="_blank" href="../details.php?id=6" class="btn btn-primary">Use</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 co sm-2">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="../images/temp4.png" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Template 6</h5>
                        <!-- <p class="card-text"></p> -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a target="_blank" href="../templates/temp4/" class="btn btn-primary">View</a>
                            <!-- <a target="_blank" href="../details.php?id=6" class="btn btn-primary">Use</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- uncomment for using toasts -->
    <!-- <button type="button" class="btn btn-primary" id="liveToastBtn">Show live toast</button> -->

    <!-- bootstrap toast notification -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="#" class="rounded me-2" alt="...">
                <strong class="me-auto">Bootstrap</strong>
                <small>11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Hello, world! This is a toast message.
            </div>
        </div>
    </div>

</main>
<script>
    const toastTrigger = document.getElementById('liveToastBtn')
    const toastLiveExample = document.getElementById('liveToast')

    if (toastTrigger) {
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
        toastTrigger.addEventListener('click', () => {
            toastBootstrap.show()
        })
    }
</script>

<?php
include("../includes/header_bottom.php");
?>