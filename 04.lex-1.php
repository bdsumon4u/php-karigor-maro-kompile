<?php

$token = readline("Enter something: ");

if (preg_match("/^[i-nI-N][a-zA-Z0-9]*$/", $token)) {
    echo "Integer Variable\n";
} else if (preg_match("/^[1-9]\d{0,3}$/", $token)) {
    echo "ShortInt Number\n";
} else if (preg_match("/^[1-9]\d{4,}$/", $token)) {
    echo "LongInt Number\n";
} else {
    echo "Invalid Input or Undefined\n";
}