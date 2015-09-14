<?php
/**
Used only by scip
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
                          <!-- Nav tabs -->
                            <ul class="nav nav-pills" role="tablist">
                              <li class="active"><a href="#my-modules" role="tab" data-toggle="tab">My Modules</a></li>
                              <li><a href="#course-information" role="tab" data-toggle="tab">Course Information</a></li>
                            </ul>
                        
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

<script>

+function ($) {
  'use strict';

  var $region_main = $("#region-main");
  var $cont = $region_main.find("div[role=main]");
  // console.log($cont);
  $cont.load("<?php echo $CFG->wwwroot; ?>/apps/scip/loadscip.php");

  var $block_region_side_post = $("#block-region-side-post");
  $block_region_side_post
    .html("")
    .load("<?php echo $CFG->wwwroot; ?>?forcehomepage=true #block-region-side-post .block_html");


    // Bootstrap tabs
    //$('#tabs').tab();

    // Personal tutor poper link
    $('#profile-popover').popover({
        trigger : "hover",
        html : true,
        content: function() {
            return $('#popoverExampleTwoHiddenContent').html();
        }
    });

    // Track clicks on tabs with Google analytics
    $(".nav-pills").on("click", "a", function(){
        var _this = this;
        ga('send', 'event', 'Blue pill nav', 'Click button', {
            'hitCallback': function() {
                // hitCallback, gets called once the click
                // has been logged. This is a quick check
                // to see if the callback has fired. 
                console.log("Logging the click");
            }
        });
    });
    // Track clicks on award doc dropdown
    $(".dropdown-menu--award-doc-dropdown").on("click", "a", function(){
        var _this = this;
        ga('send', 'event', 'Award doc dropdown', 'Click button', {
            'hitCallback': function() {
                console.log("Logging the click");
            }
        });
    });
    // Track clicks on my modules link
    $(".link--my-modules").on("click", "a", function(){
        var _this = this;
        ga('send', 'event', 'My modules', 'Click button', {
            'hitCallback': function() {
                console.log("Logging the click");
            }
        });
    });

    // Bootstrap Tour
    // Instance the tour
    // var tour = new Tour({
    //     steps: [
    //         {
    //             element: "#link__course-information",
    //             title: "Course info link",
    //             content: "Here is the course info page link."
    //         },
    //         {
    //             element: "#coursesearchbox",
    //             title: "Search modules",
    //             content: "Search modules"
    //         }
    //     ],
    //     template: "<div class='popover tour'><div class='arrow'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='btn btn-default' data-role='prev'>« Prev</button> <button class='btn btn-default' data-role='next'>Next »</button></div><div class='popover-footer'><button class='btn btn-default' data-role='end'>End tour</button></div></nav></div>",
    //     name: "tour",
    //     backdrop: true
    // });

    // // Initialize the tour
    // tour.init();






}(jQuery);
</script>
</body>
</html>