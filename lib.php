<?php

/** FORCE LOADING OF JQUERY **/
function theme_falmouth_page_init(moodle_page $page) {
    $page->requires->jquery();
}


/**
This function is called by layouts/partials/_init.php
it builds an array of regions where the key is the region name and the value
is a list of classes to be applied to that div.
check bootstrap documentation for an explanation of what the classes do.
*/
function falmouth_grid($hassidepre, $hassidepost) {

    if ($hassidepre && $hassidepost) {
        $regions = array('content' => 'col-md-6 col-md-push-3');
        $regions['pre'] = 'col-md-3 col-md-pull-6';
        $regions['post'] = 'hidden-xs hidden-sm col-md-3';
    } else if ($hassidepre && !$hassidepost) {
        $regions = array('content' => 'col-md-8 col-md-push-4');
        $regions['pre'] = 'col-md-4 col-md-pull-8';
        $regions['post'] = 'empty';
    } else if (!$hassidepre && $hassidepost) {
        $regions = array('content' => 'col-md-8');
        $regions['pre'] = 'empty';
        $regions['post'] = 'hidden-xs hidden-sm col-md-4';
    } else if (!$hassidepre && !$hassidepost) {
        $regions = array('content' => 'col-md-12');
        $regions['pre'] = 'empty';
        $regions['post'] = 'empty';
    }
    
    if ('rtl' === get_string('thisdirection', 'langconfig')) {
        if ($hassidepre && $hassidepost) {
            $regions['pre'] = 'col-md-3  col-md-push-3';
            $regions['post'] = 'hidden-xs hidden-sm col-md-3 col-md-pull-9';
        } else if ($hassidepre && !$hassidepost) {
            $regions = array('content' => 'col-md-8');
            $regions['pre'] = 'col-md-4';
            $regions['post'] = 'empty';
        } else if (!$hassidepre && $hassidepost) {
            $regions = array('content' => 'col-md-8 col-md-push-4');
            $regions['pre'] = 'empty';
            $regions['post'] = 'hidden-xs hidden-sm col-md-4 col-md-pull-8';
        }
    }
    return $regions;
}


/** BELOW HERE IS STANDARD THEME CODE AND HAS NOT BEEN MODIFIED **/


/**
 * Theme falmouth lib.
 *
 * @package    theme_falmouth
 * @copyright  2015 Falmouth University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

function theme_falmouth_process_css($css, $theme) {

    // Set the background image for the logo.
    $logo = $theme->setting_file_url('logo', 'logo');
    $css = theme_falmouth_set_logo($css, $logo);

    // Set custom CSS.
    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = theme_falmouth_set_customcss($css, $customcss);

    return $css;
}


function theme_falmouth_set_logo($css, $logo) {
    $logotag = '[[setting:logo]]';
    $logoheight = '[[logoheight]]';
    $logowidth = '[[logowidth]]';
    $logodisplay = '[[logodisplay]]';
    $width = '0';
    $height = '0';
    $display = 'none';
    $replacement = $logo;
    if (is_null($replacement)) {
        $replacement = '';
    } else {
        $dimensions = getimagesize('http:'.$logo);
        $width = $dimensions[0] . 'px';
        $height = $dimensions[1] . 'px';
        $display = 'block';
    }
    $css = str_replace($logotag, $replacement, $css);
    $css = str_replace($logoheight, $height, $css);
    $css = str_replace($logowidth, $width, $css);
    $css = str_replace($logodisplay, $display, $css);

    return $css;
}

/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return bool
 */
function theme_falmouth_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    if ($context->contextlevel == CONTEXT_SYSTEM && ($filearea === 'logo')) {
        $theme = theme_config::load('falmouth');
        return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
    } else {
        send_file_not_found();
    }
}

/**
 * Adds any custom CSS to the CSS before it is cached.
 *
 * @param string $css The original CSS.
 * @param string $customcss The custom CSS to add.
 * @return string The CSS which now contains our custom CSS.
 */
function theme_falmouth_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}
