<?php

namespace Linio\Component\RuleEngine\Ast;

class MathOperationNodeTest extends \PHPUnit_Framework_TestCase
{
    public function testIsAdding()
    {
        $node = new MathOperationNode('ADD', new ScalarNode(1), new ScalarNode(1));
        $this->assertEquals(2, $node->evaluate());
    }

    public function testIsSubtracting()
    {
        $node = new MathOperationNode('MINUS', new ScalarNode(2), new ScalarNode(1));
        $this->assertEquals(1, $node->evaluate());
    }

    public function testIsMultiplying()
    {
        $node = new MathOperationNode('MULTIPLY', new ScalarNode(2), new ScalarNode(2));
        $this->assertEquals(4, $node->evaluate());
    }

    public function testIsDividing()
    {
        $node = new MathOperationNode('DIVIDE', new ScalarNode(4), new ScalarNode(2));
        $this->assertEquals(2, $node->evaluate());
    }

    public function testIsRaisingToThePowerOf()
    {
        $node = new MathOperationNode('POWER', new ScalarNode(2), new ScalarNode(8));
        $this->assertEquals(256, $node->evaluate());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Undefined operator: XUL
     */
    public function testIsDetectingBadOperator()
    {
        $node = new MathOperationNode('XUL', new ScalarNode(1), new ScalarNode(1));
        $node->evaluate();
    }
}
