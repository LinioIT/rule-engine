<?php

namespace Linio\Component\RuleEngine\Ast;

class ComparisonOperationNodeTest extends \PHPUnit_Framework_TestCase
{
    public function testIsComparingEqual()
    {
        $node = new ComparisonOperationNode('EQ', new ScalarNode(1), new ScalarNode(1));
        $this->assertTrue($node->evaluate());

        $node = new ComparisonOperationNode('EQ', new ScalarNode(2), new ScalarNode(1));
        $this->assertFalse($node->evaluate());
    }

    public function testIsComparingNotEqual()
    {
        $node = new ComparisonOperationNode('NEQ', new ScalarNode(2), new ScalarNode(1));
        $this->assertTrue($node->evaluate());

        $node = new ComparisonOperationNode('NEQ', new ScalarNode(1), new ScalarNode(1));
        $this->assertFalse($node->evaluate());
    }

    public function testIsComparingGreaterThan()
    {
        $node = new ComparisonOperationNode('GT', new ScalarNode(2), new ScalarNode(1));
        $this->assertTrue($node->evaluate());

        $node = new ComparisonOperationNode('GT', new ScalarNode(1), new ScalarNode(1));
        $this->assertFalse($node->evaluate());
    }

    public function testIsComparingGreaterThanOrEqual()
    {
        $node = new ComparisonOperationNode('GTE', new ScalarNode(2), new ScalarNode(1));
        $this->assertTrue($node->evaluate());

        $node = new ComparisonOperationNode('GTE', new ScalarNode(1), new ScalarNode(1));
        $this->assertTrue($node->evaluate());
    }

    public function testIsComparingLowerThan()
    {
        $node = new ComparisonOperationNode('LT', new ScalarNode(1), new ScalarNode(2));
        $this->assertTrue($node->evaluate());

        $node = new ComparisonOperationNode('LT', new ScalarNode(1), new ScalarNode(1));
        $this->assertFalse($node->evaluate());
    }

    public function testIsComparingLowerThanOrEqual()
    {
        $node = new ComparisonOperationNode('LTE', new ScalarNode(1), new ScalarNode(2));
        $this->assertTrue($node->evaluate());

        $node = new ComparisonOperationNode('LTE', new ScalarNode(1), new ScalarNode(1));
        $this->assertTrue($node->evaluate());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Undefined comparison operator: XUL
     */
    public function testIsDetectingBadOperator()
    {
        $node = new ComparisonOperationNode('XUL', new ScalarNode(1), new ScalarNode(1));
        $node->evaluate();
    }
}
