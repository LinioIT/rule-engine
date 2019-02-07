<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

class LogicalOperationNode extends OperationNode
{
    public function evaluate()
    {
        switch ($this->operator) {
            case 'AND':
                return $this->firstOperand->evaluate() && $this->secondOperand->evaluate();

            case 'OR':
                return $this->firstOperand->evaluate() || $this->secondOperand->evaluate();
        }

        throw new \RuntimeException('Undefined logical operator: ' . $this->operator);
    }
}
