<?php
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

<div class="container" style="padding-top: 20px;">
    <div class="row">
        <div class="col-xs-12">
        <?php
        echo $OUTPUT->course_content_header();

        echo $OUTPUT->main_content();

        echo $OUTPUT->course_content_footer();
        ?>
        </div>
    </div>
</div>

<?php

include_once('partials/footer.php');


// careful - if this line is outputted multiple times your javascript goes to hell
echo $OUTPUT->standard_end_of_body_html();
?>
<script>
+function ($) {
	'use strict';

	// This script is inlined inside the layout/login.php file as it has no use in any other page

	// hack the form 
	$(".loginbox").find('.forgetpass a').text('Problems logging in?');


	var $un = $('#username');

	$un.attr("placeholder", "Username");
	$('#password').attr("placeholder", "Password");


	var staff_error = false;

	$un.tooltip({title: function() {
		if (staff_error) {
			return 'Dont enter the staff prefix';
		} else {
			return 'Dont enter the student prefix';
		}
	}, trigger: 'manual'});


	$un.on("keyup", function(){
		staff_error = false;
		var v = $(this).val().toLowerCase();
		if( v.substr(0, 5) === 'staff' ) {
			staff_error = true;
			$un.tooltip('show');
		} else if ( v.substr(0, 7) === 'student' ) {
			$un.tooltip('show');
		} else {
			$un.tooltip('hide');
		}
	});


}(jQuery);
</script>
</body>
</html>