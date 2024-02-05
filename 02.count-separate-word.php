<?php

// Munmun  is the student   of   Computer Science & Engineering.
$str = readline("Enter a string: ");

$len = strlen($str);
// echo $len . PHP_EOL;

$vowels = $consonants = $word = $v_str = $c_str = "";

for ($i = 0; $i < $len; $i++) {
    if (isVowel($str[$i])) {
        $vowels .= $str[$i];

        if (!$i || $str[$i-1]==' ') {
            $word = &$v_str;
            if (strlen($word)) {
                $word .= ' ';
            }
        }
    } else if (ctype_alpha($str[$i])) {
        $consonants .= $str[$i];

        if (!$i || $str[$i - 1] == ' ') {
            $word = &$c_str;
            if (strlen($word)) {
                $word .= ' ';
            }
        }
    }

    if ($str[$i] != ' ') {
        $word .= $str[$i];
    }
}

echo "COUNT(Vowels): " . strlen($vowels) . PHP_EOL;
echo "COUNT(Consonants): " . strlen($consonants) . PHP_EOL;

echo "Vowels: [" . count_chars($vowels, 3) . "]" . PHP_EOL;
echo "Consonants: [" . count_chars($consonants, 3) . "]" . PHP_EOL;

echo "Vowel String: " . $v_str . PHP_EOL;
echo "Consonant String: " . $c_str . PHP_EOL;

function isVowel($c) {
    if (ctype_alpha($c)) {
        $c = strtolower($c);
    }

    return $c == 'a'
        || $c == 'e'
        || $c == 'i'
        || $c == 'o'
        || $c == 'u';
}