<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

class ScalarNode extends Node
{
    /**
     * @var scalar
     */
    protected $value;

    /**
     * @param scalar $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    public function evaluate()
    {
        return $this->value;
    }
}
