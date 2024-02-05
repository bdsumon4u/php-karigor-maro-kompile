<?php

$code = readline("Enter code: ");

$database = [
    "CSE-3141" => "Computer Science & Engineering, 3rd year, 1st semester, Compiler Design, Theory.",
    "CSE-3142" => "Computer Science & Engineering, 3rd year, 1st semester, Compiler Design, Lab.",
];

echo ($database[$code] ?? "404 Not Found") . PHP_EOL;
