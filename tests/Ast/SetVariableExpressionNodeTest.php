<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

use PHPUnit\Framework\TestCase;

class SetVariableExpressionNodeTest extends TestCase
{
    public function testIsEvaluatingNode(): void
    {
        $node = new SetVariableExpressionNode('foo', new ScalarNode('bar'));
        $node->setRoot(new CompileNode());
        $node->evaluate();

        $this->assertEquals(['foo' => 'bar'], $node->getContext()->toArray());
    }
}
