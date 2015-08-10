<?php

namespace Linio\Component\RuleEngine\Parser\Blockly;

use Prophecy\Argument;
use Linio\Component\RuleEngine\Parser\BlocklyXmlParser;
use Linio\Component\RuleEngine\Ast\Node;
use Linio\Component\RuleEngine\Ast\CompileNode;
use Linio\Component\RuleEngine\Ast\ScalarNode;
use Linio\Component\RuleEngine\Ast\IfControlNode;
use Linio\Component\RuleEngine\Ast\IfElseControlNode;
use Linio\Component\RuleEngine\Ast\StackedExpressionNode;

class ControlsIfBlockTest extends \PHPUnit_Framework_TestCase
{
    public function testIsBuildingSimpleIfNode()
    {
        $xml = <<<XML
<block type="controls_if" id="66" inline="false" x="325" y="214">
<value name="IF0">
  <block type="logic_compare" id="105">
    <field name="OP">GT</field>
    <value name="A">
      <block type="math_number" id="124">
        <field name="NUM">2</field>
      </block>
    </value>
    <value name="B">
      <block type="math_number" id="125">
        <field name="NUM">1</field>
      </block>
    </value>
  </block>
</value>
<statement name="DO0">
  <block type="variables_set" id="76" inline="true">
    <field name="VAR">item</field>
    <value name="VALUE">
      <block type="math_number" id="77">
        <field name="NUM">42</field>
      </block>
    </value>
  </block>
</statement>
</block>
XML;
        $root = new CompileNode();
        $expressionNode = $this->prophesize(Node::class);
        $expressionNode->evaluate()->shouldBeCalled();

        $parser = $this->prophesize(BlocklyXmlParser::class);
        $parser->getNodeFromBlockXml($root, Argument::that(function ($arg) {
            return $arg['name'] == 'IF0';
        }))->willReturn(new ScalarNode(true));
        $parser->getNodeFromBlockXml($root, Argument::that(function ($arg) {
            return $arg['name'] == 'DO0';
        }))->willReturn($expressionNode->reveal());

        $block = new ControlsIfBlock();
        $block->setParser($parser->reveal());
        $node = $block->getNode($root, new \SimpleXmlElement($xml));
        $this->assertInstanceOf(StackedExpressionNode::class, $node);
        $node->evaluate();
    }

    public function testIsBuildingCompoundIfNode()
    {
        $xml = <<<XML
<block type="controls_if" id="145" inline="false" x="325" y="214">
<mutation elseif="1" else="1"></mutation>
<value name="IF0">
  <block type="logic_compare" id="146">
    <field name="OP">GT</field>
    <value name="A">
      <block type="math_number" id="147">
        <field name="NUM">2</field>
      </block>
    </value>
    <value name="B">
      <block type="math_number" id="148">
        <field name="NUM">1</field>
      </block>
    </value>
  </block>
</value>
<statement name="DO0">
  <block type="variables_set" id="149" inline="true">
    <field name="VAR">item</field>
    <value name="VALUE">
      <block type="math_number" id="150">
        <field name="NUM">1</field>
      </block>
    </value>
  </block>
</statement>
<value name="IF1">
  <block type="logic_compare" id="166">
    <field name="OP">GT</field>
    <value name="A">
      <block type="math_number" id="167">
        <field name="NUM">1</field>
      </block>
    </value>
    <value name="B">
      <block type="math_number" id="168">
        <field name="NUM">1</field>
      </block>
    </value>
  </block>
</value>
<statement name="DO1">
  <block type="variables_set" id="162" inline="true">
    <field name="VAR">item</field>
    <value name="VALUE">
      <block type="math_number" id="163">
        <field name="NUM">2</field>
      </block>
    </value>
  </block>
</statement>
<statement name="ELSE">
  <block type="variables_set" id="164" inline="true">
    <field name="VAR">item</field>
    <value name="VALUE">
      <block type="math_number" id="165">
        <field name="NUM">3</field>
      </block>
    </value>
  </block>
</statement>
</block>
XML;
        $root = new CompileNode();
        $expressionNode1 = $this->prophesize(Node::class);
        $expressionNode1->evaluate()->shouldNotBeCalled();
        $expressionNode2 = $this->prophesize(Node::class);
        $expressionNode2->evaluate()->shouldNotBeCalled();
        $expressionNode3 = $this->prophesize(Node::class);
        $expressionNode3->evaluate()->shouldBeCalled();

        $parser = $this->prophesize(BlocklyXmlParser::class);
        $parser->getNodeFromBlockXml($root, Argument::that(function ($arg) {
            return $arg['name'] == 'IF0';
        }))->willReturn(new ScalarNode(false));
        $parser->getNodeFromBlockXml($root, Argument::that(function ($arg) {
            return $arg['name'] == 'DO0';
        }))->willReturn($expressionNode1->reveal());
        $parser->getNodeFromBlockXml($root, Argument::that(function ($arg) {
            return $arg['name'] == 'IF1';
        }))->willReturn(new ScalarNode(false));
        $parser->getNodeFromBlockXml($root, Argument::that(function ($arg) {
            return $arg['name'] == 'DO1';
        }))->willReturn($expressionNode2->reveal());
        $parser->getNodeFromBlockXml($root, Argument::that(function ($arg) {
            return $arg['name'] == 'ELSE';
        }))->willReturn($expressionNode3->reveal());

        $block = new ControlsIfBlock();
        $block->setParser($parser->reveal());
        $node = $block->getNode($root, new \SimpleXmlElement($xml));
        $this->assertInstanceOf(StackedExpressionNode::class, $node);
        $node->evaluate();
    }
}
