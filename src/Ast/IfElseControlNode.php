<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

class IfElseControlNode extends Node
{
    /**
     * @var IfControlNode[]
     */
    protected $conditionalExpressions = [];

    /**
     * @var Node|null
     */
    protected $elseStatement;

    /**
     * @param IfControlNode[] $conditionalExpressions
     * @param Node            $elseStatement
     */
    public function __construct(array $conditionalExpressions, Node $elseStatement = null)
    {
        $this->conditionalExpressions = $conditionalExpressions;
        $this->elseStatement = $elseStatement;
    }

    public function evaluate(): void
    {
        foreach ($this->conditionalExpressions as $conditionalExpression) {
            if ($conditionalExpression->evaluate()) {
                return;
            }
        }

        if ($this->elseStatement) {
            $this->elseStatement->evaluate();
        }
    }
}
