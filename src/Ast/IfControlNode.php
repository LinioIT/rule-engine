<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

class IfControlNode extends Node
{
    protected Node $condition;
    protected Node $statement;

    public function __construct(Node $condition, Node $statement)
    {
        $this->condition = $condition;
        $this->statement = $statement;
    }

    public function evaluate()
    {
        if ($this->condition->evaluate()) {
            $this->statement->evaluate();

            return true;
        }

        return false;
    }
}
