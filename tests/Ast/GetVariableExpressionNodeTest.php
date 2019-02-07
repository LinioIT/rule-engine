<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

use Linio\Type\Dictionary;
use PHPUnit\Framework\TestCase;

class GetVariableExpressionNodeTest extends TestCase
{
    public function testIsEvaluatingNode(): void
    {
        $root = new CompileNode();
        $root->setContext(new Dictionary(['foo' => 'bar']));

        $node = new GetVariableExpressionNode('foo');
        $node->setRoot($root);
        $this->assertEquals('bar', $node->evaluate());
    }
}
