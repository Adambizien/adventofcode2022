<?php
$lines = file('Input.txt', FILE_IGNORE_NEW_LINES);

$cycle = 1;
$tot = 1;
$score = 0;
$signal = 20;

foreach($lines as $line) {
	list($ord, $val) = sscanf($line, "%s %d");
	if($ord == 'noop')
		$cycle++;
	if($ord == 'addx')
		$cycle += 2;
	if($cycle > $signal) {
		$score += $signal * $tot;
		$signal += 40;
	}
	if($ord == 'addx')
		$tot += $val;
}

echo $score."\n";

?>