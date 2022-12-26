<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

class IfElseControlNode extends Node
{
    /**
     * @var IfControlNode[]
     */
    protected array $conditionalExpressions = [];
    protected ?Node $elseStatement;

    /**
     * @param IfControlNode[] $conditionalExpressions
     */
    public function __construct(array $conditionalExpressions, Node $elseStatement = null)
    {
        $this->conditionalExpressions = $conditionalExpressions;
        $this->elseStatement = $elseStatement;
    }

    /** @return void */
    public function evaluate()
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
