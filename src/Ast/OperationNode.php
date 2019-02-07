<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

abstract class OperationNode extends Node
{
    /**
     * @var string
     */
    protected $operator;

    /**
     * @var Node
     */
    protected $firstOperand;

    /**
     * @var Node
     */
    protected $secondOperand;

    /**
     * @param string $operator
     */
    public function __construct($operator, Node $firstOperand, Node $secondOperand)
    {
        $this->operator = $operator;
        $this->firstOperand = $firstOperand;
        $this->secondOperand = $secondOperand;
    }
}
