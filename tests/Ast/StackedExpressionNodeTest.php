<?php

namespace Linio\Component\RuleEngine\Ast;

class StackedExpressionNodeTest extends \PHPUnit_Framework_TestCase
{
    public function testIsEvaluatingNode()
    {
        $node1 = $this->prophesize('Linio\Component\RuleEngine\Ast\Node');
        $node1->evaluate()->shouldBeCalled();
        $node2 = $this->prophesize('Linio\Component\RuleEngine\Ast\Node');
        $node2->evaluate()->shouldBeCalled();

        $stack = [
            $node1->reveal(),
            $node2->reveal(),
        ];

        $node = new StackedExpressionNode($stack);
        $node->evaluate();
    }
}
