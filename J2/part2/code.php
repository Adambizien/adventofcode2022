<?php
//A = Pierre B = Feuille C = Ciseaux
// X = perdu Y = match nul Z = gagnez
// Fonction pour déterminer le résultat d'un tour
function jouerTour($adversaire, $vous)
{
    
    if ($vous == 'Y') {
        if($adversaire == 'A'){
            $choix = 1;
        }else if($adversaire == 'B'){
            $choix = 2;
        }else if($adversaire == 'C'){
            $choix = 3;
        }
        // Match nul
        return $choix + 3;
    } elseif ($vous == 'Z') {
        if($adversaire == 'A'){
            $choix = 2;
        }else if($adversaire == 'B'){
            $choix = 3;
        }else if($adversaire == 'C'){
            $choix = 1;
        }
        // Vous gagnez
        return $choix + 6;
    } else {
        // Vous perdez
        if($adversaire == 'A'){
            $choix = 3;
        }else if($adversaire == 'B'){
            $choix = 1;
        }else if($adversaire == 'C'){
            $choix = 2;
        }
        return $choix + 0;
    }
}


$lines = file('Input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);


$totalScore = 0;

foreach ($lines as $line) {
    list($adversaire, $vous) = explode(' ', $line);
    // var_dump(jouerTour($adversaire, $vous));
    $totalScore += jouerTour($adversaire, $vous);
}


echo "Votre score total serait : $totalScore\n";

?>