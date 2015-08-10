<?php

namespace Linio\Component\RuleEngine\Ast;

class StackedExpressionNodeTest extends \PHPUnit_Framework_TestCase
{
    public function testIsEvaluatingNode()
    {
        $node1 = $this->prophesize(Node::class);
        $node1->evaluate()->shouldBeCalled();
        $node2 = $this->prophesize(Node::class);
        $node2->evaluate()->shouldBeCalled();

        $stack = [
            $node1->reveal(),
            $node2->reveal(),
        ];

        $node = new StackedExpressionNode($stack);
        $node->evaluate();
    }
}
