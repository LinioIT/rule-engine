<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

class SetVariableExpressionNode extends Node
{
    protected string $key;
    protected Node $value;

    public function __construct(string $key, Node $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /** @return void */
    public function evaluate()
    {
        $this->getContext()->set($this->key, $this->value->evaluate());
    }
}
