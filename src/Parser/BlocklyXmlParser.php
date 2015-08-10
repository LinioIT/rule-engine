<?php

namespace Linio\Component\RuleEngine\Parser;

use Linio\Component\RuleEngine\Ast\CompileNode;
use Linio\Component\RuleEngine\Parser\Blockly\Block;
use Linio\Component\RuleEngine\Parser\Blockly\ControlsIfBlock;
use Linio\Component\RuleEngine\Parser\Blockly\LogicCompareBlock;
use Linio\Component\RuleEngine\Parser\Blockly\LogicOperationBlock;
use Linio\Component\RuleEngine\Parser\Blockly\MathArithmeticBlock;
use Linio\Component\RuleEngine\Parser\Blockly\MathNumberBlock;
use Linio\Component\RuleEngine\Parser\Blockly\TextBlock;
use Linio\Component\RuleEngine\Parser\Blockly\VariablesGetBlock;
use Linio\Component\RuleEngine\Parser\Blockly\VariablesSetBlock;

class BlocklyXmlParser implements ParserInterface
{
    /**
     * @var Block[]
     */
    protected $blocks = [];

    public function __construct()
    {
        $this->addBlock(new LogicCompareBlock());
        $this->addBlock(new MathArithmeticBlock());
        $this->addBlock(new TextBlock());
        $this->addBlock(new VariablesSetBlock());
        $this->addBlock(new ControlsIfBlock());
        $this->addBlock(new LogicOperationBlock());
        $this->addBlock(new MathNumberBlock());
        $this->addBlock(new VariablesGetBlock());
    }

    /**
     * {@inheritdoc}
     */
    public function parse($inputString)
    {
        $xml = new \SimpleXmlElement($inputString);
        $root = new CompileNode();

        foreach ($xml->children() as $block) {
            $root->addChild($this->getNodeFromBlockXml($root, $block));
        }

        return $root;
    }

    /**
     * @param mixed             $root
     * @param \SimpleXmlElement $element
     */
    public function getNodeFromBlockXml($root, \SimpleXmlElement $element)
    {
        $block = $element->getName() === 'block' ? $element : $element->block;

        if (!isset($this->blocks[(string) $block['type']])) {
            throw new \RuntimeException('Undefined node: ' . $block['type']);
        }

        return $this->blocks[(string) $block['type']]->getNode($root, $block);
    }

    /**
     * @param Block $block
     */
    public function addBlock(Block $block)
    {
        $block->setParser($this);
        $this->blocks[$block->getType()] = $block;
    }

    /**
     * @param string $type
     */
    public function removeBlock($type)
    {
        unset($this->blocks[$type]);
    }
}
