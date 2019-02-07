<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Parser;

use PHPUnit\Framework\TestCase;

class BlocklyXmlParserTest extends TestCase
{
    public function testIsParsingSimpleBlock(): void
    {
        $blocklySource = <<<XML
<xml xmlns="http://www.w3.org/1999/xhtml">
  <block type="controls_if" id="1" inline="false" x="325" y="214">
    <value name="IF0">
      <block type="logic_operation" id="2" inline="true">
        <field name="OP">OR</field>
        <value name="A">
          <block type="logic_compare" id="3" inline="true">
            <field name="OP">GT</field>
            <value name="A">
              <block type="math_number" id="4">
                <field name="NUM">10</field>
              </block>
            </value>
            <value name="B">
              <block type="variables_get" id="5">
                <field name="VAR">item</field>
              </block>
            </value>
          </block>
        </value>
        <value name="B">
          <block type="logic_compare" id="6" inline="true">
            <field name="OP">LTE</field>
            <value name="A">
              <block type="math_number" id="7">
                <field name="NUM">1</field>
              </block>
            </value>
            <value name="B">
              <block type="math_arithmetic" id="8" inline="true">
                <field name="OP">ADD</field>
                <value name="A">
                  <block type="math_number" id="9">
                    <field name="NUM">1</field>
                  </block>
                </value>
                <value name="B">
                  <block type="math_number" id="10">
                    <field name="NUM">10</field>
                  </block>
                </value>
              </block>
            </value>
          </block>
        </value>
      </block>
    </value>
    <statement name="DO0">
      <block type="variables_set" id="11" inline="true">
        <field name="VAR">item</field>
        <value name="VALUE">
          <block type="math_number" id="12">
            <field name="NUM">42</field>
          </block>
        </value>
      </block>
    </statement>
  </block>
  <block type="controls_if" id="13" inline="false" x="313" y="388">
    <value name="IF0">
      <block type="logic_operation" id="14" inline="true">
        <field name="OP">OR</field>
        <value name="A">
          <block type="logic_compare" id="15" inline="true">
            <field name="OP">GT</field>
            <value name="A">
              <block type="math_number" id="16">
                <field name="NUM">10</field>
              </block>
            </value>
            <value name="B">
              <block type="variables_get" id="17">
                <field name="VAR">item</field>
              </block>
            </value>
          </block>
        </value>
        <value name="B">
          <block type="logic_compare" id="18" inline="true">
            <field name="OP">LTE</field>
            <value name="A">
              <block type="math_number" id="19">
                <field name="NUM">1</field>
              </block>
            </value>
            <value name="B">
              <block type="math_arithmetic" id="20" inline="true">
                <field name="OP">ADD</field>
                <value name="A">
                  <block type="math_number" id="21">
                    <field name="NUM">1</field>
                  </block>
                </value>
                <value name="B">
                  <block type="math_number" id="22">
                    <field name="NUM">10</field>
                  </block>
                </value>
              </block>
            </value>
          </block>
        </value>
      </block>
    </value>
    <statement name="DO0">
      <block type="variables_set" id="23" inline="true">
        <field name="VAR">item2</field>
        <value name="VALUE">
          <block type="math_number" id="24">
            <field name="NUM">78</field>
          </block>
        </value>
      </block>
    </statement>
  </block>
</xml>
XML;

        $parser = new BlocklyXmlParser();
        $node = $parser->parse($blocklySource);

        $this->assertInstanceOf('Linio\Component\RuleEngine\Ast\CompileNode', $node);
        $children = $node->getChildren();
        $this->assertCount(2, $children);
        $this->assertInstanceOf('Linio\Component\RuleEngine\Ast\StackedExpressionNode', $children[0]);
        $this->assertInstanceOf('Linio\Component\RuleEngine\Ast\StackedExpressionNode', $children[1]);
    }

    public function testIsDetectingBadNodes(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Undefined node: foobar');

        $blocklySource = <<<XML
<xml xmlns="http://www.w3.org/1999/xhtml">
  <block type="foobar" id="473" inline="false" x="325" y="214">
  </block>
</xml>
XML;

        $parser = new BlocklyXmlParser();
        $parser->parse($blocklySource);
    }
}
