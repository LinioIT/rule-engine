<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

class ComparisonOperationNode extends OperationNode
{
    public function evaluate()
    {
        switch ($this->operator) {
            case 'EQ':
                return $this->firstOperand->evaluate() == $this->secondOperand->evaluate();

            case 'NEQ':
                return $this->firstOperand->evaluate() != $this->secondOperand->evaluate();

            case 'GT':
                return $this->firstOperand->evaluate() > $this->secondOperand->evaluate();

            case 'GTE':
                return $this->firstOperand->evaluate() >= $this->secondOperand->evaluate();

            case 'LT':
                return $this->firstOperand->evaluate() < $this->secondOperand->evaluate();

            case 'LTE':
                return $this->firstOperand->evaluate() <= $this->secondOperand->evaluate();
        }

        throw new \RuntimeException('Undefined comparison operator: ' . $this->operator);
    }
}
