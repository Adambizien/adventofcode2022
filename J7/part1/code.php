<?php
$fh = fopen("Input.txt", "r");

$result = 0;
$fs = []; 
$ptr = []; 

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


processFsArray($fs, $result);

echo $result;


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


function processFsArray($fs, &$result)
{
    $size = 0;
    foreach($fs as $item) {
        if(is_array($item)) {
            $size += processFsArray($item, $result);
        } else {
            $size += $item;
        }
    }
    if($size < 100000) {
        $result += $size;
    }
    return $size;
}

?>