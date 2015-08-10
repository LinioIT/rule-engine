<?php

namespace Linio\Component\RuleEngine\Ast;

use Linio\Type\Dictionary;

class GetVariableExpressionNodeTest extends \PHPUnit_Framework_TestCase
{
    public function testIsEvaluatingNode()
    {
        $root = new CompileNode();
        $root->setContext(new Dictionary(['foo' => 'bar']));

        $node = new GetVariableExpressionNode('foo');
        $node->setRoot($root);
        $this->assertEquals('bar', $node->evaluate());
    }
}
