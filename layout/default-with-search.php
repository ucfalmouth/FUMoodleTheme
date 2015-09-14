<?php
/**
Used by coursecategory
**/

$search_clean = "";
if (isset($_GET["search"])) {
    $search_clean = s($_GET["search"]);
}

include_once('partials/_init.php');
// declares: hassidepre hassidepost knownregionpre knownregionpost regions setzoom

$PAGE->set_popup_notification_allowed(false);

include_once('partials/head.php');

?>

<body <?php echo $OUTPUT->body_attributes($setzoom); ?>>

<?php

include_once('partials/user_roles_hack.php');

echo $OUTPUT->standard_top_of_body_html();

include_once('partials/navbar.php');

?>



<div id="outerwrapper">

    <div id="page" class="container">

        <header id="page-header" class="page-header-borderered">
            <div class="row">
                <div class="col-sm-8">
                    <div id="page-navbar">
                        <nav class="breadcrumb-nav" role="navigation" aria-label="breadcrumb">
                            <?php 
                            echo $OUTPUT->navbar(); 
                            ?>
                        </nav>
                        
                        <!-- <div class="breadcrumb-button"><?php echo $OUTPUT->page_heading_button(); ?></div> -->
                        <?php if ($knownregionpre || $knownregionpost) { ?>
                            <!-- <div class="breadcrumb-button"> <?php echo $OUTPUT->content_zoom(); ?></div> -->
                        <?php } ?>
                    </div>
                </div>

                <div class="col-sm-4 block-region-side-post">
                    <?php include_once('partials/search.php'); ?>
                </div>

            </div>
        </header>

        <div id="page-content" class="row">
            <div id="region-main" class="<?php echo $regions['content']; ?>">
                <div class="padded-horiz-15">
                    <?php
                    echo $OUTPUT->course_content_header();

                    echo $OUTPUT->main_content();
                    echo $OUTPUT->course_content_footer();
                    ?>
                </div>
            </div>

            <?php
            if ($knownregionpre) {
                echo $OUTPUT->blocks('side-pre', $regions['pre']);
            }?>
            <?php
            if ($knownregionpost) {
                // include_once('partials/search.php');
                echo $OUTPUT->blocks('side-post', $regions['post']);
            }?>
        </div>

        <footer id="page-footer">
            <div id="course-footer"><?php echo $OUTPUT->course_footer(); ?></div>
            <p class="helplink"><?php echo $OUTPUT->page_doc_link(); ?></p>
            <?php
            // echo $OUTPUT->login_info();
            // echo $OUTPUT->home_link();
            // echo $OUTPUT->standard_footer_html();
            ?>
        </footer>


    </div>

</div><!-- END OF OUTER WRAPPER -->

<?php

include_once('partials/footer.php');


// careful - if this line is outputted multiple times your javascript goes to hell
echo $OUTPUT->standard_end_of_body_html();
?>
</body>
</html>