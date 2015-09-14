<?php
/** THIS NEEDS TO BE MOVED INTO A HELPER FUNCTION **/
// User roles hack.
global $COURSE;
global $USER;
$role = isset($USER->description) ?: "" ;

//$coursecontext = get_context_instance(CONTEXT_COURSE, $COURSE->id);
$coursecontext = context_course::instance($COURSE->id);

if (has_capability('moodle/course:viewhiddensections', $coursecontext)) {
    if ($role == "ET") {
	    echo "<div data-role=\"admin\" id=\"userrole\" style=\"display: none\">Role is ".$role."</div>";
	} else {
	    echo "<div data-role=\"teacher\" id=\"userrole\" style=\"display: none\">Role is ".$role."</div>";
	}
} else {
	echo "<div data-role=\"student\" id=\"userrole\" style=\"display: none\">Role is ".$role."</div>";
}