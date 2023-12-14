<?php
$lines = file('Input.txt', FILE_IGNORE_NEW_LINES);
function checkCycle() {
    global $cycle, $currentRegister;

    $cycleInLine = $cycle % 40;

    if ($cycleInLine >= $currentRegister - 1 && $cycleInLine <= $currentRegister + 1) {
        printf('#');
    }
    else {
        printf('.');
    }

    if ($cycleInLine == 39) {
        printf("\n");
    }
}

$cycle = 0;
$currentRegister = 1;

foreach ($lines as $line) {
    if ($line == 'noop') {
        checkCycle();
        $cycle++;
        continue;
    }
    
    preg_match('/^addx (-?\d+)$/', $line, $regs);
    checkCycle();
    $cycle++;
    checkCycle();
    $cycle++;
    $currentRegister += $regs[1];
}