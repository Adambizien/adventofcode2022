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


function findSumOfPriorities($compartment1, $compartment2)
{
    $items1 = str_split($compartment1);
    $items2 = str_split($compartment2);

    $commonItems = array_unique(array_intersect($items1, $items2));
    
    $sum = 0;
    $commonItems = implode(" ", $commonItems);
    var_dump($commonItems);
    $sum += calculatePriority($commonItems);
    // foreach ($commonItems as $item) {
    //     var_dump($item);
    //     $sum += calculatePriority($item);
    //     var_dump($sum);
    // }
    return $sum;
}


$fileContent = file_get_contents('Input.txt');


$rucksacks = explode(PHP_EOL, $fileContent);


$totalSum = 0;

foreach ($rucksacks as $rucksack) {
    $compartments = strlen($rucksack);
    $compartment1 = substr($rucksack, 0, $compartments / 2);
    $compartment2 = substr($rucksack, $compartments / 2);

    if ($compartments) {
        $sumOfPriorities = findSumOfPriorities($compartment1, $compartment2);
        $totalSum += $sumOfPriorities;
    }
}

echo "la sommes des prioriter: " . $totalSum . PHP_EOL;

?>