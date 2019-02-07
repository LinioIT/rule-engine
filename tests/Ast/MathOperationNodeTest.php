<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

use PHPUnit\Framework\TestCase;

class MathOperationNodeTest extends TestCase
{
    public function testIsAdding(): void
    {
        $node = new MathOperationNode('ADD', new ScalarNode(1), new ScalarNode(1));
        $this->assertEquals(2, $node->evaluate());
    }

    public function testIsSubtracting(): void
    {
        $node = new MathOperationNode('MINUS', new ScalarNode(2), new ScalarNode(1));
        $this->assertEquals(1, $node->evaluate());
    }

    public function testIsMultiplying(): void
    {
        $node = new MathOperationNode('MULTIPLY', new ScalarNode(2), new ScalarNode(2));
        $this->assertEquals(4, $node->evaluate());
    }

    public function testIsDividing(): void
    {
        $node = new MathOperationNode('DIVIDE', new ScalarNode(4), new ScalarNode(2));
        $this->assertEquals(2, $node->evaluate());
    }

    public function testIsRaisingToThePowerOf(): void
    {
        $node = new MathOperationNode('POWER', new ScalarNode(2), new ScalarNode(8));
        $this->assertEquals(256, $node->evaluate());
    }

    public function testIsDetectingBadOperator(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Undefined operator: XUL');

        $node = new MathOperationNode('XUL', new ScalarNode(1), new ScalarNode(1));
        $node->evaluate();
    }
}
