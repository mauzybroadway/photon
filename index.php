<?php
include_once ("home.html");

echo '<div id="content">';
echo '<div class="images">';
$count = 1;
while ($count<20) {

	echo'<img src="images/photo' . $count . '.jpg" class="thumb"/>';
	$count += 1;
}

echo '</div>';
echo '</div>';

?>
