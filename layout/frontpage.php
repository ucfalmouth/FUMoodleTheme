<?php
/** THIS NEEDS TO BE MOVED INTO A HELPER FUNCTION **/
// User roles hack.
global $COURSE;
global $USER;
$role = isset($USER->description) ?: "" ;

//$coursecontext = get_context_instance(CONTEXT_COURSE, $COURSE->id);
$coursecontext = context_course::instance($COURSE->id);

if (! isset($_GET["forcehomepage"])) {
	if (! has_capability('moodle/course:viewhiddensections', $coursecontext)) {
	    // assume student and redirect to scip
	    redirect($CFG->wwwroot . "/apps/scip/");
	    exit();
	}
}

include("default-with-search.php");
