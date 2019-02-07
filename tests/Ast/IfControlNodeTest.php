<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

use PHPUnit\Framework\TestCase;

class IfControlNodeTest extends TestCase
{
    /**
     * @dataProvider getConditionals
     */
    public function testIsEvaluating($conditional, $result, $context): void
    {
        $root = new CompileNode();

        $statement = new SetVariableExpressionNode('foo', new ScalarNode('bar'));
        $statement->setRoot($root);

        $node = new IfControlNode($conditional, $statement);
        $node->setRoot($root);
        $this->assertEquals($result, $node->evaluate());
        $this->assertEquals($context, $node->getContext()->toArray());
    }

    public function getConditionals()
    {
        return [
            [new ScalarNode(true), true, ['foo' => 'bar']],
            [new ScalarNode(false), false, []],
        ];
    }
}
