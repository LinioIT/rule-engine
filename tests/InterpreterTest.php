<?php

namespace Linio\Component\RuleEngine;

use Linio\Component\RuleEngine\Parser\BlocklyXmlParser;
use Linio\Type\Dictionary;

class InterpreterTest extends \PHPUnit_Framework_TestCase
{
    public function testIsEvaluatingSimpleBlock()
    {
        $blocklySource = <<<XML
<xml xmlns="http://www.w3.org/1999/xhtml">
  <block type="controls_if" id="263" inline="false" x="325" y="214">
    <value name="IF0">
      <block type="logic_operation" id="264" inline="true">
        <field name="OP">OR</field>
        <value name="A">
          <block type="logic_compare" id="265" inline="true">
            <field name="OP">GT</field>
            <value name="A">
              <block type="math_number" id="266">
                <field name="NUM">10</field>
              </block>
            </value>
            <value name="B">
              <block type="variables_get" id="267">
                <field name="VAR">item</field>
              </block>
            </value>
          </block>
        </value>
        <value name="B">
          <block type="logic_compare" id="268" inline="true">
            <field name="OP">LTE</field>
            <value name="A">
              <block type="math_number" id="269">
                <field name="NUM">1</field>
              </block>
            </value>
            <value name="B">
              <block type="math_arithmetic" id="270" inline="true">
                <field name="OP">ADD</field>
                <value name="A">
                  <block type="math_number" id="271">
                    <field name="NUM">1</field>
                  </block>
                </value>
                <value name="B">
                  <block type="math_number" id="272">
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
      <block type="variables_set" id="273" inline="true">
        <field name="VAR">item</field>
        <value name="VALUE">
          <block type="math_number" id="309">
            <field name="NUM">42</field>
          </block>
        </value>
      </block>
    </statement>
  </block>
</xml>
XML;

        $context = new Dictionary(['item' => 11]);
        $interpreter = new Interpreter();
        $interpreter->setParser(new BlocklyXmlParser());
        $interpreter->evaluate($blocklySource, $context);

        $this->assertEquals(42, $context->get('item'));
    }

    public function testIsEvaluatingCompoundCondition1()
    {
        $context = new Dictionary(['item' => 11, 'item2' => 5]);
        $interpreter = new Interpreter();
        $interpreter->setParser(new BlocklyXmlParser());
        $interpreter->evaluate($this->getCompoundXmlSource(), $context);

        $this->assertEquals(42, $context->get('item'));
        $this->assertEquals(10, $context->get('item2'));
    }

    public function testIsEvaluatingCompoundCondition2()
    {
        $context = new Dictionary(['item' => 11, 'item2' => 10]);
        $interpreter = new Interpreter();
        $interpreter->setParser(new BlocklyXmlParser());
        $interpreter->evaluate($this->getCompoundXmlSource(), $context);

        $this->assertEquals(42, $context->get('item'));
        $this->assertEquals(20, $context->get('item2'));
    }

    public function testIsEvaluatingCompoundCondition3()
    {
        $context = new Dictionary(['item' => 11, 'item2' => 50]);
        $interpreter = new Interpreter();
        $interpreter->setParser(new BlocklyXmlParser());
        $interpreter->evaluate($this->getCompoundXmlSource(), $context);

        $this->assertEquals(42, $context->get('item'));
        $this->assertEquals(42, $context->get('item2'));
    }

    protected function getCompoundXmlSource()
    {
        return <<<XML
<xml xmlns="http://www.w3.org/1999/xhtml">
  <block type="controls_if" id="41" inline="false" x="325" y="214">
    <value name="IF0">
      <block type="logic_operation" id="42">
        <field name="OP">OR</field>
        <value name="A">
          <block type="logic_compare" id="43">
            <field name="OP">GT</field>
            <value name="A">
              <block type="math_number" id="44">
                <field name="NUM">10</field>
              </block>
            </value>
            <value name="B">
              <block type="variables_get" id="45">
                <field name="VAR">item</field>
              </block>
            </value>
          </block>
        </value>
        <value name="B">
          <block type="logic_compare" id="46">
            <field name="OP">LTE</field>
            <value name="A">
              <block type="math_number" id="47">
                <field name="NUM">1</field>
              </block>
            </value>
            <value name="B">
              <block type="math_arithmetic" id="48">
                <field name="OP">ADD</field>
                <value name="A">
                  <block type="math_number" id="49">
                    <field name="NUM">1</field>
                  </block>
                </value>
                <value name="B">
                  <block type="math_number" id="50">
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
      <block type="variables_set" id="51" inline="true">
        <field name="VAR">item</field>
        <value name="VALUE">
          <block type="math_number" id="52">
            <field name="NUM">42</field>
          </block>
        </value>
      </block>
    </statement>
    <next>
      <block type="controls_if" id="53" inline="false">
        <mutation elseif="1" else="1"></mutation>
        <value name="IF0">
          <block type="logic_compare" id="54">
            <field name="OP">GT</field>
            <value name="A">
              <block type="math_number" id="55">
                <field name="NUM">10</field>
              </block>
            </value>
            <value name="B">
              <block type="variables_get" id="56">
                <field name="VAR">item2</field>
              </block>
            </value>
          </block>
        </value>
        <statement name="DO0">
          <block type="variables_set" id="57" inline="true">
            <field name="VAR">item2</field>
            <value name="VALUE">
              <block type="math_number" id="58">
                <field name="NUM">10</field>
              </block>
            </value>
          </block>
        </statement>
        <value name="IF1">
          <block type="logic_compare" id="59">
            <field name="OP">EQ</field>
            <value name="A">
              <block type="math_number" id="60">
                <field name="NUM">10</field>
              </block>
            </value>
            <value name="B">
              <block type="variables_get" id="61">
                <field name="VAR">item2</field>
              </block>
            </value>
          </block>
        </value>
        <statement name="DO1">
          <block type="variables_set" id="62" inline="true">
            <field name="VAR">item2</field>
            <value name="VALUE">
              <block type="math_number" id="63">
                <field name="NUM">20</field>
              </block>
            </value>
          </block>
        </statement>
        <statement name="ELSE">
          <block type="variables_set" id="64" inline="true">
            <field name="VAR">item2</field>
            <value name="VALUE">
              <block type="math_number" id="65">
                <field name="NUM">42</field>
              </block>
            </value>
          </block>
        </statement>
      </block>
    </next>
  </block>
</xml>
XML;
    }
}
