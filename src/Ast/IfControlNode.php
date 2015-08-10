<?php

namespace Linio\Component\RuleEngine\Ast;

class IfControlNode extends Node
{
    /**
     * @var Node
     */
    protected $condition;

    /**
     * @var Node
     */
    protected $statement;

    /**
     * @param Node $condition
     * @param Node $statement
     */
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
