<?php

namespace Linio\Component\RuleEngine\Ast;

class GetVariableExpressionNode extends Node
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @param string $key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    public function evaluate()
    {
        return $this->getContext()->get($this->key);
    }
}
