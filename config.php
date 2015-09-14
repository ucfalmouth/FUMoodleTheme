<?php
/**
 * Theme FALMOUTH config file.
 *
 * @package    theme_falmouth
 * @copyright  2015 Falmouth University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$THEME->name = 'falmouth';
$THEME->parents = array('bootstrap');

$THEME->doctype = 'html5';
$THEME->sheets = array('custom');
$THEME->lessfile = 'falmouth';
$THEME->parents_exclude_sheets = array('bootstrap' => array('moodle'));
$THEME->lessvariablescallback = 'theme_falmouth_less_variables';
$THEME->extralesscallback = 'theme_falmouth_extra_less';
$THEME->supportscssoptimisation = false;
$THEME->yuicssmodules = array();
$THEME->enable_dock = false;
$THEME->editor_sheets = array();

$THEME->rendererfactory = 'theme_overridden_renderer_factory';
$THEME->csspostprocess = 'theme_falmouth_process_css';

$THEME->layouts = array(
    'base' => array(
        'file' => 'default.php',
        'regions' => array('side-post'),
        'defaultregion' => 'side-post',
    ),
    'standard' => array(
        'file' => 'default-with-search.php',
        'regions' => array('side-post'),
        'defaultregion' => 'side-post',
    ),
    'course' => array(
        'file' => 'default.php', 
        'regions' => array('side-post'),
        'defaultregion' => 'side-post'
    ),
    'coursecategory' => array(
        'file' => 'default-with-search.php',
        'regions' => array('side-post'),
        'defaultregion' => 'side-post',
    ),

    'incourse' => array(
        'file' => 'default.php',
        'regions' => array('side-post'),
        'defaultregion' => 'side-post',
    ),

    'frontpage' => array(
        'file' => 'frontpage.php',
        'regions' => array('side-post'),
        'defaultregion' => 'side-post',
         'options' => array('nonavbar'=>true),
    ),
    'admin' => array(
        'file' => 'default.php',
        'regions' => array('side-post'),
        'defaultregion' => 'side-post',
    ),
    'mydashboard' => array(
        'file' => 'default.php',
        'regions' => array('side-post'),
        'defaultregion' => 'side-post',
    ),
    'mypublic' => array(
        'file' => 'default.php',
        'regions' => array('side-post'),
        'defaultregion' => 'side-post',
    ),
    'login' => array(
        'file' => 'login.php',
        'regions' => array(),
        'options' => array('hidemenus'=>true, 'hidefooter'=>true),
    ),
    // 'popup' => array(
    //     'file' => 'popup.php',
    //     'regions' => array(),
    //     'options' => array('nofooter'=>true, 'noblocks'=>true, 'nonavbar'=>true),
    // ),
    // 'frametop' => array(
    //     'file' => 'frametop.php',
    //     'regions' => array(),
    //     'options' => array('nofooter'=>true),
    // ),
    'maintenance' => array(
        'file' => 'default.php',
        'regions' => array(),
        'options' => array('nofooter'=>true, 'nonavbar'=>true),
    ),
    // 'embedded' => array(
    //     'theme' => 'canvas',
    //     'file' => 'general.php',
    //     'regions' => array(),
    //     'options' => array('nofooter'=>true, 'nonavbar'=>true),
    // ),
    // 'print' => array(
    //     'file' => 'general.php',
    //     'regions' => array(),
    //     'options' => array('nofooter'=>true, 'nonavbar'=>false, 'noblocks'=>true),
    // ),
    // 'redirect' => array(
    //     'file' => 'general.php',
    //     'regions' => array(),
    //     'options' => array('nofooter'=>true, 'nonavbar'=>false, 'noblocks'=>true),
    // ),
    'report' => array(
        'file' => 'default.php',
        'regions' => array('side-post'),
        'defaultregion' => 'side-post',
    ),
    // // The pagelayout used for safebrowser and securewindow.
    // 'secure' => array(
    //     'file' => 'general.php',
    //     'regions' => array('side-pre', 'side-post'),
    //     'defaultregion' => 'side-pre',
    //     'options' => array('nofooter'=>true, 'nonavbar'=>true, 'nocustommenu'=>true,
    //                        'nologinlinks'=>true, 'nocourseheaderfooter'=>true),
    // ),
    'scip' => array(
        'file' => 'scip.php',
        'regions' => array('side-post'),
        'defaultregion' => 'side-post',
    ),
);

$THEME->javascripts_footer[] = 'scripts';
$THEME->javascripts_footer[] = 'tooltip'; // manual load in of bootstrap's tooltip


