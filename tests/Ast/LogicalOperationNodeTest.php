<?php

namespace Linio\Component\RuleEngine\Ast;

class LogicalOperationNodeTest extends \PHPUnit_Framework_TestCase
{
    public function testAnd()
    {
        $node = new LogicalOperationNode('AND', new ScalarNode(true), new ScalarNode(true));
        $this->assertTrue($node->evaluate());

        $node = new LogicalOperationNode('AND', new ScalarNode(true), new ScalarNode(false));
        $this->assertFalse($node->evaluate());

        $node = new LogicalOperationNode('AND', new ScalarNode(false), new ScalarNode(false));
        $this->assertFalse($node->evaluate());
    }

    public function testOr()
    {
        $node = new LogicalOperationNode('OR', new ScalarNode(false), new ScalarNode(false));
        $this->assertFalse($node->evaluate());

        $node = new LogicalOperationNode('OR', new ScalarNode(true), new ScalarNode(false));
        $this->assertTrue($node->evaluate());

        $node = new LogicalOperationNode('OR', new ScalarNode(false), new ScalarNode(true));
        $this->assertTrue($node->evaluate());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Undefined logical operator: XUL
     */
    public function testIsDetectingBadOperator()
    {
        $node = new LogicalOperationNode('XUL', new ScalarNode(true), new ScalarNode(true));
        $node->evaluate();
    }
}
