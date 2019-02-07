<?php

declare(strict_types=1);

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

    public function evaluate(): void
    {
        foreach ($this->stack as $stack) {
            $stack->evaluate();
        }
    }
}
