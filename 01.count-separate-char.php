<?php

// Md. Tareq   Zaman, Part-3, 2011
$str = readline("Enter a string: ");

$len = strlen($str);
// echo $len . PHP_EOL;

$letters = $digits = $others = "";

$inWord = false;
$word_count = 0;

for ($i = 0; $i <= $len; $i++) {
    if ($i == $len || $str[$i] == ' ') {
        $word_count += $inWord;
        $inWord = !$inWord;
        if ($i == $len) {
            break;
        }
    }

    $inWord = $str[$i] != ' ';

    if (ctype_alpha($str[$i])) {
        $letters .= $str[$i];
    } else if (ctype_digit($str[$i])) {
        $digits .= $str[$i];
    } else {
        $others .= $str[$i];
    }
}

echo "COUNT(Words): " . $word_count . PHP_EOL;

echo "COUNT(Letters): " . strlen($letters) . PHP_EOL;
echo "COUNT(Digits): " . strlen($digits) . PHP_EOL;
echo "COUNT(Others): " . strlen($others) . PHP_EOL;

echo "Letters: [" . $letters . "]" . PHP_EOL;
echo "Digits: [" . $digits . "]" . PHP_EOL;
echo "Others: [" . $others . "]" . PHP_EOL;
