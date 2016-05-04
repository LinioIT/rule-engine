<?php

namespace Linio\Component\RuleEngine\Ast;

use Linio\Type\Dictionary;

class CompileNodeTest extends \PHPUnit_Framework_TestCase
{
    public function testIsSettingUp()
    {
        $root = new CompileNode();
        $this->assertInstanceOf('Linio\Type\Dictionary', $root->getContext());
    }

    public function testIsEvaluating()
    {
        $child1 = $this->prophesize('Linio\Component\RuleEngine\Ast\Node');
        $child1->evaluate()->shouldBeCalled();
        $child2 = $this->prophesize('Linio\Component\RuleEngine\Ast\Node');
        $child2->evaluate()->shouldBeCalled();

        $root = new CompileNode();
        $root->addChild($child1->reveal());
        $root->addChild($child2->reveal());
        $root->evaluate();
    }

    public function testIsAppendingMultipleChilds()
    {
        $child1 = $this->prophesize('Linio\Component\RuleEngine\Ast\Node')->reveal();
        $child2 = $this->prophesize('Linio\Component\RuleEngine\Ast\Node')->reveal();
        $child3 = $this->prophesize('Linio\Component\RuleEngine\Ast\Node')->reveal();
        $children = [$child2, $child3];

        $root = new CompileNode();
        $root->addChild($child1);
        $root->addChildren($children);
        $this->assertEquals([$child1, $child2, $child3], $root->getChildren());
    }
}
