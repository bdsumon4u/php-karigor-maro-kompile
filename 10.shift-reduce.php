<?php

new class // Parser
{
    private array $G = [
        'E+E' => 'E',
        'E-E' => 'E',
        'E*E' => 'E',
        'E/E' => 'E',
        '(E)' => 'E',
        'id' => 'E',
    ];

    private string $stack = '$';
    private string $input = 'id+id*(id-id)/id$';

    /* *** OUTPUT ***
        STACK                    INPUT                    ACTION                  
        ------------------------ ------------------------ ------------------------
        $                        id+id*(id-id)/id$        SHIFT
        $i                       d+id*(id-id)/id$         SHIFT
        $id                      +id*(id-id)/id$          REDUCE: id -> E
        $E                       +id*(id-id)/id$          SHIFT
        $E+                      id*(id-id)/id$           SHIFT
        $E+i                     d*(id-id)/id$            SHIFT
        $E+id                    *(id-id)/id$             REDUCE: id -> E
        $E+E                     *(id-id)/id$             REDUCE: E+E -> E
        $E                       *(id-id)/id$             SHIFT
        $E*                      (id-id)/id$              SHIFT
        $E*(                     id-id)/id$               SHIFT
        $E*(i                    d-id)/id$                SHIFT
        $E*(id                   -id)/id$                 REDUCE: id -> E
        $E*(E                    -id)/id$                 SHIFT
        $E*(E-                   id)/id$                  SHIFT
        $E*(E-i                  d)/id$                   SHIFT
        $E*(E-id                 )/id$                    REDUCE: id -> E
        $E*(E-E                  )/id$                    REDUCE: E-E -> E
        $E*(E                    )/id$                    SHIFT
        $E*(E)                   /id$                     REDUCE: (E) -> E
        $E*E                     /id$                     REDUCE: E*E -> E
        $E                       /id$                     SHIFT
        $E/                      id$                      SHIFT
        $E/i                     d$                       SHIFT
        $E/id                    $                        REDUCE: id -> E
        $E/E                     $                        REDUCE: E/E -> E
        $E                       $                        ACCEPT
    */

    public function __construct()
    {
        $this->input = readline("Enter expression: ") . '$';

        $this->parse(24);
    }

    private function parse(int $width)
    {
        echo str_pad("STACK", $width) .' '. str_pad("INPUT", $width) .' '. str_pad("ACTION", $width) . PHP_EOL;
        echo str_pad('', $width, '-') .' '. str_pad('', $width, '-') .' '. str_pad('', $width, '-') . PHP_EOL;

        while (true) {
            echo str_pad($this->stack, $width) . ' ' . str_pad($this->input, $width) . ' ';
            if ($this->input == '$' && $this->stack == '$E') {
                echo "ACCEPT" . PHP_EOL;
                break;
            }
            if (! strlen($this->input) || ! $this->reduce($width)) {
                echo "REJECT" . PHP_EOL;
                break;
            }
        }
    }

    private function reduce() {
        foreach ($this->G as $key => $value) {
            if (substr($this->stack, -strlen($key)) == $key) {
                $this->stack = substr($this->stack, 0, -strlen($key));
                $this->stack .= $value;
                echo "REDUCE: $key -> $value" . PHP_EOL;
                return true;
            }
        }
        
        return $this->shift();
    }

    private function shift() {
        $this->stack .= $this->input[0];
        $this->input = substr($this->input, 1);
        echo "SHIFT" . PHP_EOL;
        return true;
    }
};
