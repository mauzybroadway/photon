<?php $filename = 'test.txt';
$Content = "Add this to the file\r\n";
 
echo "open";
$handle = fopen($filename, 'x+');
echo " write";
fwrite($handle, $Content);
echo " close";
fclose($handle);
 
?>