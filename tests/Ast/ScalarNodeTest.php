<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

use PHPUnit\Framework\TestCase;

class ScalarNodeTest extends TestCase
{
    public function testIsEvaluatingNode(): void
    {
        $node = new ScalarNode(10);
        $this->assertEquals(10, $node->evaluate());

        $node = new ScalarNode(true);
        $this->assertTrue($node->evaluate());
    }
}
