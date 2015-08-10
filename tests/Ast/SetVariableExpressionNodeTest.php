<?php

namespace Linio\Component\RuleEngine\Ast;

use Linio\Type\Dictionary;

class SetVariableExpressionNodeTest extends \PHPUnit_Framework_TestCase
{
    public function testIsEvaluatingNode()
    {
        $node = new SetVariableExpressionNode('foo', new ScalarNode('bar'));
        $node->setRoot(new CompileNode());
        $node->evaluate();

        $this->assertEquals(['foo' => 'bar'], $node->getContext()->toArray());
    }
}
