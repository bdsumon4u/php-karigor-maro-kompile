<?php

new class // anonymous class
{
    private int $len;
    private string $str;
    private int $idx = 0;

    public function __construct()
    {
        // int main() { int a = 5; a++; a+= 3; int xy_z = 7; xyz +=2; float _a8b = .35+a+b; return 0; }
        $this->str = readline("Enter a string: ");
        $this->len = strlen($this->str);

        while ($token = $this->getNextToken()) {
            echo $token . ' : ' . $this->recognize($token) . PHP_EOL;
        }

        /* *** OUTPUT ***
            int : Keyword
            main : Identifier
            ( : Special
            ) : Special
            { : Special
            int : Keyword
            a : Identifier
            = : Operator
            5 : Constant
            ; : Special
            a : Identifier
            ++ : Operator
            ; : Special
            a : Identifier
            += : Operator
            3 : Constant
            ; : Special
            int : Keyword
            xy_z : Identifier
            = : Operator
            7 : Constant
            ; : Special
            xyz : Identifier
            += : Operator
            2 : Constant
            ; : Special
            float : Keyword
            _a8b : Identifier
            = : Operator
            .35 : Constant
            + : Operator
            a : Identifier
            + : Operator
            b : Identifier
            ; : Special
            return : Keyword
        */
    }

    private function getNextToken() {
        if ($this->idx >= $this->len) {
            return "";
        }
        if ($this->str[$this->idx] == ' ') {
            $this->idx++;
            return $this->getNextToken();
        }
        if (in_array($c = $this->str[$this->idx], ['(', ')', '{', '}', ';'])) {
            $this->idx++;
            return $c;
        }
        if ($this->isOperator($this->str[$this->idx])) {
            return $this->extractOperator();
        }
        if ($this->mayBeNumeric($this->str[$this->idx])) {
            return $this->extractNumeric();
        }
        $token = "";
        while ($this->idx < $this->len && $this->mayBeIdOrKey($c = $this->str[$this->idx])) {
            $token .= $c;
            $this->idx++;
        }
        return $token;
    }

    private function extractOperator() {
        $token = $this->str[$this->idx];
        $this->idx++;
        if ($this->idx < $this->len && $this->isOperator($token . $this->str[$this->idx])) {
            $token .= $this->str[$this->idx];
            $this->idx++;
        }
        return $token;
    }

    private function mayBeNumeric(string $c) {
        return ctype_digit($c) || $c == '.';
    }

    private function extractNumeric() {
        $token = "";
        while ($this->idx < $this->len && $this->mayBeNumeric($c = $this->str[$this->idx])) {
            $token .= $c;
            $this->idx++;
        }
        return $token;
    }

    private function mayBeIdOrKey(string $c) {
        return ctype_alnum($c) || $c == '_';
    }

    private function recognize($token)
    {
        if ($this->isKeyword($token)) {
            return "Keyword";
        }
        if ($this->isIdentifier($token)) {
            return "Identifier";
        }
        if ($this->isOperator($token)) {
            return "Operator";
        }
        if ($this->isConstant($token)) {
            return "Constant";
        }

        return "Special";
    }

    private function isKeyword(string $token)
    {
        return in_array($token, [
            'new', 'class', 'private', 'public', 'int', 'float',
            'char', 'double', 'struct', 'if', 'else', 'switch',
            'for', 'do', 'while', 'case', 'return', 'default',
        ]);
    }

    private function isIdentifier(string $token)
    {
        return preg_match("/^[a-zA-Z_]\w*$/", $token);
    }

    private function isOperator(string $token)
    {
        return in_array($token, [
            '+', '-', '*', '/', '%', '=', '+=', '-=', '*=', '/=', '%=',
            '>>', '<<', '>', '<', '==', '!=', '>=', '<=', '>>=', '<<=',
            '&', '|', '!', '&&', '||', '&=', '|=', '++', '--',
        ]);
    }

    private function isConstant(string $token)
    {
        return preg_match("/^\d+(\.\d+)?$|^\.\d+$/", $token);
    }
};
