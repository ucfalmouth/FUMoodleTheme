<footer id="footer <?php echo ($hidefooter ? 'no-top-border' : ''); ?>">
    <div class="container">
        <?php //echo $OUTPUT->standard_footer_html(); ?>
<?php
if (! $hidefooter):
?>
        <div class="row" id="screen-footer">
            <ul class="list-unstyled">
              <li><a href="http://myfalmouth.falmouth.ac.uk/">My Falmouth</a></li>
              <li><a href="http://studentmail.falmouth.ac.uk/">Student Email</a></li>
              <li><a href="http://mailspace.falmouth.ac.uk/">Staff Email</a></li>
              <li><a href="http://www.falmouth.ac.uk/termdates">Term Dates</a></li>
              <li><a href="http://et.falmouth.ac.uk">Help</a></li>
              <li><a href="http://et.falmouth.ac.uk">Educational Technology</a></li>
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
	            <small>Lovingly crafted by <a href="http://et.falmouth.ac.uk">Educational Technology</a>. &copy; Falmouth University. All rights reserved.</small>
	        </span>
	        <a id="fal-logo" href="http://falmouth.ac.uk/"></a>
	    </div>
    </div>
</footer>

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