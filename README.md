LEARNING SPACE - FALMOUTH THEME
===============================

This is Falmouth University override for the Bootstrap 3 theme for Moodle.

* package   falmouth for Bootstrap 3
* copyright 2015 Falmouth University
* authors   Kris Zani - extends the work of many many people
* license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later

For more info on Boostrap 3 themes read
https://github.com/bmbrands/theme_bootstrap/blob/master/README.md

Installing
----------
Make sure you have first installed the [bootstrap theme](https://github.com/bmbrands/theme_bootstrap/)

It also **requires** a few plugins and a custom course format.
* apps / scip - the scip system (should probably be rewritten)
* theme / bootstrap - the parent theme on which our theme is based
* course / format / topicsdeluxe (all courses should be set to use this format, it is the only format that is **fully** tested.)
* blocks / section
* blocks / course_menu (This builds on section to display our list of sections in a module page)
* blocks / aspirelists (enables resource lists)
* blocks / course_contents - not sure if this is used
* enrol / autoenrol
* mod / attendance
* mod / questionnaire
* mod / scheduler
* mod / turnitintool
* mod / turnitintooltwo
* lib / editor / atto / plugins / styles

Each of these elements has their own README located in the appropriate folder detailing the elements.  Only scip, topicsdeluxe and section have been modified by ourselves.

About
-----
The theme is pretty simple and we hope well organised.  But a brief description of where things are maybe helpful.

### config.php
This is a fairly standard moodle theme config file and we haven't done anything particularly clever here.

### lib.php
Forces the loading of jquery on every page. As we do use it.

Declares the function **falmouth_grid** which is used to determine which bootstrap classes to apply to a layout based on the regions it has.  This was copied from the parent bootstrap theme and modified.  Our theme has two real regions - content and side-post.  Normally the content has a class of col-md-8 and the side-post of col-md-4.  So on a medium size screen (and bigger) the main content will be 8/12 of the screen size and the side bar will be 4/12.  When the screen is smaller our side bar will disappear as it also has the classes hidden-xs and hidden-sm.  We then use some custom css inside a media query to switch this to an absolutely positioned off canvas navigation bar (see less/partials/offcanvas.less for more information).  Since this is inside a media query any browsers that don't support them will lose this navigation bar completely (which is IE8 and earlier).

The other functions allow for the custom settings logo and customcss - which have been left in this theme for documentation in case someone wishes to add custom settings, but they are not really used at this time.

### renderers.php
Defines the two renderers which this theme uses, they can be found in the renderers folder.

### settings.php
Defines two custom settings: logo and customcss.  Not really used at this time.

### javascript (folder)

#### scripts.js
This file contains our custom scripts.  It's very light and well documented but it is heavily dependant on our blocks and theme.  

It alters the bootstrap navbar so that the menus respond to mouse hover as well as click.

It checks the source of the page for a hidden element #userrole and uses that to show / hide certain elements on the page.  This is not done for security but merely provides a simple was to alter the interface based on the user's role.  

The course_menu block outputs a link [[returntomaincoursepage]] which contains a href to view all sections of that specific course.  We detect if this element exists on the current page and if it does we move it to live in the bottom of the sections menu, this seemed a better way than *hacking* the source of the section menu block.

Related to this is our desire to force all courses to be opened with the additional ?section=1 parameter.  We have mostly fixed this using custom renderers but just in case (manual links to courses in the module source etc) we also search for links and inject a section=1 parameter into any we find.

Lastly, we set the click event of the toggle navbar button to show/hide the off canvas navigation.  The button itself is displayed or hidden using media queries in the CSS.

#### tooltip.js
This is a local copy of the bootstrap tooltip javascript function - we use this currently on the login page to tell users not to bother typing staff/ or student/.  It also includes bootstrap tabs and popover - which are used by the scip page. 


### layout (folder)
This folder contains our actual layout files.  We currently have five.

1. default.php - used for most of the pages
2. default-with-search.php - used by the home and search pages (identical to default but with a search box above the side bar)
3. login.php - obviously for the login page
4. frontpage.php - this checks if the user is a student (students do not have the capability to view hidden course sections), if student detected then they are redirected to the /apps/scip path.  Otherwise the default-with-search layout is loaded.
5. Starts as a copy of the default-with-search layout, when it loads, it uses jquery to get the scip details from /app/scip/loadscip.php and puts that data in the appropriate div.  It then uses jquery to scrape the learningspace home page and steal the schools menu.

Most of the actual layout is inside the **partials** folder which hopefully makes sense.

partials/_init.php sets up a few variables that all of the layouts need to know about.  Things like should the layout load breadcrumbs, how many regions does it have, etc.

partials/head.php contains the actual HTML doctype and head.

partials/navbar.php outputs our navigation menu (not to be confused with the breadcrumbs bar which moodle often terms navbar).  It does contain a little hackery - the pagebutton function generally returns either a form with an input[type=submit] or an anchor link, the code uses PHP DOMDocument to parse the returned html snippet and style those elements using btn btn-navbar classes.

partials/search.php outputs the search form used in the default-with-search layout.

partials/user_roles_hack.php Attempts to lookup the user's role and creates a hidden div element with a data-role attribute.  If you have the capability to viewhiddensections (on a course) and have ET in your user's description then you are admin, if you can view hidden sections you are a teacher else you are student.

partials/footer.php - contains the page footer.

### less (folder)
The main file here is **falmouth.less** (as defined in the config.php file).  This loads the parent bootstrap less files, then our local variables.less and finally overrides.less.

variables.less is a copy of the bootstrap file modified with our theme.  It also contains a few extra variables that are useful specifically in our theme - the all start with @fal-.

overrides.less contains custom styles which override the bootstrap theme.  Some of this is inside the main file and others have been organised into partials.  If the classes seemed to be related to a single logical component such as breadcrumbs or a page style / layout such as login then they were moved to a partial.  


### renderers (folder)
core_renderer.php provides three functions:

1. notification - which aims to add bootstrap alert styles to moodle notfications.
2. user_menu - which assembles the user's personal menu (top right corner of the navigation bar)
3. navbar - which builds the breadcrumbs bar

course_renderer.php provides three functions which are all around the listing of courses.  These are used automagically by moodle when generating things like the course category list or search results.  Mostly they are copies of the original functions (in the bootstrap theme renderers folder) with some minor changes.  We inject the section=1 URL parameter into any links, and output the full hierarchical category list for a course rather than the default subcategory only.

