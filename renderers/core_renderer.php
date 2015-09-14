<?php


class theme_falmouth_core_renderer extends theme_bootstrap_core_renderer {


    public function notification($message, $classes = 'notifyproblem') {
        $message = clean_text($message);
        $type = '';

        if ($classes == 'notifyproblem') {
            $type = 'alert alert-error';
        }
        if ($classes == 'notifysuccess') {
            $type = 'alert alert-success';
        }
        if ($classes == 'notifymessage') {
            $type = 'alert alert-info';
        }
        if ($classes == 'redirectmessage') {
            $type = 'alert alert-block alert-info';
        }
        return "<div class=\"$type\">$message</div>";
    }



    /**
    Function to build the user's menu for the top navigation bar
    @param bool $withlinks - not sure if we want this
    @return string HTML fragment
    **/

    public function user_menu($user = NULL, $withlinks = NULL) {
        global $USER, $CFG, $DB, $SESSION, $PAGE;

        // if we are during install return an empty string
        if (during_initial_install()) {
            return '';
        }

        $course = $this->page->course;
        
        // at certain times - i.e. installation course id will be empty or null
        if (empty($course->id)) {
            return '';
        }


        // this is the login page so return nothing
        $loginurl = get_login_url();
        if ((string)$this->page->url === $loginurl) {
            return '';
        }

        // user not logged in so return login link
        if (! isloggedin()) {
            return "<li><a href=\"$loginurl\">" . get_string('login') . '</a></li>';
        }

        
        // begin building the user's display name
        $user_string = "";

        // check if the user is logged in as someone else
        #if (session_is_loggedinas()) {
        #    $realuser = session_get_realuser();
        if (\core\session\manager::is_loggedinas()) {
            $realuser = \core\session\manager::get_realuser();
            $user_string = fullname($realuser, true) . " pretending to be ";
        }
        
        $user_string .= fullname($USER, true);


        $role_switched = false;
        if (is_role_switched($course->id)) { // Has switched roles 
            $context = context_course::instance($course->id);
            $role_switched = true;
            $rolename = ''; 
            if ($role = $DB->get_record('role', array('id'=>$USER->access['rsw'][$context->path]))) { 
                $rolename = ': '.role_get_name($role, $context); 
            } 
            $user_string .= $rolename; 
        }




        $user_picture = new user_picture( $USER );
        $userimgsrc = $user_picture->get_url($PAGE);

        $user_menu = array("<li class='dropdown'>");
            $user_menu[] = "<a class='dropdown-toggle' data-toggle='dropdown' href='#' style='min-height: 50px'>";
                $user_menu[] = "<img class='nav-avatar' src='".$userimgsrc."'>";
                $user_menu[] = "<span class='hidden-xs'>" . $user_string . "</span>";
            $user_menu[] = "</a>";
            $user_menu[] = "<ul class='dropdown-menu dropdown-menu-right'>";


            if ($role_switched) {
                $url = new moodle_url('/course/switchrole.php', array('id'=>$course->id,'sesskey'=>sesskey(), 'switchrole'=>0, 'returnurl'=>$this->page->url->out_as_local_url(false))); 
                $user_menu[] =  "<li><a href='" . $url . "'>" . get_string('switchrolereturn') . "</a></li>";
            }

            $user_menu[] =  "<li><a href='" . $CFG->wwwroot . "/user/profile.php?id=" . $USER->id . "'>My Profile</a></li>";
            $user_menu[] =  "<li class='menu-item-resources'><a href='/'>My Modules</a></li>"; 
            $user_menu[] =  "<li id='student-email-link' style='display: none'><a href='http://studentmail.falmouth.ac.uk/'>My Email</a></li>";
            $user_menu[] =  "<li id='staff-email-link' style='display: none'><a href='http://mailspace.falmouth.ac.uk/'>My Email</a></li>";
            $user_menu[] =  "<li><a href='http://mytimetable.falmouth.ac.uk/'>My Timetable</a></li>";

            $user_menu[] = "<li class='divider'></li>";
            $user_menu[] = "<li><a href='". $CFG->wwwroot . "/login/logout.php?sesskey=" . sesskey() . "'>" . get_string('logout') . '</a></li>';

        $user_menu[] = "</ul></li>";


        return implode("", $user_menu);
        
    }



    /** RENDER THE BREADCRUMBS BAR **/
    public function navbar() {

        global $CFG;

        $items = $this->page->navbar->get_items();
        if (count($items) <= 2) return "";

        // The following lines will remove values from the first two indexes.
        unset($items[0]);
        unset($items[1]);

        foreach ($items as $item) {
            $item->hideicon = true;
            $breadcrumbs[] = $this->render($item);
        }

        $divider = '<i class="fa divider fa-chevron-right"></i>';
        $list_items = '<li>'.join(" $divider</li><li>", $breadcrumbs).'</li>';
        $title = '<span class="accesshide">'.get_string('pagepath').'</span>';
        
        return $title . "<ul class=\"breadcrumb\"><li><a href=\"" . $CFG->wwwroot . "\"><i class=\"fa fa-home\"></i></a><i class=\"fa divider fa-chevron-right\"></i></li>$list_items</ul>";
    }

}
