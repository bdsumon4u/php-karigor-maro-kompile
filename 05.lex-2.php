<?php

$token = readline("Enter something: ");

if (preg_match("/^[a-hA-Ho-zO-Z][a-zA-Z0-9]*$/", $token)) {
    echo "Float Variable\n";
} else if (preg_match("/^(0|([1-9]\d*))\.\d{2}$/", $token)) {
    echo "Float Number\n";
} else if (preg_match("/^(0|([1-9]\d*))\.\d{3,}$/", $token)) {
    echo "Double Number\n";
} else {
    echo "Invalid Input or Undefined\n";
}
