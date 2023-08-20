<?php

function findUniqueString(string $s): int
{
    $sLength = mb_strlen($s);

    if (1 > $sLength) {
        throw new InvalidArgumentException("You should give at least 1 letter");
    }
    if (100000 < $sLength) {
        throw new InvalidArgumentException("You should give at most 100000 letter");
    }
    if (!preg_match("/^[a-z]{1,10000}$/", $s)) {
        throw new InvalidArgumentException("You can use only lowercase English letters");
    }

    $numberOfOccurrences = array_count_values(str_split($s, 1));
    $uniqueCharacters = array_keys(
        array_filter($numberOfOccurrences, function($c) { return $c == 1; })
    );
    if (!empty($uniqueCharacters)) {
        $position = strpos($s, $uniqueCharacters[0]);
        if (isset($position)) {
            return $position+1;
        }
    }

    return -1;
}

echo findUniqueString('hashthegame');
