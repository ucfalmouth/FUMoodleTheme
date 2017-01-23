<!DOCTYPE html>
<html lang="en" ng-app="Changelog">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>Learningspace – Course Finder</title>
<!-- Bootstrap core CSS -->
<script type="text/javascript" src="//use.typekit.net/ull6bqj.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<link href="../../dist/css/bootstrap.css" rel="stylesheet">
<link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
<link href="../../../css/navbar-static-top.css" rel="stylesheet">
<!-- Custom styles for this template -->
<!-- Learning Space Styles -->
<link href="../../../style/learningspace-sass.css" rel="stylesheet">
<!--[if lt IE 9]>
<script src="../../dist/js/html5shiv.js"></script>
<![endif]-->
<style type="text/css">
  #region-main{
    width: 100%;
    padding: 18px 20px;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    margin-bottom: 20px;
    background: #fff;
     border: solid 1px #d5d7d8;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    margin-top: 40px;
  }
  table{
    font-family: "proxima-nova", "freight-sans-pro", "Helvetica Neue", "helvetica", "arial", sans-serif;
    font-size: 14px;
  }



</style>

<body>

  <header role="banner" class="navbar navbar-fixed-top">
      <nav role="navigation" class="navbar-inner navbar-inverse">
        <div class="container-fluid">
          <a class="brand" href="/">Learning Space<?php //echo $SITE->shortname; ?></a>
        </div>
    </nav>
  </header>






  <div id="page" class="container-fluid">
    <section id="region-main">
    <h1>Release notes</h1>
    <p>These release notes are intended as a brief overview of new features and recent changes to Learning Space. The links provide further detail on rationale behind change. If you are interested in finer detail, please check the <a href="http://teamet.tumblr.com/tagged/change">changelog</a>.</p>

<p>If you have any further questions, please contact <a href="mailto:etsupport@falmouth.ac.uk">etsupport@falmouth.ac.uk</a>.</p>
      <table class="table table-striped table-bordered">
       <?php 
// get the CSV data as an array from the remote URL
$lines = file('https://docs.google.com/spreadsheet/pub?key=0AkGk3GyWwWwcdGkyeVU5VzdrNzhnNTN3RXZzSzN1Ync&single=true&gid=0&output=csv');

// get rid of header row
$headers = array_shift($lines);

// Loop through data - there is only one line hear
foreach ($lines as $line) {
  $ldata =  explode(',', trim($line)); // split row to its own array of elements

  if ($ldata[0] == '') break; // an empty line means we are done, so exit the foreach loop
  
      // now we can just output the <span class="goog_qs-tidbit goog_qs-tidbit-0">information as an HTML list, referencing the appropriate array items</span>
echo '<tr>
  <td><a href="' . $ldata[2] . '">' . $ldata[1] . '</a></td>
  <td>' . $ldata[3] . '</td>
  <td>' . $ldata[0] . '</td>
</tr>
';
} ?>
      </table>
    </section>
  </div>

<?php include '../../../layout/ls-analytics.php'; ?>
<!-- Core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
</body>
</html>
