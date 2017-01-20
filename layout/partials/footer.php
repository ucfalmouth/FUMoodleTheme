<footer id="footer <?php echo ($hidefooter ? 'no-top-border' : ''); ?>">
    <div class="container">
        <?php //echo $OUTPUT->standard_footer_html(); ?>
<?php
if (! $hidefooter):
?>
        <div class="row" id="screen-footer">
            <ul class="list-unstyled">
              <li><a href="http://myfalmouth.falmouth.ac.uk/">My Falmouth</a></li>
              <li><a href="http://www.falmouth.ac.uk/termdates">Term Dates</a></li>
              <li><a href="https://www.falmouth.ac.uk/student-regulations">Student Regulations</a></li>
              <li><a href="http://learningspace.falmouth.ac.uk/theme/falmouth/pages/copyright-compliance.html">Copyright Compliance</a></li>
              <li><a href="http://etsupport.freshdesk.com/">Help</a></li>
            </ul>

        </div>
<?php
else:
?>
<div style="height: 20px;"></div>

<?php
endif;
?>
        <div class="row">
	        <span id="credits">
	            <small>Built by <a href="http://et.falmouth.ac.uk">Educational Technology</a>. &copy; Falmouth University. All rights reserved.</small>
	        </span>
	        <a id="fal-logo" href="http://falmouth.ac.uk/"></a>
	    </div>
    </div>
</footer>

<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-7991839-1', 'auto');
ga('send', 'pageview');
</script>

<?php
$maintenancemode = !empty($CFG->maintenance_enabled);

if ($maintenancemode) {
  if (isset($CFG->maintenance_message) && $CFG->maintenance_message > "") {
    $temp = explode("</p>", $CFG->maintenance_message);
    $maintenancemessage = $temp[0] . "</p>";
  } else {
    $maintenancemessage = "The site is currently undergoing essential maintenance, we apologise for any inconvenience and aim to get back up and running ASAP.";
  }

  echo "<div class='alert alert-danger-scary alert-footer-fixed'>" . $maintenancemessage . "</div>";
}

?>
