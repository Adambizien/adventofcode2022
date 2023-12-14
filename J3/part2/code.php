<?php

function calculatePriority($item)
{
    $lowercase = range('a', 'z');
    $uppercase = range('A', 'Z');

    if (in_array($item, $lowercase)) {
        return array_search($item, $lowercase) + 1;
    } elseif (in_array($item, $uppercase)) {
        return array_search($item, $uppercase) + 27;
    } else {
        return 0; 
    }
}


function findSumOfPriorities($compartment)
{
    $items1 = str_split($compartment[0]);
    $items2 = str_split($compartment[1]);
    $items3 = str_split($compartment[2]);

    $commonItems = array_unique(array_intersect($items1, $items2,$items3));
    
    $sum = 0;
    $commonItems= array_map('trim', $commonItems);
    $commonItems = implode("", $commonItems);
    var_dump(str_replace(' ', '', $commonItems));
    var_dump(calculatePriority($commonItems));
    $sum += calculatePriority($commonItems);
    return $sum;
}


$fileContent = file_get_contents('Input.txt');


$rucksacks = explode(PHP_EOL, $fileContent);


$totalSum = 0;
$table = array();
foreach ($rucksacks as $rucksack) {
    
    
    $table[] = $rucksack;

    if ($rucksack && count($table) == 3) {
        $sumOfPriorities = findSumOfPriorities($table);
        $totalSum += $sumOfPriorities;
        $table= array();
    }
}

echo "la sommes des prioriter: " . $totalSum . PHP_EOL;

?>