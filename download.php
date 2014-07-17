<?php
header('Content-disposition: attachment; filename=calendar.ics');
header('Content-type: text/plain');
$text = $_POST['codeICS'];
$breaks = array("<br />","<br>","<br/>");  
$code = str_ireplace($breaks, "\r\n", $text); 

echo $code;
?>