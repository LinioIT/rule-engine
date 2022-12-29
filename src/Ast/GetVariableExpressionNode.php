<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

class GetVariableExpressionNode extends Node
{
    protected string $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function evaluate(): mixed
    {
        return $this->getContext()->get($this->key);
    }
}
