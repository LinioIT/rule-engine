<?php

namespace Linio\Component\RuleEngine\Ast;

class ScalarNodeTest extends \PHPUnit_Framework_TestCase
{
    public function testIsEvaluatingNode()
    {
        $node = new ScalarNode(10);
        $this->assertEquals(10, $node->evaluate());

        $node = new ScalarNode(true);
        $this->assertEquals(true, $node->evaluate());
    }
}
