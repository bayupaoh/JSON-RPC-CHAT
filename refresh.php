<?php
$myFile = "storeData.txt";
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = "";
fwrite($fh, $stringData);
fclose($fh);
//header('Location: GGF.php');
?> 
