<?php

$fileContent = file_get_contents('Input.txt');
$elements = explode(PHP_EOL, $fileContent);


for ($i = 0; $i < strlen($elements[0]); $i++) {
    $combinaison = [$elements[0][$i], $elements[0][$i+1], $elements[0][$i+2], $elements[0][$i+3]];

    if (count(array_unique($combinaison)) === 4) {
        echo "Le premier marqueur est complet après le caractère " . ($i + 4);
        break;
    }
    
}

?>