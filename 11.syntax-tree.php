<?php

class PostFix
{
    private string $postfix = "";
    private array $stack = [];
    private array $preci = [
        '+' => 1,
        '-' => 1,
        '*' => 2,
        '/' => 2,
        '%' => 2,
        '^' => 3,
    ];

    public function __construct()
    {
        $this->parse(readline("Enter expression: "));
    }

    private function parse(string $exp)
    {
        for ($i = 0; $i < strlen($exp); $i++) {
            if (ctype_alnum($exp[$i])) {
                $this->postfix .= $exp[$i];
                continue;
            }
        
            if ($exp[$i] == '(') {
                $this->stack[] = $exp[$i];
                continue;
            }

            while ($this->closingBracket($exp[$i]) || $this->stHasHighPreci($exp[$i])) {
                $this->shift();
            }

            if ($exp[$i] != ')') {
                $this->stack[] = $exp[$i];
            }
        }

        while (!empty($this->stack)) {
            $this->shift();
        }
    }

    private function closingBracket(string $c)
    {
        return !empty($this->stack) && $c == ')' && end($this->stack) != '(';
    }

    private function stHasHighPreci(string $c)
    {
        return !empty($this->stack) && ($this->preci[end($this->stack)] ?? 0) >= ($this->preci[$c] ?? 0);
    }

    private function shift() {
        $op = array_pop($this->stack);
        if ($op != '(') {
            $this->postfix .= $op;
        }
    }

    public function __toString()
    {
        return $this->postfix;
    }
}

class TreeNode {
    public string $data;
    public ?TreeNode $left;
    public ?TreeNode $right;

    public function __construct(string $data)
    {
        $this->data = $data;
        $this->left = $this->right = null;
    }
}

class SyntaxTree {
    private TreeNode $root;

    public function __construct() {
        $this->parse(new PostFix());
    }

    private function parse(string $postfix) {
        echo $postfix . PHP_EOL;
        if (empty($postfix)) {
            return;
        }
        $this->root = new TreeNode(substr($postfix, -1));
        $postfix = substr($postfix, 0, -1);

        $stack = new SplStack();
        $stack->push($this->root);

        while (!$stack->isEmpty()) {
            $top = $stack->top();
            $back = substr($postfix, -1);
            $postfix = substr($postfix, 0, -1);
            
            if (!$top->right) {
                $top->right = new TreeNode($back);
                if (!ctype_alnum($back)) {
                    $stack->push($top->right);
                }
                continue;
            }
            if (!$top->left) {
                $top->left = new TreeNode($back);
                $stack->pop();
                if (!ctype_alnum($back)) {
                    $stack->push($top->left);
                }
            }
        }

        $this->levelOrder();
    }

    private function levelOrder() {
        $q1 = new SplQueue();
        $q2 = new SplQueue();
        $q1->enqueue($this->root);
        while (!$q1->isEmpty()) {
            $node = $q1->dequeue();
            echo $node->data . ' ';
            if ($node->left) {
                $q2->enqueue($node->left);
            }
            if ($node->right) {
                $q2->enqueue($node->right);
            }
            if ($q1->isEmpty()) {
                echo PHP_EOL;
                $q1 = $q2;
                $q2 = new SplQueue();
            }
        }
    }
}

new SyntaxTree();