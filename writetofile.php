<?php
$myfile = fopen("testfile.txt", "r+") or die("Unable to open file!");

ftruncate($myfile, 0);

$txt = "John Doe\n";
fwrite($myfile, $txt);

?>