<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

abstract class OperationNode extends Node
{
    protected string $operator;
    protected Node $firstOperand;
    protected Node $secondOperand;

    public function __construct(string $operator, Node $firstOperand, Node $secondOperand)
    {
        $this->operator = $operator;
        $this->firstOperand = $firstOperand;
        $this->secondOperand = $secondOperand;
    }
}
