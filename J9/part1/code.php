<?php
$lines = file('Input.txt', FILE_IGNORE_NEW_LINES);

$visited = array();
for($i = 0; $i < 10; $i++)
	$pos[$i][0] = $pos[$i][1] = 0;

foreach($lines as $line) {
	list($dir, $len) = sscanf($line, "%s %d");

	for($i = 1; $i <= $len; $i++) {
		if($dir == 'L')
			$pos[0][0] -= 1;
		elseif($dir == 'R')
			$pos[0][0] += 1;
		elseif($dir == 'U')
			$pos[0][1] += 1;
		elseif($dir == 'D')
			$pos[0][1] -= 1;
		
		for($s = 0; $s < 9; $s++) {
			if($pos[$s][0] > $pos[$s+1][0] + 1) {
				if($pos[$s][1] > $pos[$s+1][1])
					$pos[$s+1][1] += 1;
				if($pos[$s][1] < $pos[$s+1][1])
					$pos[$s+1][1] -= 1;
				$pos[$s+1][0] += 1;
			}
			if($pos[$s][0] < $pos[$s+1][0] - 1) {
				if($pos[$s][1] > $pos[$s+1][1])
					$pos[$s+1][1] += 1;
				if($pos[$s][1] < $pos[$s+1][1])
					$pos[$s+1][1] -= 1;
				$pos[$s+1][0] -= 1;
			}
			if($pos[$s][1] > $pos[$s+1][1] + 1) {
				if($pos[$s][0] > $pos[$s+1][0])
					$pos[$s+1][0] += 1;
				if($pos[$s][0] < $pos[$s+1][0])
					$pos[$s+1][0] -= 1;
				$pos[$s+1][1] += 1;
			}
			if($pos[$s][1] < $pos[$s+1][1] - 1) {
				if($pos[$s][0] > $pos[$s+1][0])
					$pos[$s+1][0] += 1;
				if($pos[$s][0] < $pos[$s+1][0])
					$pos[$s+1][0] -= 1;
				$pos[$s+1][1] -= 1;
			}
		}
		$visited[$pos[1][0].'-'.$pos[1][1]][] = 1;
	}
}
echo count($visited);
?>
