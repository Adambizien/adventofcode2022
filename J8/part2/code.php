<?php

$fh = fopen("Input.txt", "r");

$result = 0;
$grid = [];

$i=0;
if($fh) {
    while (($line = fgets($fh)) !== false) {
        $line = trim($line);

        $grid[$i] = str_split($line);
        $i++;
    }
}
function getXY($grid, $x, $y): array
{
    $X = $grid[$x];
    $Y = [];
    for($i=0; $i<=count($grid[$x]) -1; $i++) {
        $Y[] = $grid[$i][$y];
    }

    return [$X, $Y];
}

for($x=0; $x <= count($grid) -1; $x++) {
    for($y=0; $y <= count($grid[$x]) -1; $y++) {

        [$X, $Y] = getXY($grid, $x, $y);
        $currentTree = $grid[$x][$y];
        $currentTreeScore = 1;

        $rightTreeScore = 0;
        $leftTreeScore = 0;
        $topTreeScore = 0;
        $bottomTreeScore = 0;


        for($i=$y+1; $i<=count($X) -1; $i++) {
            $rightTreeScore++;
            if($X[$i] >= $currentTree) {
                break;
            }
        }
        for($i=$y-1; $i >= 0; $i--) {
            $leftTreeScore++;
            if($X[$i] >= $currentTree) {
                break;
            }
        }

        for($i=$x+1; $i<=count($Y) -1; $i++) {
            $topTreeScore++;
            if($Y[$i] >= $currentTree) {
                break;
            }
        }

        for($i=$x-1; $i >= 0; $i--) {
            $bottomTreeScore++;
            if($Y[$i] >= $currentTree) {
                break;
            }
        }

        $currentTreeScore = $rightTreeScore != 0 ? $currentTreeScore * $rightTreeScore: $currentTreeScore;
        $currentTreeScore = $leftTreeScore != 0 ? $currentTreeScore * $leftTreeScore: $currentTreeScore;
        $currentTreeScore = $topTreeScore != 0 ? $currentTreeScore * $topTreeScore: $currentTreeScore;
        $currentTreeScore = $bottomTreeScore != 0 ? $currentTreeScore * $bottomTreeScore: $currentTreeScore;

        if($currentTreeScore > $result) {
            $result = $currentTreeScore;
        }
    }
}
echo $result;

