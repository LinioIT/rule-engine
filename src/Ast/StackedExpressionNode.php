<?php

namespace Linio\Component\RuleEngine\Ast;

class StackedExpressionNode extends Node
{
    /**
     * @var Node[]
     */
    protected $stack = [];

    /**
     * @param Node[] $stack
     */
    public function __construct(array $stack)
    {
        $this->stack = $stack;
    }

    public function evaluate()
    {
        foreach ($this->stack as $stack) {
            $stack->evaluate();
        }
    }
}
