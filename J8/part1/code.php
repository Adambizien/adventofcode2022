<?php

$fh = fopen("Input.txt", "r");

$result = 0;
$visibleTreesCoords = []; 
$grid = [];

$i=0;
if($fh) {
    while (($line = fgets($fh)) !== false) {
        $line = trim($line);
        $grid[$i] = str_split($line);
        $i++;
    }
}

//gauche a droite de bas en haut 
for($x=1; $x <= count($grid) -2; $x++) {
    $tempHighest = $grid[$x][0]; 
    for($y=1; $y <= count($grid[$x]) - 2; $y++) {
        $currentTree = $grid[$x][$y];
        if($currentTree > $tempHighest) {
            $tempHighest = $currentTree;
            $visibleTreesCoords[] = "[$x, $y] ($currentTree)";
        }
    }
}

// gauche a droite de haut en bas
for($x=1; $x <= count($grid) - 2; $x++) {
    $tempHighest = $grid[$x][ count($grid[$x]) -1 ]; 
    for($y = count($grid[$x]) - 2; $y >= 1; $y--) {
        $currentTree = $grid[$x][$y];
        if($currentTree > $tempHighest) {
            $tempHighest = $currentTree;
            $visibleTreesCoords[] = "[$x, $y] ($currentTree)";
        }
    }
}

//bas en haut de gauche a droite
for($y=1; $y <= count($grid[0]) -2; $y++) {
    $tempHighest = $grid[0][$y]; 
    for($x=1; $x <= count($grid) -2; $x++) {
        $currentTree = $grid[$x][$y];
        if($currentTree > $tempHighest) {
            $tempHighest = $currentTree;
            $visibleTreesCoords[] = "[$x, $y] ($currentTree)";
        }
    }
}

// bas en haut de droite a gauche
for($y=1; $y <= count($grid[0]) -2; $y++) {
    $tempHighest = $grid[count($grid)-1][$y]; 
    for($x = count($grid[0]) -2; $x >= 1; $x--) {
        $currentTree = $grid[$x][$y];
        if($currentTree > $tempHighest) {
            $tempHighest = $currentTree;
            $visibleTreesCoords[] = "[$x, $y] ($currentTree)";
        }
    }
}
$result = (2 * count($grid)) + (2 * count($grid[0])) - 4; 
$result += count(array_unique($visibleTreesCoords)); 

echo $result;