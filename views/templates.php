<?php
include("../includes/header_top.php");
include("../config/session.php");
include("../config/config.php");
?>

<script>
    document.title = "My templates | Portfolify"
    templatesPage.classList.add("active")
    homePage.classList.remove("active")
    detailsPage.classList.remove("active")
</script>
<section>
    <h3 id="template-header">My Templates <i class="fa-solid fa-wand-magic-sparkles"></i></h3>
    <?php
    $user_id = $_COOKIE['userid'];
    $files = scandir("../users/$user_id");
    $temp_cnt = 0;
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            $sourceFile = "../users/$user_id/" . $file;
            if (is_dir($sourceFile)) {
                $temp_cnt++;
    ?>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="heading-name">Template <?= $temp_cnt ?></h5>
                    <button class="btn btn-sm btn-primary" onclick="downloadTemplate('<?= $file ?>')">Re-download</button>
                </div>
                <iframe src="<?= $sourceFile ?>" frameborder="0" class="template-iframe"></iframe>
                <div class="line-break"></div>
    <?php
            }
        }
    }
    ?>
</section>

<script>
    function downloadTemplate(template) {
        console.log("template: ", template);
        window.location.href = `../api/api_details.php?action=downloadfile&template=${template}`
    }
</script>

<?php
include("../includes/header_bottom.php");
?>