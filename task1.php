<?php

//ini_set('memory_limit', '2000M');

function hashOrder(int $number): string
{
    $array  = array_map('intval', str_split(sprintf('%1$07d', $number)));

    return ((5 + $array[6]) % 10).((2 + $array[1]) % 10).$array[2].((9 + $array[0]) % 10).$array[3].((9 + $array[5]) % 10).((1 + $array[4]) % 10);
}

$unique = [];

echo "Starting test ....".PHP_EOL;
$start = microtime(true);

for ($i=1; $i<=9999999; $i++) {
    $result = hashOrder($i);

    if (!preg_match("/^[0-9]{7}$/", $result)) {
        throw new InvalidArgumentException("Result {$result} does not match regex");
    }

    if (!empty($unique[$result])) {
        throw new InvalidArgumentException("Colision detected for key {$i}:{$unique[$result]} and result {$result}");
    }

    $unique[$result] = $i;
}

$time_elapsed_secs = microtime(true) - $start;

if ($time_elapsed_secs > 60) {
    throw new InvalidArgumentException("Could not finish test in 60 seconds");
}

echo "Finished in {$time_elapsed_secs}";
