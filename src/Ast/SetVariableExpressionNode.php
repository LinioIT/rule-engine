<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

class SetVariableExpressionNode extends Node
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var Node
     */
    protected $value;

    /**
     * @param string $key
     */
    public function __construct($key, Node $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    public function evaluate(): void
    {
        $this->getContext()->set($this->key, $this->value->evaluate());
    }
}
