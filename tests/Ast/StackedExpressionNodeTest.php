<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class StackedExpressionNodeTest extends TestCase
{
    use ProphecyTrait;

    public function testIsEvaluatingNode(): void
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
