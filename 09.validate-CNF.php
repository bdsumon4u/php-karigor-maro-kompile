<?php

$str = readline("Enter a string: ");

$PN = ["Sagor", "Selim", "Salma", "Nipu"];
$P = ["he", "she", "I", "we", "you", "they"];
$N = ["book", "cow", "dog", "home", "grass", "rice", "mango"];
$V = ["read", "eat", "take", "run", "write"];

// RegEx: (PN|P) (V)( (N))?

$pattern = "/^(".implode("|", $PN+$P).") (".implode("|", $V).")( (".implode("|", $N)."))?$/";

if (preg_match($pattern, $str)) {
    echo "VALID" . PHP_EOL;
} else {
    echo "INVALID" . PHP_EOL;
}