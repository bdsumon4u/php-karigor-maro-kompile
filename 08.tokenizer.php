<?php

new class // anonymous class
{
    private string $lex;

    public function __construct()
    {
        $this->lex = readline("Enter a string: ");

        echo $this->tokenize() . PHP_EOL;
    }

    private function tokenize()
    {
        if ($this->isKeyword()) {
            return "Keyword";
        }
        if ($this->isIdentifier()) {
            return "Identifier";
        }
        if ($this->isArithmetic()) {
            return "Arithmetic Operator";
        }
        if ($this->isAssignment()) {
            return "Assignment Operator";
        }
        if ($this->isRelational()) {
            return "Relational Operator";
        }
        if ($this->isShift()) {
            return "Shift Operator";
        }
        if ($this->isUnary()) {
            return "Unary Operator";
        }
        if ($this->isBitwise()) {
            return "Bitwise Operator";
        }
        if ($this->isConditional()) {
            return "Conditional Operator";
        }
        if (preg_match("/^\d+$/", $this->lex)) {
            return "Integer";
        }
        if (preg_match("/^\d*\.\d{0,2}$/", $this->lex)) {
            return "Float";
        }
        if (preg_match("/^\d*\.\d{3,}$/", $this->lex)) {
            return "Double";
        }

        return "Special";
    }

    private function isKeyword()
    {
        return in_array($this->lex, [
            'new', 'class', 'private', 'public', 'int', 'float',
            'char', 'double', 'struct', 'if', 'else', 'switch',
            'for', 'do', 'while', 'case', 'return', 'default',
        ]);
    }

    private function isIdentifier()
    {
        return preg_match("/^[a-zA-Z_]\w*$/", $this->lex);
    }

    private function isArithmetic() {
        return in_array($this->lex, [
            '+', '-', '*', '/', '%',
        ]);
    }

    private function isAssignment()
    {
        return in_array($this->lex, [
            '=', '+=', '-=', '*=', '/=', '%=', '>>=', '<<=', '&=', '|=',
        ]);
    }

    private function isRelational()
    {
        return in_array($this->lex, [
            '>', '<', '==', '!=', '>=', '<=',
        ]);
    }

    private function isShift()
    {
        return in_array($this->lex, [
            '>>', '<<',
        ]);
    }

    private function isUnary()
    {
        return in_array($this->lex, [
            '++', '--',
        ]);
    }

    private function isBitwise()
    {
        return in_array($this->lex, [
            '&', '|', '~', '^',
        ]);
    }

    private function isConditional()
    {
        return in_array($this->lex, [
            '&&', '||', '!',
        ]);
    }
};
