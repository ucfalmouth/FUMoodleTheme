<?php
/**
This is the main template layout and all others are based on this
Due to the large amount of repetition much of the code has been moved into the
partials folder.  This folder contains helper functions and components
as well as an _init file which sets up the standard variables
**/

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

        <header id="page-header" class="clearfix">
            <div id="page-navbar" class="clearfix">
                <nav class="breadcrumb-nav" role="navigation" aria-label="breadcrumb"><?php echo $OUTPUT->navbar(); ?></nav>
                
                <!-- 
                <div class="breadcrumb-button">
                <?php //echo $OUTPUT->page_heading_button(); ?>
                </div> -->
                <?php if ($knownregionpre || $knownregionpost) { ?>
                    <!-- <div class="breadcrumb-button"> <?php 
                    //echo $OUTPUT->content_zoom(); ?>
                    </div> -->
                <?php } ?>
            </div>

            <div id="course-header">
                <?php echo $OUTPUT->course_header(); ?>
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

                    <?php
                    if ($PAGE->pagetype == "user-profile") {
                        $tmp_url = new moodle_url('/user/editadvanced.php', array('id'=>$USER->id));
                        echo "<a href='$tmp_url' class='btn btn-primary'>Edit profile</a>";
                    }
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



<?php
if ($PAGE->pagelayout == "course"):
?>
<script>
/**
IF WE ARE IN A COURSE VIEW THEN LOOK FOR A LINK 
Enrol me in this course
*/
+function ($) {
  'use strict';

  var $sidebar = $("#block-region-side-post");
  var $admin_menu = $("#settingsnav");

  var strings_to_find = [
    "Enrol me in this course",
    "Subscribe me",
    "Unsubscribe me"
  ];

  var str_unenrol = "Unenrol me from";

  if ($('body').hasClass('path-enrol')) {
    return;
    // this is when a student has clicked the enrol me link and the page reloads for them to confirm it.
  }

  // check if we have an admin / settings menu
  if ($admin_menu.length > 0) {
    // create a div.block to hold the buttons
    var $block = $("<div>").addClass("block_html block");
    var $content_block = $("<div>").addClass("content").appendTo($block);

    // find the exact links
    var $enrol_link, $new_enrol_link;

    for (var i=0; i<strings_to_find.length; i++) {

        $enrol_link = $admin_menu.find("a").filter( function(ndx) {
            return $(this).text() === strings_to_find[i];
        });

        if ($enrol_link.length > 0) {
            // create the new button
            $new_enrol_link = $("<a>")
                .text( strings_to_find[i] )
                .addClass('btn btn-primary')
                .attr('href', $enrol_link.attr('href'))
                .appendTo($content_block);
        } 
    }

    // find the unenrol link (this only matches the start of the text)
    var $unenrol_link = $admin_menu.find("a").filter( function(ndx) {
        return $(this).text().match("^" + str_unenrol);
    });

    if ($unenrol_link.length > 0) {
        // create the new button
        var $new_unenrol_link = $("<a>")
            .text( $unenrol_link.text() )
            .addClass('btn btn-primary')
            .attr('href', $unenrol_link.attr('href'))
            .appendTo($content_block);
    } 


    // add the block of buttons to the sidebar
    $block.appendTo($sidebar);
  }
   
  
}(jQuery);

</script>
<?php
endif;
?>


</body>
</html>