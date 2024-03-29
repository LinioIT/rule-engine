<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

use RuntimeException;

class MathOperationNode extends OperationNode
{
    /** @return float|int */
    public function evaluate()
    {
        switch ($this->operator) {
            case 'ADD':
                return $this->firstOperand->evaluate() + $this->secondOperand->evaluate();

            case 'MINUS':
                return $this->firstOperand->evaluate() - $this->secondOperand->evaluate();

            case 'MULTIPLY':
                return $this->firstOperand->evaluate() * $this->secondOperand->evaluate();

            case 'DIVIDE':
                return $this->firstOperand->evaluate() / $this->secondOperand->evaluate();

            case 'POWER':
                return $this->firstOperand->evaluate() ** $this->secondOperand->evaluate();
        }

        throw new RuntimeException('Undefined operator: ' . $this->operator);
    }
}
