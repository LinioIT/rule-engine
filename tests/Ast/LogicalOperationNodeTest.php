<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

use PHPUnit\Framework\TestCase;

class LogicalOperationNodeTest extends TestCase
{
    public function testAnd(): void
    {
        $node = new LogicalOperationNode('AND', new ScalarNode(true), new ScalarNode(true));
        $this->assertTrue($node->evaluate());

        $node = new LogicalOperationNode('AND', new ScalarNode(true), new ScalarNode(false));
        $this->assertFalse($node->evaluate());

        $node = new LogicalOperationNode('AND', new ScalarNode(false), new ScalarNode(false));
        $this->assertFalse($node->evaluate());
    }

    public function testOr(): void
    {
        $node = new LogicalOperationNode('OR', new ScalarNode(false), new ScalarNode(false));
        $this->assertFalse($node->evaluate());

        $node = new LogicalOperationNode('OR', new ScalarNode(true), new ScalarNode(false));
        $this->assertTrue($node->evaluate());

        $node = new LogicalOperationNode('OR', new ScalarNode(false), new ScalarNode(true));
        $this->assertTrue($node->evaluate());
    }

    public function testIsDetectingBadOperator(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Undefined logical operator: XUL');

        $node = new LogicalOperationNode('XUL', new ScalarNode(true), new ScalarNode(true));
        $node->evaluate();
    }
}
