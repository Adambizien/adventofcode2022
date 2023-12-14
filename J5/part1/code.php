
<?php
$lines = file('Input.txt', FILE_IGNORE_NEW_LINES);
$result = array();
foreach ($lines as $line) {
    if(!strstr($line, ' 1   2')) continue;
    $data = str_replace(' ', '', $line);
    for($i = 0; $i < strlen($data); $i++){
        $result[$data[$i]] = array();
    }
}

$lines = array_reverse($lines);
foreach ($lines as $line) {
    if(!strstr($line, '[')) continue;
    $data = str_replace('[', '', $line);
    $data = str_replace(']', '', $data);

    $data = str_replace('    ', '0', $data);
    $data = str_replace(' ', '', $data);
    
    for($i = 0; $i < strlen($data); $i++){
        if($data[$i] == '0') continue;
        $result[$i + 1][] = $data[$i];
    }  
}


$lines = array_reverse($lines);

foreach ($lines as $line) {
    if(!strstr($line, 'move')) continue;
   
    $line = trim($line);

    preg_match('/move (\d+) from (\d+) to (\d+)/', $line, $procedure);

    $moves = $procedure[1];
    $source = $procedure[2];
    $destination = $procedure[3];

    for($i=1; $i<=$moves; $i++) {
        $crate = array_pop($result[$source]);
        $result[$destination][] = $crate;
    }
}


$count1 = count($result[1]);
$count2 = count($result[2]);
$count3 = count($result[3]);
$count4 = count($result[4]);
$count5 = count($result[5]);
$count6 = count($result[6]);
$count7 = count($result[7]);
$count8 = count($result[8]);
$count9 = count($result[9]);


echo "Result: ";
echo "<pre>";
var_dump($result[1][$count1 - 1].''.$result[2][$count2 - 1]."".$result[3][$count3 - 1]."".$result[4][$count4 - 1]."".$result[5][$count5 - 1]."".$result[6][$count6 - 1]."".$result[7][$count7 - 1]."".$result[8][$count8 - 1]."".$result[9][$count9 - 1]);

echo "</pre>";

?>

