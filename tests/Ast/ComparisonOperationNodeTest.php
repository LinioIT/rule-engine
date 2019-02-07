<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

use PHPUnit\Framework\TestCase;

class ComparisonOperationNodeTest extends TestCase
{
    public function testIsComparingEqual(): void
    {
        $node = new ComparisonOperationNode('EQ', new ScalarNode(1), new ScalarNode(1));
        $this->assertTrue($node->evaluate());

        $node = new ComparisonOperationNode('EQ', new ScalarNode(2), new ScalarNode(1));
        $this->assertFalse($node->evaluate());
    }

    public function testIsComparingNotEqual(): void
    {
        $node = new ComparisonOperationNode('NEQ', new ScalarNode(2), new ScalarNode(1));
        $this->assertTrue($node->evaluate());

        $node = new ComparisonOperationNode('NEQ', new ScalarNode(1), new ScalarNode(1));
        $this->assertFalse($node->evaluate());
    }

    public function testIsComparingGreaterThan(): void
    {
        $node = new ComparisonOperationNode('GT', new ScalarNode(2), new ScalarNode(1));
        $this->assertTrue($node->evaluate());

        $node = new ComparisonOperationNode('GT', new ScalarNode(1), new ScalarNode(1));
        $this->assertFalse($node->evaluate());
    }

    public function testIsComparingGreaterThanOrEqual(): void
    {
        $node = new ComparisonOperationNode('GTE', new ScalarNode(2), new ScalarNode(1));
        $this->assertTrue($node->evaluate());

        $node = new ComparisonOperationNode('GTE', new ScalarNode(1), new ScalarNode(1));
        $this->assertTrue($node->evaluate());
    }

    public function testIsComparingLowerThan(): void
    {
        $node = new ComparisonOperationNode('LT', new ScalarNode(1), new ScalarNode(2));
        $this->assertTrue($node->evaluate());

        $node = new ComparisonOperationNode('LT', new ScalarNode(1), new ScalarNode(1));
        $this->assertFalse($node->evaluate());
    }

    public function testIsComparingLowerThanOrEqual(): void
    {
        $node = new ComparisonOperationNode('LTE', new ScalarNode(1), new ScalarNode(2));
        $this->assertTrue($node->evaluate());

        $node = new ComparisonOperationNode('LTE', new ScalarNode(1), new ScalarNode(1));
        $this->assertTrue($node->evaluate());
    }

    public function testIsDetectingBadOperator(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Undefined comparison operator: XUL');

        $node = new ComparisonOperationNode('XUL', new ScalarNode(1), new ScalarNode(1));
        $node->evaluate();
    }
}
