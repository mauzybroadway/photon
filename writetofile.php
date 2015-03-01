<?php 
$filename = 'test.txt';
$Content = "Add this new to the file\r\n";
 
echo "open";
$handle = fopen($filename, 'a') or die("can't open file");
echo "clear";
//ftruncate($handle, 0);
echo " write";
fwrite($handle, $Content);
echo " close";
fclose($handle);

?>