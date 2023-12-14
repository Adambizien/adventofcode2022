<?php

$fh = fopen("Input.txt", "r");

$result = 0;
$fs = [];
$ptr = []; 
$totalFsSize = 0;
$directoriesSizeMap = [];

if($fh) {
    while (($line = fgets($fh)) !== false) {
        $line = trim($line);

        if($line[0] === '$') {
            if($line === '$ cd ..') {
                array_pop($ptr);
            }

            preg_match('/^\$ cd ([a-zA-Z0-9]+)/', $line, $cdDir);
            if(!empty($cdDir)) {
                $ptr[] = $cdDir[1];
            }
        } else {
            writeFsArray($fs, $ptr, $line);
        }
    }
}
getSizeOfFsArray($fs,$totalFsSize);

$freeFsSize = 70000000 - $totalFsSize;
$requiredFsSize = 30000000 - $freeFsSize;

mapFsDirectories($fs, $directoriesSizeMap, $requiredFsSize);
sort($directoriesSizeMap);
$result = $directoriesSizeMap[0];

echo  $result;

function writeFsArray(&$fs, $ptr, $data): void
{

    if(empty($ptr)) {
        $explodedLine = explode(' ', $data );

        if(!isset($fs[$explodedLine[1]])) {
            if($explodedLine[0] === 'dir') {
                $fs[$explodedLine[1]] = [];
            } else  {
                $fs[$explodedLine[1]] = $explodedLine[0];
            }
        }
    } else {
        $ptr = array_reverse($ptr);
        $dir = array_pop($ptr);
        $ptr = array_reverse($ptr);
        writeFsArray($fs[$dir], $ptr, $data);
    }
}

function getSizeOfFsArray($fs, &$totalFsSize): void
{
    foreach($fs as $item) {
        if(is_array($item)) {
            getSizeOfFsArray($item, $totalFsSize);
        } else {
            $totalFsSize += $item;
        }
    }
}

function mapFsDirectories($fs, &$directoriesSizeMap, &$requiredFsSize)
{
    $size = 0;
    foreach($fs as $item) {
        if(is_array($item)) {
            $size += mapFsDirectories($item, $directoriesSizeMap, $requiredFsSize);
        } else {
            $size += $item;
        }
    }
    if($size > $requiredFsSize) {
        $directoriesSizeMap[] = $size;
    }
    return $size;
}