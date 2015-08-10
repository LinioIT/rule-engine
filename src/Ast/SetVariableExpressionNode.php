<?php

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
     * @param Node   $value
     */
    public function __construct($key, Node $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    public function evaluate()
    {
        $this->getContext()->set($this->key, $this->value->evaluate());
    }
}
