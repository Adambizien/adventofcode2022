
<?php

$lignes =  file_get_contents('Input.txt') ;
preg_match_all('/Monkey (?<monkey>\d+):.*?Starting items: (?<items>[\d, ]+).*?Operation: new = old (?<operator>.) (?<operand>\w+).*?Test: divisible by (?<test>\d+).*?If true: throw to monkey (?<true>\d+).*?If false: throw to monkey (?<false>\d+)/ms', $lignes, $matches, \PREG_SET_ORDER);

$monkeys = [];
foreach ($matches as $match) {
    $monkeys[(int)$match['monkey']] = [
        'items' => array_map('intval', explode(', ', $match['items'])),
        'operator' => $match['operator'],
        'operand' => ctype_digit($match['operand']) ? (int)$match['operand'] : $match['operand'],
        'testDivisor' => (int)$match['test'],
        'testTrue' => (int)$match['true'],
        'testFalse' => (int)$match['false'],
        'inspectCount' => 0,
    ];
}

for ($round = 1; $round <= 20; $round++) {
    foreach ($monkeys as $monkey => &$data) {
        foreach ($data['items'] as $itemWorryLevel) {
            $operand = $data['operand'] === 'old' ? $itemWorryLevel : $data['operand'];
            $itemWorryLevel = match ($data['operator']) {
                '*' => $itemWorryLevel * $operand,
                '+' => $itemWorryLevel + $operand,
            };
            $itemWorryLevel = (int)floor($itemWorryLevel / 3);
            $test = ($itemWorryLevel % $data['testDivisor']) === 0;
            $receivingMonkey = $test ? $data['testTrue'] : $data['testFalse'];
            $monkeys[$receivingMonkey]['items'][] = $itemWorryLevel;
            $data['inspectCount']++;
        }
        $data['items'] = [];
    }
    unset($data);
}

usort($monkeys, static fn ($a, $b): int => $b['inspectCount'] <=> $a['inspectCount']);
$result = $monkeys[0]['inspectCount'] * $monkeys[1]['inspectCount'];

echo $result ;
?>