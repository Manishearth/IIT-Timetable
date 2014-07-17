<?php
header('Content-disposition: attachment; filename=calendar.ics');
header('Content-type: text/plain'); //headers

$doc = simplexml_load_file('data.xml'); //load xml file
$num =  count($_POST['slot']);
$data_slot = $_POST['slot'];
$data_venue = $_POST['venue'];
$data_course = $_POST['course']; //feed data to variables

$codeICS = 'BEGIN:VCALENDAR
VERSION:2.0
CALSCALE:GREGORIAN
METHOD:PUBLISH

'; //start the calendar

$finaldate = '20141107T060000Z'; //November 7 is last day of instruction for Autumn Semester 2014-15

for($i = 0;$i<$num;$i++)
{
	foreach($doc as $slot)
	{
		if($data_slot[$i]==$slot->name)
		{
			$codeICS .= 'BEGIN:VEVENT
SUMMARY:Class';	//begin event
			$day = $slot->day;
			if($day=='MO'){$date = '20140721';}
			else if($day=='TU'){$date = '20140722';}
			else if($day=='WE'){$date = '20140723';}
			else if($day=='TH'){$date = '20140724';}
			else if($day=='FR'){$date = '20140725';}
			$codeICS .= 'DTEND:'.$date.'T'.$slot->timeend.'
'; //end time
			$codeICS .= 'DTSTART:'.$date.'T'.$slot->timestart.'
'; //start time
			$codeICS .= 'LOCATION:'.$data_venue[$i].'
'; //location
			$codeICS .= 'DESCRIPTION:'.$data_course[$i].'
'; //course name
			$codeICS .= 'RRULE:FREQ=WEEKLY;UNTIL='.$finaldate.';BYDAY='.$day.'
'; //repeat rule, until end of semester
			$codeICS .= 'END:VEVENT

'; //end event
		}
	}
}

$codeICS .= 'END:VCALENDAR'; //end calendar

echo $codeICS; //output
?>