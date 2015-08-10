<?php

namespace Linio\Component\RuleEngine\Ast;

class IfElseControlNodeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getConditionals
     */
    public function testIsEvaluatingMultipleConditionals($conditionals, $context)
    {
        $root = new CompileNode();

        $elseStatement = new SetVariableExpressionNode('foo', new ScalarNode(42));
        $elseStatement->setRoot($root);

        $statement1 = new SetVariableExpressionNode('foo', new ScalarNode(1));
        $statement1->setRoot($root);

        $statement2 = new SetVariableExpressionNode('foo', new ScalarNode(2));
        $statement2->setRoot($root);

        $statement3 = new SetVariableExpressionNode('foo', new ScalarNode(3));
        $statement3->setRoot($root);

        $condition1 = new IfControlNode(new ScalarNode($conditionals[0]), $statement1);
        $condition2 = new IfControlNode(new ScalarNode($conditionals[1]), $statement2);
        $condition3 = new IfControlNode(new ScalarNode($conditionals[2]), $statement3);

        $node = new IfElseControlNode([$condition1, $condition2, $condition3], $elseStatement);
        $node->setRoot($root);
        $node->evaluate();
        $this->assertEquals($context, $node->getContext()->toArray());
    }

    public function getConditionals()
    {
        return [
            [[true, false, false], ['foo' => 1]],
            [[false, true, false], ['foo' => 2]],
            [[false, false, true], ['foo' => 3]],
            [[false, false, false], ['foo' => 42]],
        ];
    }
}
