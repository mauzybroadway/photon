<?php 
$filename = 'enterthevoid.pho';
$Content = "Add this new to the file\r\n";
 
echo "open";
$handle = fopen($filename, 'x+');
echo "clear";
ftruncate($handle, 0);
echo " write";
fwrite($handle, $Content);
echo " close";
fclose($handle);
 
?>