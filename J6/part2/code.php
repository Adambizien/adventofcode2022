<?php

$fileContent = file_get_contents('Input.txt');
$elements = explode(PHP_EOL, $fileContent);


for ($i = 0; $i < strlen($elements[0]); $i++) {
    $combinaison = [];

    for($j = $i ; $j < 14 + $i; $j++){
        $combinaison[]= $elements[0][$j];
    }


    if (count(array_unique($combinaison)) === 14) {
        echo "Le premier marqueur est complet après le caractère " . ($i + 14);
        break;
    }
    
}
?>