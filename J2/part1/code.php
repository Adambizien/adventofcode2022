<?php
//A = Pierre B = Feuille C = Ciseaux
// X = Pierre Y = Feuille Z = Ciseaux
// Fonction pour déterminer le résultat d'un tour
function jouerTour($adversaire, $vous)
{
    if($vous == 'X'){
        $choix = 1;
    }else if( $vous == 'Y'){
        $choix = 2;
    }else if($vous == 'Z'){
        $choix = 3;
    }
    if ($adversaire =='A' &&  $vous == "X" || $adversaire =='B' &&  $vous == "Y" || $adversaire =='C' &&  $vous == "Z") {
        // Match nul
        return $choix + 3;
    } elseif (($adversaire == 'A' && $vous == 'Y') || ($adversaire == 'B' && $vous == 'Z') || ($adversaire == 'C' && $vous == 'X')) {
        // Vous gagnez
        return $choix + 6;
    } else {
        // Vous perdez
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