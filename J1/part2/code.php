<?php
$cheminFichier = 'Input.txt';

$contenuFichier = file_get_contents($cheminFichier);

$lignes = explode("\n", $contenuFichier);


$topThreeElves = [];
$sum = 0;
$lutin = 1;

foreach ($lignes as $ligne) {
    if (ctype_space($ligne) !== false) {
        
        $topThreeElves[] = ['calories' => $sum, 'elf' => $lutin];
        
      
        usort($topThreeElves, function ($a, $b) {
            return $b['calories'] - $a['calories'];
        });

       
        $topThreeElves = array_slice($topThreeElves, 0, 3);
        
       
        $lutin++;
        $sum = 0;
    } else {
        $sum += (int)$ligne;
    }
}


echo '<pre>';
print_r($topThreeElves);
echo '</pre>';


$totalCalories = array_sum(array_column($topThreeElves, 'calories'));

echo 'Total des calories des trois premiers Elfes : ' . $totalCalories;
?>