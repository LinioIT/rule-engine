<?php

namespace Linio\Component\RuleEngine\Ast;

class MathOperationNode extends OperationNode
{
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
                return pow($this->firstOperand->evaluate(), $this->secondOperand->evaluate());
        }

        throw new \RuntimeException('Undefined operator: ' . $this->operator);
    }
}
