<?php
// get the CSV data as an array from the remote URL
$lines = file('https://docs.google.com/spreadsheet/pub?key=0Aurfdoynt8B-dEZlZlBwbzBLaXpYUkFIVjgzUFR3LXc&single=true&gid=0&output=csv');

// get rid of header row
$headers = array_shift($lines);

// Loop through data - there is only one line hear
foreach ($lines as $line) {
	$ldata =  explode(',', trim($line)); // split row to its own array of elements

	if ($ldata[0] == '') break; // an empty line means we are done, so exit the foreach loop
	
      // now we can just output the <span class="goog_qs-tidbit goog_qs-tidbit-0">information as an HTML list, referencing the appropriate array items</span>
       echo '<li class="span4" data-award-name="' . $ldata[0] . '" data-award-type="' . $ldata[1] . '" data-letter-index="' . $ldata[2] . '">
          <h3><a href="' . $ldata[3] . '">' . $ldata[0] . '</a></h3>
        </li>
        ';
}
?>
