<?php

$token = readline("Enter something: ");

if (preg_match("/^ch_[a-zA-Z0-9]+$/", $token)) {
    echo "Character Variable\n";
} else if (preg_match("/^ch_[a-zA-Z0-9]+$/", $token)) {
    echo "Binary Variable\n";
} else if (preg_match("/^0(0|1)+$/", $token)) {
    echo "Binary Number\n";
} else {
    echo "Invalid Input or Undefined\n";
}
