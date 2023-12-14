<?php

$fileContent = file_get_contents('Input.txt');
$elements = explode(PHP_EOL, $fileContent);
$table = array();
$sum = 0;
foreach ($elements as $element) {
    $table = explode(",", $element);
    if($table){
        $table1 = explode("-", $table[0]);
        $table2 = explode("-", $table[1]);
        if(!($table1[0] < $table2[0]  && $table1[1] < $table2[0] || $table1[0] > $table2[1]  && $table1[1] > $table2[1])){
            ++$sum;
        }
        
    }
    $table = array();
}
echo 'le resultat :'.$sum;
?>