<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

abstract class OperationNode extends Node
{
    protected string $operator;
    protected mixed $firstOperand;
    protected mixed $secondOperand;

    public function __construct(string $operator, mixed $firstOperand, mixed $secondOperand)
    {
        $this->operator = $operator;
        $this->firstOperand = $firstOperand;
        $this->secondOperand = $secondOperand;
    }
}
