<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Parser;

use Linio\Component\RuleEngine\Ast\CompileNode;
use Linio\Component\RuleEngine\Ast\Node;
use Linio\Component\RuleEngine\Parser\Blockly\Block;
use Linio\Component\RuleEngine\Parser\Blockly\ControlsIfBlock;
use Linio\Component\RuleEngine\Parser\Blockly\LogicCompareBlock;
use Linio\Component\RuleEngine\Parser\Blockly\LogicOperationBlock;
use Linio\Component\RuleEngine\Parser\Blockly\MathArithmeticBlock;
use Linio\Component\RuleEngine\Parser\Blockly\MathNumberBlock;
use Linio\Component\RuleEngine\Parser\Blockly\TextBlock;
use Linio\Component\RuleEngine\Parser\Blockly\VariablesGetBlock;
use Linio\Component\RuleEngine\Parser\Blockly\VariablesSetBlock;
use RuntimeException;
use SimpleXMLElement;

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

    public function parse(string $inputString): CompileNode
    {
        $xml = new SimpleXMLElement($inputString);
        $root = new CompileNode();

        foreach ($xml->children() as $block) {
            $root->addChild($this->getNodeFromBlockXml($root, $block));
        }

        return $root;
    }

    public function getNodeFromBlockXml(CompileNode $root, SimpleXMLElement $element): Node
    {
        $block = $element->getName() === 'block' ? $element : $element->block;

        if (!isset($this->blocks[(string) $block['type']])) {
            throw new RuntimeException('Undefined node: ' . $block['type']);
        }

        return $this->blocks[(string) $block['type']]->getNode($root, $block);
    }

    public function addBlock(Block $block): void
    {
        $block->setParser($this);
        $this->blocks[$block->getType()] = $block;
    }

    public function removeBlock(string $type): void
    {
        unset($this->blocks[$type]);
    }
}
