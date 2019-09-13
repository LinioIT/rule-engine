<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Parser\Blockly;

use Linio\Component\RuleEngine\Ast\MathOperationNode;

class MathArithmeticBlock extends Block
{
    public function getType()
    {
        return 'math_arithmetic';
    }

    /**
     * {@inheritdoc}
     */
    public function getNode($root, \SimpleXMLElement $block)
    {
        $node = new MathOperationNode(
            (string) $block->field,
            $this->parser->getNodeFromBlockXml($root, $block->value[0]),
            $this->parser->getNodeFromBlockXml($root, $block->value[1])
        );
        $node->setRoot($root);

        return $node;
    }
}
