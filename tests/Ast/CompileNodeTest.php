<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

use Linio\Common\Type\Dictionary;
use PHPUnit\Framework\TestCase;

class CompileNodeTest extends TestCase
{
    public function testIsSettingUp(): void
    {
        $root = new CompileNode();
        $this->assertInstanceOf(Dictionary::class, $root->getContext());
    }

    public function testIsEvaluating(): void
    {
        $child1 = $this->prophesize(Node::class);
        $child1->evaluate()->shouldBeCalled();
        $child2 = $this->prophesize(Node::class);
        $child2->evaluate()->shouldBeCalled();

        $root = new CompileNode();
        $root->addChild($child1->reveal());
        $root->addChild($child2->reveal());
        $root->evaluate();
    }

    public function testIsAppendingMultipleChilds(): void
    {
        $child1 = $this->prophesize(Node::class)->reveal();
        $child2 = $this->prophesize(Node::class)->reveal();
        $child3 = $this->prophesize(Node::class)->reveal();
        $children = [$child2, $child3];

        $root = new CompileNode();
        $root->addChild($child1);
        $root->addChildren($children);
        $this->assertEquals([$child1, $child2, $child3], $root->getChildren());
    }
}
