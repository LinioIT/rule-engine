<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

class IfControlNode extends Node
{
    protected mixed $condition;
    protected mixed $statement;

    public function __construct(mixed $condition, mixed $statement)
    {
        $this->condition = $condition;
        $this->statement = $statement;
    }

    /** @return bool */
    public function evaluate()
    {
        if ($this->condition->evaluate()) {
            $this->statement->evaluate();

            return true;
        }

        return false;
    }
}
